<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $files = File::whereHas('access_level' , function($query) use ( $user ){
            $query->where('role_id',$user->role_id);
        })->whereHas ('departments' , function($query) use ($user){
            $query->where('department_id',$user->department_id);
        })->get();

        $files_noaccess = File::with('departments')->whereDoesntHave('access_level' , function($query) use ( $user ){
            $query->where('role_id', '=', $user->role_id);
        })->get(["id", "name"]);

        $temporary = auth()->user()->temporary_files()->get();

        return response()->json([
            'success' => true,
            'data' => $files,
            'temp'=> $temporary->toArray(),
            'noaccess' => $files_noaccess
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
        ], 200);
    }

    public function store(Request $request){

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
            $departments =$request->departments;


            foreach ($departments as $department) {
                $file->departments()->attach($department);
                $file->save();
           }

            $roles =$request->roles;
            foreach ($roles as $role) {
                $file->access_level()->attach($role);
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
