<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('QWERTYUIOPasdfghjkl1234567890')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::with('role.permissions', 'departments')->get()->where('email', $data['email'])->first();
//        dd($user->all());

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('QWERTYUIOPasdfghjkl1234567890')->accessToken;
            return response()->json(['token' => $token, 'user' => $user],  200);
        } else {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }
    }


    public function logout(Request $request)
    {
        auth()->guard('api')->user()->token()->revoke();
//        auth()->user()->token()->revoke();
//
        return response()->json(['message' => 'Successfully logged out'], 201);
    }
}
