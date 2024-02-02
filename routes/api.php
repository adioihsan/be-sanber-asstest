<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// apis controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FilterBookController;

// auth controller
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/auth/register",[RegisterController::class,"register"])->name("auth.register");
Route::post("/auth/login",[LoginController::class,"login"])->name("auth.login");


Route::controller(CategoryController::class)->group(function(){
    Route::get("/categories","index");
    Route::post("/categories","store");
    Route::patch("/categories/{id_category}","update");
    Route::delete("/categories/{id_category}","destroy");
    Route::get("/categories/{id_category}/books","getBooksByCategory")->name("category.books");
});

Route::controller(BookController::class)->group(function(){
    Route::get("/books","index")->name("book.index");
    Route::post("/books","store")->name("book.store");
    Route::patch("/books/{id_book}","update")->name("book.update");
    Route::delete("/books/{id_book}","destroy");
});
