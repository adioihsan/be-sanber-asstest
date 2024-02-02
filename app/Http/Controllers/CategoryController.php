<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\BookService;
use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CategoryController extends Controller
{

    public function index(){
            $categories = Category::paginate(18);
            $categories_collection = CategoryResource::collection($categories) ->response()->getData(true);
            return response()->api_ok("categories",$categories_collection);
    }
    
    public function store(CategoryRequest $request){
        Category::create($request->validated());
        return response()->api_ok("Category created successesfully");
    }

    public function update(CategoryRequest $request,string $id_category){
        $category = $this->getCategoryById($id_category);
        $category->update($request->validated());
        $category = (new CategoryResource($category))->response()->getData(true);
        return response()->api_ok("Category updated successfully",$category,201);
    }

    public function destroy(string $id_category){
        $category = $this->getCategoryById($id_category);
        $category->delete();
       return response()->api_ok("Category deleted successfully",[]);
    }

    public function getBooksByCategory(Request $request,string $id_category,BookService $bookService){
        $request->merge(["id_category"=>$id_category]);
        $books = $bookService->filter($request);
        $books_coletion = BookResource::collection($books)->response()->getData(true);
        return response()->api_ok("Books with category id:".$id_category,$books_coletion);
    }

    private function getCategoryById(string $id_category){
        $category = Category::find($id_category);
        if($category) return $category;
        throw new ModelNotFoundException("Cant find category with id : ".$id_category);
    }
}
