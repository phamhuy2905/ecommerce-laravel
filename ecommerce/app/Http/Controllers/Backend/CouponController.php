<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CouponController extends Controller
{
    private Builder $model;

    public function __construct()
    {
        $this->model = Coupon::query();
        $route_name = Route::currentRouteName();
        $route_name = explode('.', $route_name);
        $route_name = array_map('ucfirst', $route_name);
        $title = implode('-', $route_name);
        
        view()->share([
            'title' => $title,
            'name_sidebar' => $route_name[0],
        ]);
    }

    public function index() {
        $data = $this->model->get();
        return view('backend.coupon.all_coupon', [
            'data' => $data,
        ]);
    }


    public function create() {
        return view('backend.coupon.add_coupon');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'discount' => [
                'bail',
                'required',
                'integer',
                'min:0',
                'max:30',
            ],
            'valid' => [
                'bail',
                'required',
                'after:' . Carbon::now('Asia/Ho_Chi_Minh')->subDay(),
            ],
            'time' => [
                'bail',
                'required',
                // 'after:' . Carbon::now('Asia/Ho_Chi_Minh')->toTimeString(),
            ]
        ]);
        $date = $request->valid.' '.$request->time;
        $date = date_create($date);
        $valid = date_format($date,"Y/m/d H:i:s");
        $this->model->insert([
            'name' => $request->name,
            'discount' => $request->discount,
            'valid' => $valid,
        ]);
        return redirect()->route('coupon.index')->with([
            'success' => 'Thêm coupon thành công!'
        ]);
    }


    public function destroy($coupon) {
        $this->model->findOrFail($coupon);
        Coupon::destroy($coupon);
        return redirect()->route('coupon.index')->with([
            'success_delete_slider' => 'Xóa coupon thành công!'
        ]);
    }

}
