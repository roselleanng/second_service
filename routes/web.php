<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/books', ['uses' => 'BookController@getUsers']);
});

//Books
$router->get('/books', 'BookController@index'); // Get all books from Books Service
$router->post('/books', 'BookController@add'); // Create a new book from Books Service
$router->get('/books/{id}', 'BookController@show'); // Get the book info based on book id from Books Service
$router->put('/books/{id}', 'BookController@update'); // Update a book record based on book id from Books Service
$router->delete('/books/{id}', 'BookController@delete'); // Delete a book record based on book id from Books Service