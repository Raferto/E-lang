<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')
            ->paginate(5);

        return view('admin.verify-account')
            ->with('users', $users);
    }
}
