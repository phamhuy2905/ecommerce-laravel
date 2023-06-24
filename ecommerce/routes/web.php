<?php

use App\Http\Controllers\Admin\ManagerVendor;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SlideController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\FrontEnd\CompareController;
use App\Http\Controllers\FrontEnd\WishlishController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vendor\ManagerOrderController;
use App\Http\Controllers\Vendor\ProductController as VendorProductController;
use App\Http\Controllers\VendorController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    // return view('welcom');
    return view('auth.login');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('user.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::group(['prefix'=>'admin', 'as'=>'admin.'], function() {
        Route::get('', action:[AdminController::class, 'index'])->name('index');
        Route::get('/destroy', action:[AdminController::class, 'destroy'])->name('destroy');
        Route::get('/profile', action:[AdminController::class, 'profile'])->name('profile');
        Route::post('/update_profile/{profile}', action:[AdminController::class, 'update_profile'])->name('update_profile');
        Route::post('/update_password', action:[AdminController::class, 'update_password'])->name('update_password');
    });

    // brand
    Route::group(['prefix'=>'brand', 'as'=>'brand.'], function() {
        Route::get('', action:[BrandController::class, 'index'])->name('index');
        Route::get('create', action:[BrandController::class, 'create'])->name('create');
        Route::post('store', action:[BrandController::class, 'store'])->name('store');
        Route::get('edit/{brand}', action:[BrandController::class, 'edit'])->name('edit');
        Route::post('update', action:[BrandController::class, 'update'])->name('update');
        Route::get('destroy/{brand}', action:[BrandController::class, 'destroy'])->name('destroy');
    });
    // end brandd

     // slider
     Route::group(['prefix'=>'slider', 'as'=>'slider.'], function() {
        Route::get('', action:[SlideController::class, 'index'])->name('index');
        Route::get('create', action:[SlideController::class, 'create'])->name('create');
        Route::post('store', action:[SlideController::class, 'store'])->name('store');
        Route::get('edit/{slider}', action:[SlideController::class, 'edit'])->name('edit');
        Route::post('update', action:[SlideController::class, 'update'])->name('update');
        Route::get('destroy/{slider}', action:[SlideController::class, 'destroy'])->name('destroy');
    });
    // end slider

     // coupon
     Route::group(['prefix'=>'coupon', 'as'=>'coupon.'], function() {
        Route::get('', action:[CouponController::class, 'index'])->name('index');
        Route::get('create', action:[CouponController::class, 'create'])->name('create');
        Route::post('store', action:[CouponController::class, 'store'])->name('store');
        Route::get('destroy/{coupon}', action:[CouponController::class, 'destroy'])->name('destroy');
    });
    // end coupon



    // category 
    Route::group(['prefix'=>'category', 'as'=>'category.'], function() {
        Route::get('', action:[CategoryController::class, 'index'])->name('index');
        Route::get('create', action:[CategoryController::class, 'create'])->name('create');
        Route::post('store', action:[CategoryController::class, 'store'])->name('store');
        Route::get('edit/{category}', action:[CategoryController::class, 'edit'])->name('edit');
        Route::post('update', action:[CategoryController::class, 'update'])->name('update');
        Route::get('destroy/{category}', action:[CategoryController::class, 'destroy'])->name('destroy');
    });
     
    // end category 

    // subcategory 
    Route::group(['prefix'=>'subcategory', 'as'=>'subcategory.'], function() {
        Route::get('', action:[SubcategoryController::class, 'index'])->name('index');
        Route::get('create', action:[SubcategoryController::class, 'create'])->name('create');
        Route::post('store', action:[SubcategoryController::class, 'store'])->name('store');
        Route::get('edit/{subcategory}', action:[SubcategoryController::class, 'edit'])->name('edit');
        Route::post('update', action:[SubcategoryController::class, 'update'])->name('update');
        Route::get('destroy/{subcategory}', action:[SubcategoryController::class, 'destroy'])->name('destroy');
        Route::post('destroy_all}', action:[SubcategoryController::class, 'destroy_all'])->name('destroy_all');
    });
    // end subcategory 

    // manager vendor 
    Route::group(['prefix'=>'managervendor', 'as'=>'managervendor.'], function() {
        Route::get('active', action:[ManagerVendor::class, 'active'])->name('active');
        Route::get('active_detail/{user}', action:[ManagerVendor::class, 'active_detail'])->name('active.detail');
        Route::get('inactive', action:[ManagerVendor::class, 'inactive'])->name('inactive');
        Route::get('inactive_detail/{user}', action:[ManagerVendor::class, 'inactive_detail'])->name('inactive.detail');
        Route::get('ExportExcel', action:[ManagerVendor::class, 'ExportExcel'])->name('export');
    });


    // product
    Route::group(['prefix'=>'managerproduct', 'as'=>'managerproduct.'], function() {
        Route::get('all', action:[ProductController::class, 'all'])->name('all');
        Route::get('add', action:[ProductController::class, 'add'])->name('add');
        Route::post('process_add', action:[ProductController::class, 'process_add'])->name('process_add');
        Route::get('edit/{product}', action:[ProductController::class, 'edit'])->name('edit');
        Route::post('update', action:[ProductController::class, 'update'])->name('update');
        Route::get('destroy/{product}', action:[ProductController::class, 'destroy'])->name('destroy');
        Route::get('detail/{product}', action:[ProductController::class, 'detail'])->name('detail');
        Route::get('status/{product}', action:[ProductController::class, 'updatestatus'])->name('updatestatus');
        Route::get('product_api_select', action:[ProductController::class, 'product_api_select'])->name('product_api_select');
    });

    // end product
});

