<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Image;
class SlideController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Slide())->query();
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
        return view('backend.slider.all_slider', [
            'data' => $data,
        ]);
    }

    public function create() {
        return view('backend.slider.add_slider');
    }

    public function store(Request $request) {
        $image = $request->image;
        $name_general = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('img/slider/'.$name_general);
        $save_url= 'img/slider/'.$name_general;
        $this->model->insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $save_url,
        ]);
        return redirect()->route('slider.index')->with([
            'success_slider' => 'Thêm slider thành công!'
        ]);
    }

    public function edit(Slide $slider) {
        return view('backend.slider.edit_slider',[
            'data' => $slider,
        ]);
    }

    public function update(Request $request) {
        $slider_image_old = $request->slider_image_old;
        if($request->image) {
            $image = $request->image;
            $name_general = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(2376,807)->save('img/slider/'.$name_general);
            $save_url= 'img/slider/'.$name_general;
            if(file_exists($slider_image_old)) {
                unlink($slider_image_old);
            }
            $this->model->findOrFail($request->id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'image' => $save_url,
            ]);
            return redirect()->route('slider.index')->with([
                'success_slider' => 'Sửa slider thành công!'
            ]);
        }

        else {
            $this->model->findOrFail($request->id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
            ]);
            return redirect()->route('slider.index')->with([
                'success_slider' => 'Sửa slider thành công!'
            ]);
        }
    }

    public function destroy(Slide $slider) {
        unlink($slider->name);
        $slider->destroy($slider->id);
        return redirect()->route('slider.index')->with([
            'success_delete_slider' => 'Xóa slider thành công!'
        ]);
    }
}
