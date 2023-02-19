<?php

namespace App\Http\Controllers;

use App\Events\UserMadePermissionRequest;
//use App\Models\Request;
use App\Models\User;
use Illuminate\Http\Request;


class RequestController extends Controller
{
    //
//    Get my requests
    public function index()
    {

        $user = auth()->user();
//        $requests = \App\Models\Request::with('file', 'status')->get()->where('user_id', $user->id)->toArray();
        $requests = \App\Models\Request::with('file', 'status')->where('user_id', $user->id)->get();

        return response()->json([
            'success' => true,
            'data' => $requests
        ]);
    }

    public function show($id)
    {
        $request = auth()->user()->requests()->find($id);

        if (!$request) {
            return response()->json([
                'success' => false,
                'message' => 'Request was not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' =>   $request->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'file_id'=> 'required',
            'department_id'=> 'required'
        ]);
        $new_request = new \App\Models\Request();


        $new_request->name = $request->name;
        $new_request->message = $request->message;
        $new_request->file_id = $request->file_id;
        $new_request->user_id = (auth()->id());

//        Find dept head using dept id
        $request_to = User::where('department_id', $request->department_id)
            ->where('role_id', 3)
            ->first();

//        dd($request_to);
        $new_request->request_to = $request_to->id;
        $receiverEmail = $request_to->email;

//       dd($new_request);
        $senderEmail = auth()->user()->email;

        if (auth()->user()->requests()->save($new_request)){
            event(new UserMadePermissionRequest($senderEmail, $receiverEmail, $request->message));
            $resp = Request::with('file', 'status')->where('user_id', auth()->user()->id)->find($new_request->id);
            return response()->json([
                'success' => true,
                'data' => $resp
            ]);
        }

        else

            return response()->json([
                'success' => false,
                'message' => 'Request not added'
            ], 500);
    }

}
