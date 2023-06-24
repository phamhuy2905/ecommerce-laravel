<?php

namespace App\Http\Controllers;

use App\Enums\ShipStatusEnum;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\ChangePassword;
use App\Http\Requests\User\EditProfileRequest;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new User())->query();
    }

    public function login() {
        return view('auth.login');
    }
    public function process_login(LoginRequest $request) {
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
            $url = 'user/index';
        }

        return redirect()->intended($url);
    }
    public function index() {
        return view('frontend.index');
    }

    public function destroy(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('user/login');
    }

    public function profile() {
       
        $id = auth()->id();
        $data = $this->model->find($id);
        return view('auth.reset-password', [
            'data' => $data,
        ]);
    }

    public function reset_password(Request $request) {
        $id = auth()->id();
        $data = User::find($id);
        $current_password = $data->password;
        if(!Hash::check($request->old_password, $current_password)) {
            return redirect()->back()->with([
                'message_error' => 'Mật khẩu hiện tại của bạn không chính xác!',
            ]);
        }
        $data->password = Hash::make($request->new_password);
        $data->save();
        return redirect()->back()->with([
            'message_success' => 'Thay đổi mật khẩu thành công!'
        ]);

    }


    public function edit_profile(Request $request) {
        $provinces = \Kjmtrue\VietnamZone\Models\Province::where('id', $request->provinces)->get()->first()->name ?? null;
        $districts = \Kjmtrue\VietnamZone\Models\District::where('id', $request->districts)->get()->first()->name ?? null;
        $wards = \Kjmtrue\VietnamZone\Models\Ward::where('id', $request->wards)->get()->first()->name ?? null;
        $id = auth()->id();
        $data = $this->model->find($id);
        $data->address = $provinces.', '.$districts.', '.$wards.', '. $request->address;
        $data->address =$request->address.' '.$wards.' '.$districts.' '.$provinces;
        $data->update($request->only('username','name','phone'));
        if($request->file('photo')) {
            $file = $request->file('photo');
            $file_name = date('Ymdi').$file->getClientOriginalName();
            $file->move(public_path('img/adm_img'), $file_name);
            $data->photo = $file_name;
        };
        $data->save();
        return redirect()->back()->with([
            'message_profile' => 'Setting profile updated successfully!'
        ]);
    }

    public function address() {
        $provinces = \Kjmtrue\VietnamZone\Models\Province::get();
        return $provinces;
    }

    public function districts($id) {
        $districts = \Kjmtrue\VietnamZone\Models\District::whereProvinceId($id)->get();
        return $districts;
    }

    public function wards($id) {
        $wards = \Kjmtrue\VietnamZone\Models\Ward::whereDistrictId($id)->get();
        return $wards;
    }
   
}
