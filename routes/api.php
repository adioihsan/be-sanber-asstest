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

Route::name("auth.")->prefix('auth')->group(function(){
    Route::post("/register",[RegisterController::class,"register"])->name("register");
    Route::post("/login",[LoginController::class,"login"])->name("login");
});

Route::name("category.")->prefix("categories")
->controller(CategoryController::class)->group(function(){
    // public access
    Route::get("/","index");
    Route::get("/{id_category}/books","getBooksByCategory")->name("books");
    //user only access
    Route::middleware("auth:sanctum")->group(function(){
        Route::post("/","store");
        Route::patch("/{id_category}","update");
        Route::delete("/{id_category}","destroy");
    });
});

Route::name('book.')->prefix("books")
->controller(BookController::class)->group(function(){
    // public access
    Route::get("/","index")->name("book.index");
    // user only access
    Route::middleware("auth:sanctum")->group(function(){
        Route::post("/","store")->name("store");
        Route::patch("/{id_book}","update")->name("update");
        Route::delete("/{id_book}","destroy");
    });

    // additional api for FE requirement
    Route::get("/{id_book}","show");
});

