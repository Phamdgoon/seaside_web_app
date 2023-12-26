<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class SellerMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('username')) {
            $username = session('username');
            $user = User::where('username', $username)->first();
            if ( $user->id_role == 2) {
                $user = User_Permission::where('username', $username)->first();
                if ( $user->id_permission == 2) {               
                    return $next($request);
                }else{
                    return redirect()->route('seller.login');
                }
            }else{
                
                return redirect()->route('seller.login');
            }
        }
    }
}
