<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mail\VerifAccount;
use App\Mail\NotVerifAccount;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')
            ->where('verified', 0)
            ->whereNull('admin_id')
            ->paginate(5);

        return view('admin.verify-account')
            ->with('users', $users);
    }

    public function send(Request $request, $id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        $update = DB::table('users')
            ->where('id', $id)
            ->update([
                'verified' => 1,
                'admin_id' => Auth::guard('admin')->id()
            ]);
        $to_name = $user->nama;
        $to_email = $user->email;
        // dd($user);

        $data = array('name' => "E-lang", 'body' => "Account Verify");

        Mail::to($to_email)->send(new VerifAccount($user));

        // Mail::send('mail', $data, function ($message) use ($to_name, $to_email) {
        //     $message->to($to_email, $to_name)
        //         ->subject('Laravel Test Mail');
        //     $message->from('e.lang@elang.com', 'Account');
        // });

        return 'Email sent Successfully';
    }

    public function decl(Request $request, $id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        $update = DB::table('users')
            ->where('id', $id)
            ->update([
                'verified' => 0,
                'admin_id' => Auth::guard('admin')->id()
            ]);
        $to_email = $user->email;
        // dd($user);


        Mail::to($to_email)->send(new NotVerifAccount($user));

        // Mail::send('mail', $data, function ($message) use ($to_name, $to_email) {
        //     $message->to($to_email, $to_name)
        //         ->subject('Laravel Test Mail');
        //     $message->from('e.lang@elang.com', 'Account');
        // });

        return 'Email sent Successfully';
    }
}
