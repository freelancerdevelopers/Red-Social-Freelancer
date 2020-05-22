<?php

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

//use App\Image;



Route::get('/', function () {
//    $images = Image::all();
//    foreach ($images as $image){
//        echo "<p>".$image->images_path_image."</p>";
//        echo "<p>".$image->description_image."</p>";
//        echo "<p>".$image->user->name."</p>";
//        var_dump($image->comments);
//        echo "<hr>";
//        
//    }
//     die();
    return view('welcome');
});

Auth::routes();

//home
Route::get('/', 'HomeController@index')->name('home');


//usuario
Route::get('/config-user', 'UserController@config')->name('config');
Route::post('/user/user.update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/profile-user/{id}', 'UserController@profile')->name('profile');
Route::get('/listUser/{search?}', 'UserController@userlist')->name('users.list');

//Imagen
Route::get('/subir-image', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/image/{id_image}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');

//Comentarios
Route::post('/comment/save', 'CommetController@save')->name('comment.save');
Route::get('/comment/delete/{id_image}', 'CommetController@delete')->name('comment.delete');


//Likes
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');








