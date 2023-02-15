<?php

namespace App\Http\Controllers;

use App\Events\UserMadePermissionRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //
//    Get my requests
    public function index()
    {
        $requests = auth()->user()->requests;

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
//        dd(auth()->id());

        $new_request = new \App\Models\Request();

        $new_request->name = $request->name;
        $new_request->message = $request->message;
        $new_request->status_id = $request->status_id;
        $new_request->file_id = $request->file_id;
        $new_request->user_id = (auth()->id());
        $new_request->request_to = $request->request_to;

        if (auth()->user()->requests()->save($new_request)){
            event(new UserMadePermissionRequest('johndoe@mail.com', 'admin@admin.com', 'Hello Need Access to ...'));
            return response()->json([
                'success' => true,
                'data' => $new_request->toArray()
            ]);
        }

        else

            return response()->json([
                'success' => false,
                'message' => 'Request not added'
            ], 500);
    }

}
