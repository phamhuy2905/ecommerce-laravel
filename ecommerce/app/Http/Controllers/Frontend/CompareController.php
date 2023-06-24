<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CompareController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $nameroute = Route::currentRouteName();
        $nameroute = explode('.', $nameroute);
        $nameroute = array_map('ucfirst', $nameroute);
        $title = implode('-', $nameroute);
        $this->model = Compare::query();
        view()->share([
            'title' => $title,
            'name_sidebar' => $nameroute[0], 
        ]);
    }

    public function add($compare) {
        $data = $this->model->where('product_id', $compare)->get()->first();
        if(isset($data->product_id)) {
            return response()->json([
                'error' => 'Sản phẩm so sánh này đã tồn tại!',
            ]);
        }
        $this->model->create([
            'user_id' => auth()->id(),
            'product_id' => $compare,
        ]);
        return response()->json([
            'success' => 'Thêm sản phẩm so sánh thành công!',
        ]);
    }

    public function show() {
        $data = $this->model
        ->join('products', 'products.id', 'compares.product_id')
        ->join('categories', 'categories.id', 'products.category_id')
        ->join('subcategories', 'subcategories.id', 'products.subcategory_id')
        ->join('brands', 'brands.id', 'products.brand_id')
        ->addselect('categories.name as category_name')
        ->addselect('brands.brand_name as brand_name')
        ->addselect('subcategories.name as subcategory_name')
        ->addselect([
            'products.product_name as product_name',
            'products.price as price',
            'products.product_thumbnail as thumbnail',
            'products.short_description as short',
            'products.long_description as long',
            'compares.id',
        ])
        ->get();

        return view('frontend.compare.compare_view', [
            'data' => $data,
        ]);
    }

    public function destroy($compare) {
        $this->model->findOrFail($compare);
        Compare::destroy($compare);
        return response()->json(([
            'success' => 'Xóa sản phẩm so sánh thành công!'
        ]));
    }

    public function count() {
        $count = $this->model->count();
        return response()->json([
            'count' => $count,
        ]);
    }
}
