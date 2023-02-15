<?php

namespace App\Http\Controllers;

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

    }

}
