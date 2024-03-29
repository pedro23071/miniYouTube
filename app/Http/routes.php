<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home',array(
    'as' => 'home',
    'uses' => 'HomeController@index'
)); 

//Rutas del controlador de video 
Route::get('/crear-video', array(
    'as' => 'createVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@createVideo'
));

//Rutas del controlador de video 
Route::post('/guardar-video', array(
    'as' => 'saveVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@saveVideo'
));

//ruta para las imagenes 
Route::get('/miniatura/{filename}', array(
    'as' => 'imageVideo',
    'uses' => 'VideoController@getImage'
));

//ruta description video 
Route::get('/video/{video_id}', array(
    'as' => 'detailVideo',
    'uses' => 'VideoController@getVideoDetail'
));

//ruta para los videos 
Route::get('/video-file/{filename}', array(
    'as' => 'fileVideo',
    'uses' => 'VideoController@getVideo'
));

//comentarios 
Route::post('/comment', array(
    'as' => 'comment',
    'uses' => 'CommentController@store'
));
//eliminar comentario
Route::get('/delete-comment/{comment_id}', array(
    'as' => 'commentDelete',
    'middleware' => 'auth',
    'uses' => 'CommentController@delete'
));

//eliminar video
Route::get('/delete-video/{video_id}', array(
    'as' => 'videoDelete',
    'middleware' => 'auth',
    'uses' => 'VideoController@delete'
));


//editar cideo
Route::get('/editar-video/{video_id}', array(
    'as' => 'videoEdit',
    'middleware' => 'auth',
    'uses' => 'VideoController@edit'
));

//Rutas del controlador de video 
Route::post('/update-video/{video_id}', array(
    'as' => 'updateVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@update'
));
