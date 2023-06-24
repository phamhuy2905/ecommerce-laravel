<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SubcategoryController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Subcategory())->query();
        $name_route = Route::currentRouteName();
        $name_route = explode('.', $name_route);
        $name_route = array_map('ucfirst', $name_route);
        $title = implode('-',$name_route);
        view()->share([
           'title' => $title, 
           'name_sidebar' => $name_route[0], 
        ]);
    }
    public function index(Request $request) {
        $category_search = $request->has('category') ? $request->get('category') : '';
        $query = $this->model
        ->select([
            'id',
            'name',
            'category_id',
        ])
        ->with('category:id,name')
        ->orderBy('id', 'desc');
        if($request->has('category') && $request->get('category') != -1) {
            $category_search = $request->get('category');
            $query = $query
            ->where('category_id',$request->get('category'));
        }
        $data = $query->get();
        $category = Category::select(['id','name'])->get();;
        return view('backend.sub_category.all_subcategory', [
            'data' => $data,
            'category' => $category,
            'category_search' => $category_search ,
        ]);
    }

    public function create() {
        $data = Category::get();
        return view('backend.sub_category.add_subcategory', [
            'data' =>$data,
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => [
                'bail',
                'required',
                'max:255',
                'min:3',
                'string',
            ],
            'category_name' => [
                'bail',
                'integer',
                'required',
                'exists:categories,id',
            ],
        ]);
        $this->model->insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'category_id' =>  $request->category_name,
        ]);
        return redirect()->route('subcategory.index')->with([
            'type' => 'message_success',
            'message' => 'Thêm subcategory thành công!',
        ]);
    }

    public function edit(Subcategory $subcategory) {
        $category = Category::get();
        return view('backend.sub_category.edit_subcategory',[
            'data' => $subcategory,
            'category' => $category,
        ]);
    }

    public function update(Request $request) {
        $validated = $request->validate([
            'name' => [
                'bail',
                'required',
                'max:255',
                'min:3',
                'string',
                Rule::unique('subcategories')->ignore($request->id),
            ],
            'category_id' => [
                'bail',
                'integer',
                'exists:categories,id',
            ],
        ]);
        $this->model->findOrFail($request->id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'category_id' => $request->category_name,
        ]);
        return redirect()->route('subcategory.index')->with([
            'success_category' => 'Sửa subcategory thành công!'
        ]);
    }

    public function destroy(Subcategory $subcategory) {
        $subcategory->destroy($subcategory->id);
        return redirect()->route('subcategory.index')->with([
            'success_delete_subcategory' => 'Xóa subcategory thành công!'
        ]);
    }

    public function destroy_all(Request $request) {
        $arr = [];
        $data = $request;
        $data = Arr::except($data, ['_token', 'table_id_length']);
        foreach ($data->request as $key => $value) {
            $arr[] = $value;
        }
        $this->model ->whereIn('id', $arr)->delete();
        return redirect()->route('subcategory.index')->with([
            'success_delete_subcategory' => 'Xóa subcategory thành công!'
        ]);
    }
}
