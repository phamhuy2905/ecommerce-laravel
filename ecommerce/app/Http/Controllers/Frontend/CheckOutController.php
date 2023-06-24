<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\CheckOutMail;
use App\Models\AddressRecipient;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\User;
use App\Notifications\CheckOutVendorNotification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $name_route = Route::currentRouteName();
        $name_route = explode('.', $name_route);
        $name_route = array_map('ucfirst', $name_route);
        $title = implode('-', $name_route);
        view()->share([
            'title' => $title,
            'name_sidebar' => $name_route[0], 
        ]);
    }
    public function index() {
        $cart = Cart::Content();
        $total = Cart::total();
        $data = User::findOrFail(auth()->id());
        return view('frontend.check_out.checkout_view',[
            'data' => $data,
            'cart' => $cart,
            'total' => $total - $total * Session::get('coupon') / 100,
        ]);
    }

    public function processcheckout(Request $request) {
        $coupon = 0;
        if(Session::has('coupon')) {
            $coupon = Session::get('coupon');
        }
        $bill = Bill::insertGetId([
            'user_id' => auth()->id(),
            'status' => 0,
            'name_recipient' => $request->name_recipient,
            'phone_recipient' => $request->phone_recipient,
            'description_infomation' => $request->description_infomation, 
            'total' => Cart::total() - Cart::total() * $coupon / 100, 
        ]);
        $cart = Cart::content();
        foreach ($cart as $each) {
            BillDetail::create([
                'bill_id' => $bill,
                'product_id' => $each->id,
                'detail_price' => $each->price,
                'quantity' => $each->qty,
            ]);
        }
        $provinces = \Kjmtrue\VietnamZone\Models\Province::where('id', $request->provinces)->get()->first()->name ?? null;
        $districts = \Kjmtrue\VietnamZone\Models\District::where('id', $request->districts)->get()->first()->name ?? null;
        $wards = \Kjmtrue\VietnamZone\Models\Ward::where('id', $request->wards)->get()->first()->name ?? null;
        AddressRecipient::create([
            'bill_id' => $bill,
            'provinces' => $request->provinces,
            'districts' => $request->districts,
            'wards' => $request->wards,
            'street' => $request->street.', '. $wards.', '. $districts.', '. $provinces,
        ]);
        Cart::destroy();
        Session::forget('coupon');

        $data = Bill::findOrFail($bill);
        $amout = $data->total;
        // Mail::to($request->email)->send(new CheckOutMail($amout));
        Mail::to($request->email)
        ->later(now()->addSecond(10), new CheckOutMail($amout));
        
        $user = User::join('products', 'products.vendor_id', 'users.id')
        ->join('bill_details','bill_details.product_id','products.id')
        ->addSelect('users.*')
        ->where('bill_details.bill_id', $bill)
        ->get();
        Notification::send($user, new CheckOutVendorNotification($request->name_recipient));
        return redirect()->route('user.index');
    }

    public function Vieworder($id) {
        $bill = Bill::join('bill_details','bill_details.bill_id','bills.id')
        ->join('products','products.id','bill_details.product_id')
        ->addSelect('bills.*')
        ->addSelect('bill_details.quantity as detail_quantity', 'bill_details.id as detail_id', 'bill_details.detail_price')
        ->addSelect('products.product_name as product_name', 'products.product_thumbnail as product_thumbnail','products.price')
        ->where('bills.id', $id)
        ->get();
        $total = $bill->first()->total ?? 0;
        $description_infomation = $bill->first()->description_infomation ?? '';
        return view('frontend.order.order_view', [
            'data' => $bill,
            'total' => $total,
            'description_infomation' => $description_infomation,
        ]);
    }

    public function remove_detail($bill, $detail) {
        
        $detail_price = BillDetail::select('detail_price')->where('id', $detail)->get()->first()->detail_price;
        $data = BillDetail::addSelect('products.price')
        ->addSelect('bill_details.quantity as qty')
        ->join('products', 'products.id', 'bill_details.product_id')
        ->where('bill_details.id', $detail)
        ->first();
        BillDetail::destroy($detail);    
        $each = BillDetail::where('bill_details.bill_id', $bill);
        $count = $each->get()->count();
        if($count == 0) {
            AddressRecipient::where('bill_id', $bill)->delete();
            Bill::destroy($bill);
            return response()->json([
                'success' => 'Xóa sản phẩm thành công!',
                'total' => 0,
            ]);
        }
        else {
            $each = Bill::findOrFail($bill);
            $total = $each->total - ($data->qty * $detail_price);
            Bill::where('id', $bill)->update([
                'total' => $total,
            ]);
             return response()->json([
                'success' => 'Xóa 1 sản phẩm thành công!',
                'total' => $total,
            ]);
        }
    }
}
