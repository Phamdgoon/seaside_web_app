<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\User_Permission;
use App\Models\ShopProfile;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class SellerController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|unique:user|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'account_name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'approved'=> 0,
            'avt' => 'https://eitrawmaterials.eu/wp-content/uploads/2016/09/person-icon.png',
            'email_verification_token' => Str::random(60),
        ]);
        $userPermission = new User_Permission();
        $userPermission->id_permission = 2;
        $userPermission->username = $user->username;
        $userPermission->save();

        Mail::to($user->email)->send(new VerifyEmail($user));

        Log::info('Email sent successfully');
        return redirect()->route('verify.email.custom')->with('success', 'Đăng ký thành công. Vui lòng kiểm tra email để xác thực tài khoản.');
    }

    public function verifyEmail($token)
    {
        // Tìm người dùng theo token
        $user = User::where('email_verification_token', $token)->first();

        // Kiểm tra xem người dùng có tồn tại không và email chưa được xác thực
        if ($user && !$user->email_verified) {
            // Cập nhật thông tin người dùng
            $user->email_verified = true;
            $user->email_verification_token = null;
            $user->save();

            return redirect()->route('verify.email.custom2')->with('success', 'Xác thực email thành công. Vui lòng <a href="' . route('complete.register') . '">cung cấp thông tin về cửa hàng</a> để hoàn tất đăng kí.');

            // return redirect()->route('verify.email.custom')->with('success', 'Xác thực email thành công. Bạn có thể <a href="' . route('login') . '">Đăng nhập ngay</a>. ');
        }

        return redirect()->route('verify.email.custom2')->with('error', 'Link xác thực không hợp lệ hoặc email đã được xác thực.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Kiểm tra cả trường email_verified và approved
            if ($user->email_verified == 1 && $user->approved == 1) {
                $id_permission = User_Permission::where('username', $user->username)->value('id_permission');
                session()->put('username', $user->username);

                if ($id_permission == 2) {
                    return redirect()->route('seller');
                } else {
                    return back()->with('fail', 'Không có quyền truy cập');
                }
            } else {
                // Người dùng chưa xác thực email hoặc chưa được phê duyệt
                auth()->logout(); // Đăng xuất người dùng
                if ($user->email_verified != 1) {
                    return back()->with('fail', 'Vui lòng xác thực email trước khi đăng nhập.');
                } elseif ($user->approved != 1) {
                    return back()->with('fail', 'Tài khoản chưa được phê duyệt.');
                }
            }
        } else {
            return back()->with('fail', 'Sai tên đăng nhập hoặc mật khẩu');
        }
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->back();
    }
}
