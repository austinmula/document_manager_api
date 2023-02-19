<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'success' => true,
            'data' => $roles
        ]);
    }

    public function show($id)
    {
//        $file = auth()->user()->files()->find($id);
        $role =Role::all()->find($id);

        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $role->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;

        if ($role->save())
            return response()->json([
                'success' => true,
                'data' => $role->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Role not saved'
            ], 500);
    }

    public function update(Request $request, $id)
    {
//        $dept = auth()->user()->files()->find($id);
        $role =Role::all()->find($id);

        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found'
            ], 400);
        }

        $updated = $role->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Role cannot be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $role =Role::all()->find($id);

        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found'
            ], 400);
        }

        if ($role->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role can not be deleted'
            ], 500);
        }
    }
}