Route::group(['prefix'=>'admin', 'as'=>'admin.'], function() {
    Route::get('/login', action:[AdminController::class, 'login'])->name('login');  
    Route::post('/process_login', action:[AdminController::class, 'process_login'])->name('process_login');
});

Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::group(['prefix'=>'vendor', 'as'=>'vendor.'], function() {
        Route::get('', action:[VendorController::class, 'index'])->name('index');
        Route::get('/destroy', action:[VendorController::class, 'destroy'])->name('destroy');
        Route::get('/profile', action:[VendorController::class, 'profile'])->name('profile');
        Route::post('/update_profile/{profile}', action:[VendorController::class, 'update_profile'])->name('update_profile');
        Route::post('/update_password', action:[VendorController::class, 'update_password'])->name('update_password');
    });


    Route::group(['prefix'=>'managerproduct_vendor', 'as'=>'managerproduct_vendor.'], function() {
        Route::get('all', action:[VendorProductController::class, 'all'])->name('all');
        Route::get('add', action:[VendorProductController::class, 'add'])->name('add');
        Route::post('process_add', action:[VendorProductController::class, 'process_add'])->name('process_add');
        Route::get('edit/{product}', action:[VendorProductController::class, 'edit'])->name('edit');
        Route::post('update', action:[VendorProductController::class, 'update'])->name('update');
        Route::get('stop_selling/{product}', action:[VendorProductController::class, 'stop_selling'])->name('stop_selling');
        Route::get('continue_selling/{product}', action:[VendorProductController::class, 'continue_selling'])->name('continue_selling');
        Route::get('detail/{product}', action:[VendorProductController::class, 'detail'])->name('detail');
        Route::get('product_api_select', action:[VendorProductController::class, 'product_api_select'])->name('product_api_select');
    });

    Route::group(['prefix'=>'managerorder', 'as'=>'managerorder.'], function() {
        Route::get('pending', action:[ManagerOrderController::class, 'OrderPending'])->name('pending');
        Route::get('acpect/{id}', action:[ManagerOrderController::class, 'Acpect'])->name('acpect');
        Route::get('detail/{id}', action:[ManagerOrderController::class, 'Detail'])->name('detail');
        Route::post('cancel/{id}', action:[ManagerOrderController::class, 'Cancel'])->name('cancel');
    });
});

