<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Wishlish;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class WishlishController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $nameroute = Route::currentRouteName();
        $nameroute = explode('.', $nameroute);
        $nameroute = array_map('ucfirst', $nameroute);
        $title = implode('-', $nameroute);
        $this->model = Wishlish::query();
        view()->share([
            'title' => $title,
            'name_sidebar' => $nameroute[0], 
        ]);
    }

    public function add($wishlish) {
        $data = $this->model->where('product_id', $wishlish)->get()->first();
        if(isset($data->product_id)) {
            return response()->json([
                'error' => 'Sản phẩm yêu thích này đã tồn tại!',
            ]);
        }
        $this->model->create([
            'user_id' => auth()->id(),
            'product_id' => $wishlish,
        ]);
        return response()->json([
            'success' => 'Thêm sản phẩm yêu thích thành công!',
        ]);
    }

    public function show() {
        $data = $this->model
        ->where('user_id', auth()->id())
        ->with('product:id,product_name,price,product_thumbnail')
        ->get();
        return view('frontend.wishlist.wishlist_view', [
            'data' => $data,
        ]);
    }

    public function destroy($wishlish) {
        $this->model->findOrFail($wishlish);
        Wishlish::destroy($wishlish);
        return response()->json(([
            'success' => 'Xóa sản phẩm yêu thích thành công!'
        ]));
    }

    public function count() {
        $count = $this->model
        ->where('user_id', auth()->id())
        ->count();
        return response()->json([
            'count' => $count,
        ]);
    }
}
