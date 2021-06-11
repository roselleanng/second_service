<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

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
    $router->get('/users', ['uses' => 'UserController@getUsers']);
});

//Authors
$router->get('/authors', 'AuthorController@index'); // Get all authors from Authors Service
$router->post('/authors', 'AuthorController@add'); // Create a new author from Authors Service
$router->get('/authors/{id}', 'AuthorController@show'); // Get the author info based on author id from Authors Service
$router->put('/authors/{id}', 'AuthorController@update'); // Update a author record based on author id from Authors Service
$router->delete('/authors/{id}', 'AuthorController@delete'); // Delete author record based on author id from Authors Service