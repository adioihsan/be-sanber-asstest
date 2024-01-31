<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(CategoryRequest $request){
        try {
            Category::create($request->all());
        } catch (\Throwable $th) {
            return response()->api_fail("Server Error!  : Cant create cateogory",$th,500);
        }
        return response()->api_ok("Category created successesfully");
    }
}
