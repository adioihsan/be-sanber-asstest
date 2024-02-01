<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{

    public function index(){
        try {
            $categories = Category::paginate(18);
            $categories_collection = CategoryResource::collection($categories) ->response()->getData(true);
        } catch (\Throwable $th) {
            Log::error("Category.index: ".$th);
            return response()->api_fail("Server Error!  : Cant get categories",$th,500);
        }
        return response()->api_ok("categories",$categories_collection);
    }

    public function store(CategoryRequest $request){
        try {
            Category::create($request->all());
        } catch (\Throwable $th) {
            Log::error("Category.store: ".$th);
            return response()->api_fail("Server Error!  : Cant create category",[],500);
        }
        return response()->api_ok("Category created successesfully");
    }

}
