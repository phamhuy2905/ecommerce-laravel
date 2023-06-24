<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\AddressRecipient;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ManagerOrderController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = Bill::query();
        $name_route = Route::currentRouteName();
        $name_route = explode('.', $name_route);
        $name_route = array_map('ucfirst', $name_route);
        $title = implode('-', $name_route);
        view()->share([
            'title' => $title,
            'name_sidebar' => $name_route[0],
        ]);
    }
    public function OrderPending() {
        $data = $this->model
        ->addSelect('products.product_name as product_name','products.product_thumbnail as photo')
        ->addSelect('bills.total as total','bills.name_recipient', 'bills.phone_recipient','bills.created_at', 'bills.id','bills.status')
        ->addSelect('users.name as name_user', 'users.phone as phone_user')
        ->addSelect('address_recipients.street as address_recipient')
        ->addSelect('bill_details.quantity as qty', 'bill_details.id as detail_id')
        ->join('users','users.id','bills.user_id')
        ->join('address_recipients','address_recipients.bill_id','bills.id')
        ->join('bill_details','bill_details.bill_id','bills.id')
        ->join('products','products.id','bill_details.product_id')
        ->where('products.vendor_id', auth()->id())
        ->where('bills.status', 0)
        ->get();
        return view('vendor.manager_order.order_pending', [
            'data' => $data,
        ]);
    }

    public function Acpect($id) {
        Bill::findOrFail($id)->update([
            'status' => 1,
        ]);
        return redirect()->route('managerorder.pending')->with([
            'message'=> 'Acpect bill success!'
        ]);
    }

    public function Detail($id) {
        $data = $this->model
        ->addSelect('products.product_name as product_name','products.product_thumbnail as product_thumbnail')
        ->addSelect('bills.total as total','bills.name_recipient', 'bills.phone_recipient','bills.created_at', 'bills.id','bills.status')
        ->addSelect('users.name as name_orderer', 'users.phone as phone_orderer')
        ->addSelect('address_recipients.street as address_recipient')
        ->addSelect('bill_details.quantity as quantity', 'bill_details.detail_price as price')
        ->join('users','users.id','bills.user_id')
        ->join('address_recipients','address_recipients.bill_id','bills.id')
        ->join('bill_details','bill_details.bill_id','bills.id')
        ->join('products','products.id','bill_details.product_id')
        ->where('products.vendor_id', auth()->id())
        ->where('bills.id', $id)
        ->get()->first();

        return view('vendor.manager_order.order_detail', [
            'data' => $data,
        ]);
    }

    public function Cancel($id, Request $request) {
        $data = BillDetail::addSelect('bill_details.quantity as quantity', 'bill_details.detail_price as price')
        ->addSelect('bills.total as total','bills.id as bill_id')
        ->addSelect('address_recipients.id as address_id')
        ->join('bills','bills.id','bill_details.bill_id')
        ->join('address_recipients','address_recipients.bill_id','bills.id')
        ->where('bill_details.id', $id)
        ->get()->first();
        $count = BillDetail::where('bill_id', $data->bill_id)->count();
        BillDetail::destroy($id);
        if($count == 1) {
            AddressRecipient::destroy($data->address_id);
            Bill::destroy($data->bill_id);
        }
        else {
            Bill::findOrFail($data->bill_id)->update([
                'total' => $data->total - $data->quantity * $data->price
            ]);
        }
        return redirect()->route('managerorder.pending')->with([
            'message'=> 'Cancel bill success!'
        ]);
    }
}



