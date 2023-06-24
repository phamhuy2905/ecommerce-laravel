<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class TestApiController extends Controller
{
    public function index($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $user = Socialite::driver($provider)->user();
        $message = "Nếu đăng nhập bằng Github1, bạn sẽ đồng bộ với tài khoản hiện tại nếu có. Bạn có đồng ý không?";
        return view('auth.callback', [
            'user' => $user,
            'message' => $message,
        ]);
    }

    public function test() {
        $data = DB::table('notifications')->where('notifiable_id', auth()->id())->where('read_at',null)->get();
        return $data;
    }

    public function form(Request $request) {
        $data = DB::table('notifications')->where('read_at', null)->update(['read_at' => now(),]);
        return response()->json([
           'success' => 'Thanh cong',
        ]);
    }
}





