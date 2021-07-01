<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show() {
        $user  = Auth::user();

        return view('profile.show')
        ->with('user', $user);
    }

    public function update(Request $request) {
        try {
            $user  = Auth::user();

            $this->validate($request,[
                'phone' => 'numeric'
            ]);

            if ($request->nama) {
                $user->nama = $request->nama;
            }

            if ($request->alamat) {
                $user->alamat = $request->alamat;
            }

            if ($request->phone) {
                $user->nomor_telpon = $request->phone;
            }

            if ($request->file('photo')) {
                // photo process
                $photo = $request->file('photo');
                $content = file_get_contents($photo->getRealPath());
                $photo_ext = $photo->getClientOriginalExtension();
                $file_name = $user->id . ((string) Str::uuid()) . '.' . $photo_ext;
                Storage::put('public/barangku/' . $file_name, $content);
                $user->photo = asset('storage/barangku/' . $file_name);
            }

            $user->verified = 0;
            $user->admin_id = null;

            $user->save();

            return redirect()
            ->back()
            ->with('success','Update success');

        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->with('error', $th->getMessage());
        }
    }
}
