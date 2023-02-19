<?php

namespace App\Http\Controllers;

use App\Models\FileCategory;
use Illuminate\Http\Request;

class FileCategoryController extends Controller
{
    //
    public function index()
    {
        $category = FileCategory::all();
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

}
