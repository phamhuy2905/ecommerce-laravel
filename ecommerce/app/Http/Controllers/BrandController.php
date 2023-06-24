<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\AddBrand;
use App\Http\Requests\Brand\UpdateBrand;
use App\Models\Brand;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Image;
class BrandController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Brand())->query();
        $name_route = Route::currentRouteName();
        $name_route = explode('.', $name_route);
        $name_route = array_map('ucfirst', $name_route);
        $title = implode('-',$name_route);
        view()->share([
           'title' => $title, 
           'name_sidebar' => $name_route[0], 
        ]);
    }
    public function index() {
        $data = $this->model->orderByRaw('id DESC')
        ->get();
        return view('backend.all_brand', [
            'data' => $data,
        ]);
    }

    public function create() {
        return view('backend.add_brand');
    }

    public function store(AddBrand $request) {
        $image = $request->brand_image;
        $name_general = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('img/brand/'.$name_general);
        $save_url= 'img/brand/'.$name_general;
        $this->model->insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
        ]);
        return redirect()->route('brand.index')->with([
            'success_brand' => 'Thêm brand thành công!'
        ]);
    }

    public function edit(Brand $brand) {
        return view('backend.edit_brand',[
            'brand' => $bra	nd,
        ]);
    }

    public function update(UpdateBrand $request) {
        $brand_image_old = $request->brand_image_old;
        if($request->brand_image) {
            $image = $request->brand_image;
            $name_general = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('img/brand/'.$name_general);
            $save_url= 'img/brand/'.$name_general;
            if(file_exists($brand_image_old)) {
                unlink($brand_image_old);
            }
            $this->model->findOrFail($request->id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);
            return redirect()->route('brand.index')->with([
                'success_brand' => 'Sửa brand thành công!'
            ]);
        }

        else {
            $this->model->findOrFail($request->id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);
            return redirect()->route('brand.index')->with([
                'success_brand' => 'Sửa brand thành công!'
            ]);
        }
    }

    public function destroy(Brand $brand) {
        unlink($brand->brand_image);
        $brand->destroy($brand->id);
        return redirect()->route('brand.index')->with([
            'success_delete_brand' => 'Xóa brand thành công!'
        ]);
    }

}
