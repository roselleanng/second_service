<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;
use App\Traits\ApiResponser;

class BookController extends Controller
{
    use ApiResponser;
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $this->successResponse($books);
    }
    public function add(Request $request)
    {
        $rules = [
            'bookname' => 'required|max:150',
            'yearpublish' => 'required|max:150',
            'authorid' => 'required|not_in:0',
        ];
        $this->validate($request, $rules);
        $books = Book::create($request->all());
        return $this->successResponse(
            $books,
            Response::HTTP_CREATED
        );
    }
    /**
     * Obtains and show one user
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $books = Book::findOrFail($id);
        return $this->successResponse($books);

        // old code
        /*
        $user = User::where('userid', $id)->first();
        if($user){
        return $this->successResponse($user);
        }
        {
        return $this->errorResponse('User ID Does Not Exists',
        Response::HTTP_NOT_FOUND);
        }
        */
    }
    /**
     * Update an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'bookname' => 'required|max:150',
            'yearpublish' => 'required|max:150',
            'authorid' => 'required|not_in:0',
        ];
        $this->validate($request, $rules);

        $books = Book::findOrFail($id);

        $books->fill($request->all());
        // if no changes happen
        if ($books->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $books->save();
        return $this->successResponse($books);

        // old code
        /*
        $this->validate($request, $rules);
        //$user = User::findOrFail($id);
        $user = User::where('userid', $id)->first();
        if($user){
        $user->fill($request->all());
        // if no changes happen
        if ($user->isClean()) {
        return $this->errorResponse('At least one value must
        change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();
        return $this->successResponse($user);
        }
        {
        return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
        */
    }
    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $books = Book::findOrFail($id);
        $books->delete();
        return $this->successResponse($books);
        // old code
        /*
        $user = User::where('userid', $id)->first();
        if($user){
        $user->delete();
        return $this->successResponse($user);
        }
        {
        return $this->errorResponse('User ID Does Not Exists',
        Response::HTTP_NOT_FOUND);
        }
        */
    }
}