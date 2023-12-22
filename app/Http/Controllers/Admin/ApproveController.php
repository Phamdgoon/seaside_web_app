<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApproveController extends Controller
{
    public function index()
    {
        $approve = User::join('shop_profile', 'user.username', '=', 'shop_profile.username')
            ->select('user.username', 'user.email', 'user.phone_number', 'user.approved', 'shop_profile.name_shop', 'shop_profile.address', 'shop_profile.description')
            ->get();

        return view('admin.approve.index', ['approve' => $approve]);
    }
    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            Session::flash('error', 'User not found');
        } else {
            $newStatus = filter_var($request->input('approved', 0), FILTER_VALIDATE_BOOLEAN);
            $user->approved = $newStatus;
            $user->save();
            Session::flash('success', 'Cập nhật phê duyệt tài khoản thành công');
            Session::flash('autoHide', true);
        }
        return redirect()->back();
    }
}
