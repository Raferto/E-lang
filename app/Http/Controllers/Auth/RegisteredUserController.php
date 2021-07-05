<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_telpon' => 'required|unique:users',
            'alamat' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'photo' => 'required',
        ]);

        $photo = $request->file('photo');
        $content = file_get_contents($photo->getRealPath());
        $photo_ext = $photo->getClientOriginalExtension();
        $file_name = ((string) Str::uuid()) . '.' . $photo_ext;
        Storage::put('public/profile/' . $file_name, $content);

        $user = User::create([
            'nama' => $request->name,
            'email' => $request->email,
            'nomor_telpon' => $request->nomor_telpon,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'photo' => asset('storage/profile/' . $file_name)
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
