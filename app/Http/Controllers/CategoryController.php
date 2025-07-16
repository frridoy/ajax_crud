<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('category.index');
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
            'category_status' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->category_name;
        $category->description = $request->category_description;
        $category->status = $request->category_status;
        $save = $category->save();
        if($save){
            return response()->json(['status' => 1, 'message' => 'Category Added Successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Category Not Added']);
        }
    }
}
