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
|<!DOCTYPE html>


/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/','Main@reg');
Route::post('/submit','Main@submit');
Route::get('/loginform','Main@lgfrm');
Route::post('/logincheck','Main@lgck');
Route::get('/welcome','Main@welcome');
Route::get('/logout','Main@logout');

//..................................................................................
Route::get('/photo','Main@photo');
Route::post('/picupload','Main@picupload');
Route::get('/delete/{id}','Main@delete');

//..........search...................................
Route::get('/search','Main@sview');
Route::post('/search','Main@search');

//----------------------details----------------------------
Route::get('/details/{id}','Main@details');



//like
Route::post('/like','Main@like');
Route::post('/removelike','Main@removelike');

//friend request portion
Route::post('/friendreqsend','Main@friendreqsend');
Route::get('/unfriend/{id}','Main@unfriend');

Route::get('/friendreqcancel/{id}','Main@friendreqcancel');
Route::get('/friendreqcancel2/{id}','Main@friendreqcancel2');
Route::post('/accept','Main@accept');


// chat start

Route::get('/chat','Main@chat' );
Route::get('/chatdetails{id}','Main@chatdetails' );

//

Route::post('/chatdb','Main@chatdb' );
//for set intervel
Route::post('/bb','Main@bb' );

//Dp
Route::post('/dp','Main@dp' );

//dynamic search
//Route::get('/se',"Main@s");

//for friendlist
Route::get('/friendlist','Main@friendlist' );

//for networks 
Route::get('/network','Main@network' );

//ajax delete req
Route::post('/cancel','Main@cancel' );

//newsfeed
Route::get('/nf','Main@nf' );






