<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function user() {
        return Auth::user() ?? Auth::guard('admin')->user();
    }

    public static function check() {
        return (Auth::user() || Auth::guard('admin')->user()) ? true:false;
    }

    public static function role() {
        if (Auth::check()) return "user";
        elseif (Auth::guard('admin')->check()) return "admin";
        else return null;
    }
}
