<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Libraries\AuthHelper;
use Validator;

class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nomor_telpon' => 'required',
            'alamat' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create([
            'nama' => $request->name,
            'email' => $request->email,
            'nomor_telpon' => $request->nomor_telpon,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
        ]);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (! Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        }

        $user = AuthHelper::user();
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->nama;

        return $this->sendResponse($success, 'User login successfully.');
    }
}
