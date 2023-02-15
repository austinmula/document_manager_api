<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function store(Request $request)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id'=> $request->role,
            'department_id'=> $request->department
        ]);

//        send user an email

        if ($user)
            return response()->json([
                'success' => true,
                'data' => $user->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'User not created'
            ], 500);

//        $sendToEmail = strtolower($request->email);
//        if(!empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL)){
//            Mail::to($sendToEmail)->send(new NewUserMail($request));
//        }

//        return back()->with(['message' => 'Email successfully sent!']);
//        return redirect('/users');
    }
}