Route::group(['prefix'=>'vendor', 'as'=>'vendor.'], function() {
    Route::get('/login', action:[VendorController::class, 'login'])->name('login');  
    Route::post('/process_login', action:[VendorController::class, 'process_login'])->name('process_login');
    Route::get('/register', action:[VendorController::class, 'register'])->name('register');  
    Route::post('/process_register', action:[VendorController::class, 'process_register'])->name('process_register');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::group(['prefix'=>'user', 'as'=>'user.'], function() {
        Route::get('/index', action:[UserController::class, 'index'])->name('index');
        Route::post('/destroy', action:[UserController::class, 'destroy'])->name('destroy');
        Route::get('/profile', action:[UserController::class, 'profile'])->name('profile');
        Route::post('/reset_password', action:[UserController::class, 'reset_password'])->name('reset_password');
        Route::post('/edit_profile', action:[UserController::class, 'edit_profile'])->name('edit_profile');
    });

    Route::group(['prefix'=>'cart', 'as'=>'cart.'], function() {
        Route::post('getApi/{cart}', action:[CartController::class, 'add_Cart'])->name('getApi');
        Route::get('Add_mini_cart', action:[CartController::class, 'Add_mini_cart'])->name('Add_mini_cart');
        Route::get('remove_cart/{cart}', action:[CartController::class, 'Remove_cart'])->name('remove_cart');
        Route::get('detail/{cart}', action:[CartController::class, 'Detail'])->name('detail');
        Route::get('all', action:[CartController::class, 'all'])->name('all');
        Route::get('increment/{cart}', action:[CartController::class, 'increment'])->name('increment');
        Route::get('minus/{cart}', action:[CartController::class, 'minus'])->name('minus');
        Route::get('apply_discount/{cart}', action:[CartController::class, 'apply_discount'])->name('apply_discount');
    });
    
    Route::group(['prefix'=>'wishlist', 'as'=>'wishlist.'], function() {
        Route::get('add/{wishlist}', action:[WishlishController::class, 'add'])->name('add');
        Route::get('show', action:[WishlishController::class, 'show'])->name('show');
        Route::get('count', action:[WishlishController::class, 'count'])->name('count');
        Route::get('destroy/{wishlist}', action:[WishlishController::class, 'destroy'])->name('destroy');
    });
    
    Route::group(['prefix'=>'compare', 'as'=>'compare.'], function() {
        Route::get('add/{compare}', action:[CompareController::class, 'add'])->name('add');
        Route::get('show', action:[CompareController::class, 'show'])->name('show');
        Route::get('count', action:[CompareController::class, 'count'])->name('count');
        Route::get('destroy/{compare}', action:[CompareController::class, 'destroy'])->name('destroy');
    });


    Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function() {
        Route::get('/', [CheckOutController::class, 'index'])->name('index');
        Route::post('/processcheckout', [CheckOutController::class, 'processcheckout'])->name('processcheckout');
        Route::get('/vieworder/{id}', [CheckOutController::class, 'Vieworder'])->name('vieworder');
        Route::get('/remove_detail/{bill}/{detail}', [CheckOutController::class, 'remove_detail'])->name('remove_detail');
    });
});


Route::group(['prefix'=>'user', 'as'=>'user.'], function() {
    Route::get('/login', [UserController::class, 'login'])->name('login');  
    Route::post('/process_login', [UserController::class, 'process_login'])->name('process_login');  
});


Route::group(['prefix'=>'managerproduct', 'as'=>'managerproduct.'], function() {
    Route::get('getApi/{product}', action:[ProductController::class, 'getApi'])->name('getApi');
});



Route::group(['prefix'=>'address', 'as'=>'address.'], function() {
    Route::get('/', action:[UserController::class, 'address'])->name('get');
    Route::get('/districts/{id}', action:[UserController::class, 'districts'])->name('districts');
    Route::get('/wards/{id}', action:[UserController::class, 'wards'])->name('wards');
});









Route::group(['prefix' => 'auth', 'as' => 'social.'], function() {
    Route::get('/{provider}', [TestApiController::class, 'index'])->name('get');
    Route::get('/callback/{provider}', [TestApiController::class, 'callback'])->name('view');
});

Route::get('/test', [TestApiController::class, 'test'])->name('test');
Route::post('/form', [TestApiController::class, 'form'])->name('form');

require __DIR__.'/auth.php';


































// Route::get('api', [TestApiController::class, 'index'])->name('api.index');
// Route::get('view', [TestApiController::class, 'view'])->name('api.view');
