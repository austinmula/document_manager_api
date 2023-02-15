<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $permissions = Permission::all();
        return response()->json([
            'success' => true,
            'data' => $permissions
        ]);
    }

    public function show($id)
    {
//        $file = auth()->user()->files()->find($id);
        $permission =Permission::all()->find($id);

        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $permission->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->slug = $request->slug;

        if ($permission->save())
            return response()->json([
                'success' => true,
                'data' => $permission->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Permission not saved'
            ], 500);
    }

    public function update(Request $request, $id)
    {
//        $dept = auth()->user()->files()->find($id);
        $permission =Permission::all()->find($id);

        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found'
            ], 400);
        }

        $updated = $permission->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Permission cannot be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $permission =Permission::all()->find($id);

        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found'
            ], 400);
        }

        if ($permission->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Permission can not be deleted'
            ], 500);
        }
    }
}
