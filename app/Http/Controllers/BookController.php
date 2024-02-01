<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService){
        $this->bookService = $bookService;
    }

    public function index(Request $request){
        $books =  $this->bookService->filter($request);
        $books_collection = BookResource::collection($books) ->response()->getData(true);
        return response()->api_ok("Books",$books_collection);
    }

    public function store(BookRequest $request){
        $book = Book::create($request->validatedBook());
        return response()->api_ok("Book created successfully",[$book],201);
    }

    public function update(BookRequest $request,string $id_book){
        $book = $this->bookService->getById($id_book);
        $book->update($request->validatedBook());
        $book = (new BookResource($book))->response()->getData(true);
        return response()->api_ok("Book updated successfully",$book,201);
    }

    public function destroy(string $id_book){
        $book = $this->bookService->getById($id_book);
        $book->delete();
       return response()->api_ok("Book deleted successfully",[]);
    }

}
