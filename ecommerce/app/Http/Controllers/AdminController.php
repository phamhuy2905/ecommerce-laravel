<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        $id = auth()->id();
        $data = User::select('name', 'id', 'photo')->where('id', $id)->get()->first();
        return view('admin.index', [
            'data' => $data,
        ]);
    }

    public function login() {
        return view('admin.login');
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
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function profile() {
        $id = auth()->user()->id;
        $data = User::find($id);
        return view('admin.profile', [
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
            $file->move(public_path('img/adm_img'), $file_name);
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
}
