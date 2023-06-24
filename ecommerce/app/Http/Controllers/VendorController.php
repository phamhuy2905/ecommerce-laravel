<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new User())->query();
    }
    public function index() {
        $id = auth()->id();
        $data = User::find($id);
        return view('vendor.index', [
            'data' => $data,
        ]);
    }

    public function login() {
        return view('vendor.login');
    }
    public function process_login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        
        $url = '';
        if($request->user()->role == 'admin') {
            $url = '/admin';
        }
        else if($request->user()->role == 'vendor') {
            $url = '/vendor';
        }
        else if($request->user()->role == 'user') {
            $url = '/user/index';
        }
        return redirect()->intended($url);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('vendor.login');
    }

    public function profile() {
        $id = auth()->user()->id;
        $data = User::find($id);
        return view('vendor.profile', [
            'data' => $data,
        ]);
    }

    public function update_profile(Request $request) {
        $id = auth()->id();
        $data = User::find($id);
        // $data->name = $request->name;
        // $data->phone = $request->phone;
        // $data->address = $request->address;
        $data->update($request->only('name', 'phone', 'address'));
        if($request->file('photo')) {
            $file = $request->file('photo');
            $file_name = date('Ymdi').$file->getClientOriginalName();
            $file->move(public_path('img/user_img'), $file_name);
            $data->photo = $file_name;
        };
        $data->save();
        return redirect()->back()->with([
            'message_profile' => 'Setting profile updated successfully!'
        ]);
    }

    public function update_password(Request $request) {
        $id = auth()->id();
        $data = User::find($id);
        $current_password = $request->old_password;
        $password = $request->password;
        if(!Hash::check($current_password, $data->password)) {
            return redirect()->back()->with([
                'message_password_error' => 'Mật khẩu hiện tại của bạn không chính xác!'
            ]);
        };
        $data->password = Hash::make($password);
        $data->save();
        return redirect()->back()->with([
            'message_password_success' => 'Thay đổi mật khẩu thành công!'
        ]);
    }

    public function register() {
        $provinces = \Kjmtrue\VietnamZone\Models\Province::get();
        $districts = \Kjmtrue\VietnamZone\Models\District::whereProvinceId(50)->get();
        $wards = \Kjmtrue\VietnamZone\Models\Ward::whereDistrictId(552)->get();
        return view('vendor.register', [
            'province' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ]);
    }

    public function process_register(Request $request) {
        $validated = $request->validate([
            'name' => [
                'bail',
                'required',
                'string',
            ],
            'email' => [
                'bail',
                'required',
                'email',
            ],
            'shop_name' => [
                'bail',
                'string',
                'required',
                'min:3',
            ],
            'password' => [
                'bail',
                'required',
                'string',
            ],
            'password_confirm' => [
                'bail',
                'confirmed',
            ],
            'address' => [
                'bail',
                'required',
            ],
            'role' => [
                'bail',
                Rule::in(['vendor']),
            ]
        ]);

        $this->model->insert([
            'name' => $request->name,
            'email' => $request->email,
            'shop_name' => $request->shop_name,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'vendor_info' => $request->vendor_info,
            'role' => 'vendor',
        ]);

        return redirect()->route('vendor.login')->with([
            'type' => 'message_success',
            'message' => 'Thêm subcategory thành công!',
            'email' =>  $request->email,
        ]);
    }
}
