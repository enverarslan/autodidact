<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::pattern('pid', '[a-z0-9]{8}');
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9\-]+');
Route::pattern('host', '.*');


Route::group(['middleware'=>'auth'], function(\Illuminate\Routing\Router $router){

    $router->get('/', ['as'=>'home', 'uses'=>'TopicController@index']);
    $router->get('t/{slug}-{pid}', ['as'=>'topics.show', 'uses'=>'TopicController@show']);
    $router->get('t/{pid}', ['as'=>'topics.permalink', 'uses'=>'TopicController@permalink']);


    $router->delete('t/{pid}', ['as'=>'topics.destroy', 'uses'=>'TopicController@destroy']);
    $router->post('t/{pid}', ['as'=>'topics.comment', 'uses'=>'TopicController@comment']);
    $router->delete('c/{pid}', ['as'=>'topics.comment.destroy', 'uses'=>'TopicController@commentDestroy']);

    $router->get('/ekle', ['as'=>'topics.create', 'uses'=>'TopicController@create']);
    $router->post('/ekle', ['as'=>'topics.store', 'uses'=>'TopicController@store']);

    $router->get('site/{host}', ['as'=>'topics.site', 'uses'=>'TopicController@host']);

    $router->get('i/topics', ['as'=>'topics.list', 'uses'=>'TopicController@getTopicList']);

    $router->get('ara/{q?}', ['as'=>'topics.search', 'uses'=>'TopicController@search']);
});






/** TODO: Make proper image response with cache. */
Route::get('i/{username}.png', function ($username){
    $image = Avatar::create($username)->getImageObject();
    return $image->response();
    //return response($image, 200, ['Content-Type'=>'image/png']);
})->name('user.avatar');


Route::
    prefix('auth')
    ->name('auth.')
    //->middleware(['auth:admin', 'admin'])
    ->group(function (\Illuminate\Routing\Router $router) {
        $router->get('/login', ['as' => 'login', 'uses' => 'AuthController@login']);
        $router->post('/login', ['as' => 'login_attempt', 'uses' => 'AuthController@login_attempt']);
        $router->get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

        $router->get('/register', ['as' => 'register', 'uses' => 'AuthController@register']);
        $router->post('/register', ['as' => 'register_attempt', 'uses' => 'AuthController@register_attempt']);

    });
