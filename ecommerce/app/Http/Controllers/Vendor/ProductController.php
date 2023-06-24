<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddProduct;
use App\Http\Requests\Product\UpdateProduct;
use App\Http\Requests\Requests\Vendor\AddProduct as VendorAddProduct;
use App\Http\Requests\Vendor\UpdateProduct as VendorUpdateProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultipeImage;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Image;
use PhpParser\Parser\Multiple;


class ProductController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = Product::query();
        $name_route = Route::currentRouteName();
        $name_route = explode('.', $name_route);
        $name_route = array_map('ucfirst', $name_route);
        $title = implode('-',$name_route);
        view()->share([
           'title' => $title, 
           'name_sidebar' => $name_route[0], 
        ]);
    }

    public function all() {
        $data = Product::latest()
        ->with('category:id,name')
        ->with('subcategory:id,name')
        ->with('brand:id,brand_name')
        ->with('vendor:id,name,shop_name,role')
        ->whereHas('vendor', function ($query) {
            $query->where('role', 'vendor');
        })
        ->whereHas('vendor', function ($query) {
            $query->where('id', auth()->id());
        })
        ->get();

        // $data = $this->model
        // ->addSelect('products.*')
        // ->addSelect('brands.id as brand_id', 'brands.brand_name as brand_name')
        // ->addSelect('categories.id as category_id', 'categories.name as category_name')
        // ->addSelect('subcategories.id as subcategory_id', 'subcategories.name as subcategory_name')
        // ->addSelect('users.id as user_id','users.shop_name as user_shopname','users.name as user_name','users.role as role_name')
        // ->addSelect('multipe_images.id as multiple_images_id', 'multipe_images.photo_name as photo_name','multipe_images.product_id  as multiple_product_id')
        // ->join('categories','categories.id', 'products.category_id')
        // ->join('subcategories','subcategories.id', 'products.subcategory_id')
        // ->join('users','users.id', 'products.vendor_id')
        // ->join('brands','brands.id', 'products.brand_id')
        // ->join('multipe_images','multipe_images.id','products.id')
        // ->where('users.role','vendor')
        // ->get();
        return view('vendor.manager_product.product_all', [
            'data' => $data,
        ]);
    }

    public function add() {
        $brand = Brand::select(['id', 'brand_name'])->get();
        $category = Category::select(['id', 'name'])->get();
        $subcategory = Subcategory::select(['id', 'name', 'category_id'])
        ->get();
        return view('vendor.manager_product.product_add', [
            'brand' => $brand,
            'category' => $category,
            'subcategory' => $subcategory,
        ]);
    }

    public function process_add(Request $request) {
        $category = $request->category_id;
        $subcategory = $request->subcategory_id;
        $test = Subcategory::where('id', $subcategory)->where('category_id', $category)->get();
        if(empty($test->first()->id)) {
           return redirect()->back();
        }
        $image = $request->product_thumbnail;
        $name_general = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $product_id =  $this->model->insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'price' => $request->price,
            'discount' => $request->discount,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description ,
            'vendor_id' => auth()->id(),
            'hot_deals' => $request->hot_deals ?? 0,
            'special_offer' => $request->special_offer ?? 0,
            'product_featured' => $request->product_featured ?? 0,
            'status' =>  0,
            'product_thumbnail' => 'img/product_thumbnail/'.$name_general,
        ]);
        $image = Image::make($image)->resize(800,800)->save('img/product_thumbnail/'.$name_general);
       
        if($request->multipe_img) {
            foreach ($request->multipe_img as  $each) {
                $name_general = hexdec(uniqid()).'.'.$each->getClientOriginalExtension();
                Image::make($each)->resize(800,800)->save('img/product_multipe/'.$name_general);
                MultipeImage::create([
                    'product_id' => $product_id,
                    'photo_name' => 'img/product_multipe/'.$name_general,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return redirect()->route('managerproduct_vendor.all')->with([
            'message' => 'Thêm sản phẩm thành công!',
        ]);
    }

    public function edit(Product $product) {
        $brand = Brand::select(['id', 'brand_name'])->get();
        $category = Category::select(['id', 'name'])->get();
        $subcategory = Subcategory::select(['id', 'name', 'category_id'])->get();
        $multipe_img = MultipeImage::where('product_id', $product->id)->get();
        return view('vendor.manager_product.product_edit', [
            'brand' => $brand,
            'category' => $category,
            'subcategory' => $subcategory,
            'data' => $product,
            'multipe_img' => $multipe_img,
        ]);
    }

    public function update(VendorUpdateProduct $request) {
        $this->model->findOrFail($request->id);
        if($request->product_thumbnail) {
            $product_thumbnail_old = $request->product_thumbnail_old;
            $image = $request->product_thumbnail;
            $name_general = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800,800)->save('img/product_thumbnail/'.$name_general);
            $save_url = 'img/product_thumbnail/'.$name_general;
            if(file_exists($product_thumbnail_old)) {
                unlink($product_thumbnail_old);
            }
            $this->model->findOrFail($request->id)->update([
                'product_thumbnail' => $save_url,
            ]);
        }
        if($request->multipe_img) {
            foreach ($request->multipe_img as $each) {
                $name_general = hexdec(uniqid()).'.'.$each->getClientOriginalExtension();
                Image::make($each)->resize(800,800)->save('img/product_multipe/'.$name_general);
                MultipeImage::create([
                    'product_id' => $request->id,
                    'photo_name' => 'img/product_multipe/'.$name_general,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        if(!empty($request->multiple_delete)) {
            $multiple_arr = $request->multiple_delete;
            $multipe_img = MultipeImage::whereIn('id', $multiple_arr);
            foreach ($multipe_img->get() as  $each) {
                if(file_exists($each->photo_name)) {
                    unlink($each->photo_name);
                }
            }
            $multipe_img->delete();
        }
        $this->model->findOrFail($request->id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'price' => $request->price,
            'discount' => $request->discount,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description ,
            'hot_deals' => $request->hot_deals ?? 0,
            'special_offer' => $request->special_offer ?? 0,
            'product_featured' => $request->product_featured ?? 0,
        ]);
        return redirect()->route('managerproduct_vendor.all')->with([
            'message' => 'Sửa sản phẩm thành công!',
        ]);
    }

    public function stop_selling($product) {
        // $multipe_img = MultipeImage::where('product_id', $product);
        // $data = $this->model->where('id', $product);
        // if(file_exists($data->get()->first()->product_thumbnail)) {
        //     unlink($data->get()->first()->product_thumbnail);
        // }
        // foreach ($multipe_img->get() as  $each) {
        //     if(!empty($each->photo_name)) {
        //         if(file_exists($each->photo_name)) {
        //             unlink($each->photo_name);
        //         }
        //     }
        // }
        // $multipe_img->delete();
        // $data->delete();
        $this->model->findOrFail($product)->update([
            'status' => 0
        ]);
        return redirect()->route('managerproduct_vendor.all')->with([
            'message' => 'Update status selling success!',
        ]);
    }

    public function continue_selling($product) {
        $this->model->findOrFail($product)->update([
            'status' => 1,
        ]);
        return redirect()->route('managerproduct_vendor.all')->with([
            'message' => 'Update status selling success!',
        ]);
    }

    public function detail($product) {

        $data = $this->model
        ->where('id', $product)
        ->with('category:id,name')
        ->with('subcategory:id,name')
        ->with('brand:id,brand_name')
        ->with('vendor:id,name,shop_name')
        ->get()->first();
        $multiple_image = MultipeImage::where('product_id', $product)->get();
        return view('vendor.manager_product.product_detail', [
            'data' => $data,
            'multiple_image' => $multiple_image,
        ]);
    }

    public function product_api_select() {
        $subcategory = Subcategory::select([
            'name',
            'id',
            'category_id',
        ])
        ->get();
        return $subcategory;
    }
}
