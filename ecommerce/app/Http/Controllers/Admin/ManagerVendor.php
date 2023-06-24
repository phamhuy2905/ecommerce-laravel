<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

class ManagerVendor extends Controller
{
    protected Builder $model;

    public function __construct()
    {
        $this->model = (new User())->query();
        $name_route = Route::currentRouteName();
        $name_route = explode('.', $name_route);
        $name_route = array_map('ucfirst', $name_route);
        $title = implode('-',$name_route);
        view()->share([
           'title' => $title, 
            'name_sidebar' => $name_route[0], 
        ]);
    }
    public function active() {
        $data = $this->model->select([
            'id',
            'name',
            'phone',
            'email',
            'address',
            'shop_name',
            'created_at',
        ])
        ->where('status', 'active')
        ->where('role', 'vendor')
        ->get();
        // dd($data);
        return view('backend.manager_vendor.vendor_active',[
            'data' => $data,
        ]);
    }

    public function active_detail(User $user) {
        return view('backend.manager_vendor.vendor_active_detail',[
            'data' => $user,
        ]);
    }

    public function inactive() {
        $data = $this->model->select([
            'id',
            'name',
            'phone',
            'email',
            'address',
            'shop_name',
            'created_at',
        ])
        ->where('status', 'inactive')
        ->where('role', 'vendor')
        ->get();
        return view('backend.manager_vendor.vendor_inactive',[
            'data' => $data,
        ]);
    }

    public function inactive_detail(User $user) {
        return view('backend.manager_vendor.vendor_inactive_detail',[
            'data' => $user,
        ]);
    }

    public function ExportExcel() {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}
