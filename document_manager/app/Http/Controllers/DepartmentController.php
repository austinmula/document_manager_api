<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        $depts = Department::all();
        return response()->json([
            'success' => true,
            'data' => $depts
        ]);
    }

    public function show($id)
    {
//        $file = auth()->user()->files()->find($id);
        $depts =Department::all()->find($id);

        if (!$depts) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $depts->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $dept = new Department();
        $dept->name = $request->name;

        if ($dept->save())
            return response()->json([
                'success' => true,
                'data' => $dept->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Department not added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
//        $dept = auth()->user()->files()->find($id);
        $dept =Department::all()->find($id);

        if (!$dept) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found'
            ], 400);
        }

        $updated = $dept->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Department can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $dept =Department::all()->find($id);

        if (!$dept) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found'
            ], 400);
        }

        if ($dept->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Department can not be deleted'
            ], 500);
        }
    }
}
