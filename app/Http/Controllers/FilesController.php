<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    public function index()
    {
//        Get my role and department
        $role_id = Auth::user()->role_id;

        $files = File::with('access_level')->get();
        dd($files);
        if($role_id === config('constants.MANAGER_ROLE_ID')){
            $files = File::all();
        }else{
            $files = File::where('role_id','>=' ,$role_id);
        }


        return response()->json([
            'success' => true,
            'data' => $files
        ]);
    }

    public function show($id)
    {
        $file = auth()->user()->files()->find($id);

        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'File not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $file->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'name' => 'required',
        ]);

        $file = new File();
        $file->name = $request->name;
        $file->category_id = $request->category;
        $file->user_id = (auth()->id());

        $url = null;
        if ($request->hasFile('file')) {
            $url = $request->file('file')->store(
                'files',
                'public',
            );
        }

        $file->url = $url;


        if (auth()->user()->files()->save($file)){
            $departments = $request->departments;
            $roles =$request->roles;

            foreach ($roles as $role) {
                $file->roles()->attach($role);
                $file->save();
            }
            foreach ($departments as $department) {
                $file->roles()->attach($department);
                $file->save();
            }

            return response()->json([
                'success' => true,
                'data' => $file->toArray()
            ]);
        }
        else
            return response()->json([
                'success' => false,
                'message' => 'File not added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $file = auth()->user()->files()->find($id);

        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 400);
        }

        $updated = $file->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'File can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $file = auth()->user()->files()->find($id);

        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 400);
        }

        if ($file->delete()) {
            $file->deleted_by = auth()->id();
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'File can not be deleted'
            ], 500);
        }
    }
}
