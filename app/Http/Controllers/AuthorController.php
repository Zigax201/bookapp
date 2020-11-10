<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
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

    public function index()
    {
        return json_encode(Author::all());
    }

    public function getAuthorById($id)
    {
        $Author_by_id = Author::find($id);
        if (!$Author_by_id) {
            return response("Author Not Found", 404);
        }

        return response(json_encode($Author_by_id), 200);
    }

    public function postAuthor(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'biography' => 'required'
        ]);

        $Author = Author::create(
            $request->only(['name', 'gender', 'biography'])
        );

        return response()->json([
            'created' => true,
            'data' => $Author
        ], 201);
    }

    public function putAuthorById(Request $request, $id)
    {
        try {
            $Author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        $Author->fill(
            $request->only(['name', 'gender', 'biography'])
        );
        $Author->save();

        return response()->json([
            'updated' => true,
            'data' => $Author
        ], 200);
    }

    public function deleteAuthorById($id)
    {
        try {
            $Author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Author not found'
                ]
            ], 404);
        }

        $Author->delete();

        return response()->json([
            'deleted' => true
        ], 200);
    }


    //
}
