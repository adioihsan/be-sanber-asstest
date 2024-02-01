<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public function getById($id_book)
    {
        $book = Book::find($id_book);
        if($book) return $book;
        throw new ModelNotFoundException("Cant find book with id : ".$id_book);
    }
    public function filter(Request $request){
        $queries = $request->query();
        $books = Book::query();
        if($request->has('title'))
            $books->where('title','LIKE',"%{$request->query('title')}%");
        if($request->has('minYear') || $request->has('maxYear')){
            $minYear = $request->query('minYear') ?? 1980;
            $maxYear = $request->query('maxYear') ?? 2021;
            $books->whereBetween('release_year',[$minYear,$maxYear]);
        }
        if($request->has('minPage') || $request->has('maxPage')){
            $minPage = $request->query('minPage') ?? 1;
            $maxPage = $request->query('maxPage') ?? 99999;
            $books->whereBetween('total_page',[$minPage,$maxPage]);
        }
        if($request->has('sortByTitle')){
            $sort = $request->query('sortBy')  == "asc" ?  "asc" : "desc";
            $books->orderBy('title',$sort);
        }
        return $books->paginate(18);
    }
}