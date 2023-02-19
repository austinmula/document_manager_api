<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemporaryFilesController extends Controller
{

    public function index()
    {

        $user = auth()->user();

        $requests = \App\Models\Request::with('file', 'user', 'status')->where('request_to', $user->id)->get();

        return response()->json([
            'success' => true,
            'data' => $requests
        ]);
    }
    public function store(Request $request)
    {

//        find file using its id

   
//        attach the
//        $new_request = new \App\Models\Request();
//
//        $new_request->name = $request->name;
//        $new_request->message = $request->message;
//        $new_request->status_id = $request->status_id;
//        $new_request->file_id = $request->file_id;
//        $new_request->user_id = (auth()->id());
//        $new_request->request_to = $request->request_to;




//        if (auth()->user()->requests()->save($new_request)){
//            event(new UserMadePermissionRequest('johndoe@mail.com', 'admin@admin.com', 'Hello Need Access to ...'));
//            return response()->json([
//                'success' => true,
//                'data' => $new_request->toArray()
//            ]);
//        }

//        else
//
//            return response()->json([
//                'success' => false,
//                'message' => 'Request not added'
//            ], 500);
    }
}
