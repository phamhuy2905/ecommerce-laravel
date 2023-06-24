<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\MultipeImage;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add_Cart(Request $request, $cart) {
        $product = Product::findOrFail($cart);

        Cart::add([
            'id' => $cart,
            'name' =>$product->product_name,
            'price' => $product->price - $product->discount,
            'qty' => $request->quantity_value,
            'weight' => 1, 
            'options' => [
                'image' =>  $product->product_thumbnail,
                'discount' => 0,
            ],
        ]);
        return response()->json([
            'success' => 'Thêm sản phẩm thành công!',
        ]);
    }


    public function Add_mini_cart() {
        $cart = Cart::content();
        $total_quantity = Cart::count();
        $total = Cart::total();

        return response()->json([
            'cart' => $cart,
            'total_quantity' => $total_quantity,
            'total' => $total,
        ]);
    }

    public function Remove_cart($cart) {
        Cart::remove($cart);
        $total = Cart::total();
        return response()->json([
            'success' => 'Xóa sản phẩm thành công!',
            'total' => $total,
        ]);
    }

    public function Detail($cart)  {
        // dd($cart);
        // $data = Product::findOrFail($cart);
        $data = Product::
        with('category:id,name')
        ->with('subcategory:id,name')
        ->with('brand:id,brand_name')
        ->with('vendor:id,name,shop_name')
        ->where('id', $cart)
        ->get()
        ->first();

        $multiple = MultipeImage::where('product_id', $cart)->get();
        return view('frontend.product.product_detail', [
            'data' => $data,
            'multiple' => $multiple,
        ]);
    }


    public function all() {
        if(Session::has('coupon')) {
            Session::forget('coupon');
        }
        $data = Cart::content();
        return view('frontend.cart.cart_view', [
            'data' => $data,
        ]);
    }

    public function increment($cart) {
        $data = Cart::get($cart);
        Cart::update($cart, $data->qty + 1);
        $total = Cart::total();
        return response()->json([
            'success' => 'Tăng sản phẩm thành công!',
            'total' => $total,
        ]);
    }

    public function minus($cart) {
        $data = Cart::get($cart);
        Cart::update($cart, $data->qty - 1);
        $total = Cart::total();
        return response()->json([
            'success' => 'Giảm sản phẩm thành công!',
            'total' => $total,
        ]);
    }

    public function apply_discount($cart) {
        $data = Coupon::where('name', $cart)
        ->where('valid', '>=',str_replace('-','/', Carbon::now('Asia/Ho_Chi_Minh')))
        ->get()
        ->first();
        if(!isset($data->discount)) {
            Session::forget('coupon');
            return response()->json([
                'error' => 'Coupon không tồn tại hoặc đã hết hạn!',
            ]);
        }
        if(!Session::has('coupon')) {
            Session::put('coupon', $data->discount);
        }
        return response()->json([
            'success' => 'Apply coupon thàng công!',
            'total' => Cart::total() - Cart::total() * Session::get('coupon') / 100,
        ]);
    }

}
