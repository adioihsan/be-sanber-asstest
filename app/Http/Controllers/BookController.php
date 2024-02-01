<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    public function index(){
        $books = Book::paginate(18);
        $books_collection = BookResource::collection($books) ->response()->getData(true);
        return response()->api_ok("Books",$books_collection);
    }

    public function store(BookRequest $request){
        $book = Book::create($request->validatedBook());
        return response()->api_ok("Book created successfully",[$book],201);
    }

    public function update(BookRequest $request,string $id_book){
        $book = $this->getBookById($id_book);
        $book->update($request->validatedBook());
        $book = (new BookResource($book))->response()->getData(true);
        return response()->api_ok("Book updated successfully",$book,201);
    }


    public function destroy(string $id_book){
        $book = $this->getBookById($id_book);
        $book->delete();
       return response()->api_ok("Book deleted successfully",[]);
    }

    private function getBookById(string $id_book){
        $book = Book::find($id_book);
        if($book) return $book;
        throw new ModelNotFoundException("Cant find book with id : ".$id_book);
    }

}
