<?php

namespace App\Http\Controllers;
use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return json_encode(Book::all());
    }

    public function getBookById($id){
        $book_by_id = Book::find($id);
        if(!$book_by_id){
            return response("Book Not Found", 404);
        }

        return response(json_encode($book_by_id), 200);
    }
    //
}
