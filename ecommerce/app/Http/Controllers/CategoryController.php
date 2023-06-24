<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\AddCategory;
use App\Http\Requests\Category\UpdateCategory;
use App\Models\Category;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Image;
class CategoryController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Category())->query();
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
        return view('backend.all_category', [
            'data' => $data,
        ]);
    }

    public function create() {
        return view('backend.add_category');
    }

    public function store(AddCategory $request) {
        $image = $request->image;
        $name_general = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('img/category/'.$name_general);
        $save_url= 'img/category/'.$name_general;
        $this->model->insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $save_url,
        ]);
        return redirect()->route('category.index')->with([
            'success_category' => 'Thêm category thành công!'
        ]);
    }

    public function edit(Category $category) {
        return view('backend.edit_category',[
            'category' => $category,
        ]);
    }

    public function update(UpdateCategory $request) {
        $image_old = $request->image_old;
        if($request->image) {
            $image = $request->image;
            $name_general = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('img/category/'.$name_general);
            $save_url= 'img/category/'.$name_general;
            if(file_exists($image_old)) {
                unlink($image_old);
            }
            $this->model->findOrFail($request->id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'image' => $save_url,
            ]);
            return redirect()->route('category.index')->with([
                'success_category' => 'Sửa brand thành công!'
            ]);
        }

        else {
            $this->model->findOrFail($request->id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
            ]);
            return redirect()->route('category.index')->with([
                'success_category' => 'Sửa brand thành công!'
            ]);
        }
    }

    public function destroy(Category $category) {
        unlink($category->image);
        $category->destroy($category->id);
        return redirect()->route('category.index')->with([
            'success_delete_category' => 'Xóa category thành công!'
        ]);
    }

}
