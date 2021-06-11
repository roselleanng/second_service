<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Author;
use App\Traits\ApiResponser;

class AuthorController extends Controller
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
        $authors = Author::all();
        return $this->successResponse($authors);
    }
    public function add(Request $request)
    {
        $rules = [
            'fullname' => 'required|max:150',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required',
        ];
        $this->validate($request, $rules);
        $authors = Author::create($request->all());
        return $this->successResponse(
            $authors,
            Response::HTTP_CREATED
        );
    }
    /**
     * Obtains and show one user
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $authors = Author::findOrFail($id);
        return $this->successResponse($authors);

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
            'fullname' => 'required|max:150',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required',
        ];
        $this->validate($request, $rules);
        $authors = Author::findOrFail($id);

        $authors->fill($request->all());
        // if no changes happen
        if ($authors->isClean()) {
            return $this->errorResponse('At least one value must
change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $authors->save();
        return $this->successResponse($authors);

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
        return $this->errorResponse('User ID Does Not Exists',
        Response::HTTP_NOT_FOUND);
        }
        */
    }
    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $authors = Author::findOrFail($id);
        $authors->delete();
        return $this->successResponse($authors);
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