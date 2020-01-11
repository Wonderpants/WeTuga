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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {
    Route::get('filmes', function () {

        return view('conteudo', [
            'currentPage' => 'filmes',
        ]);
    });
    Route::get('filmes/{id}', function($id=0) {
        $users = DB::table('users')->get();
        return view('conteudo',[
            'currentPage' => 'filmes',
            'id' => $id,
            'users' => $users
        ]);
    });

    Route::get('series', function () {
        return view('conteudo', [
            'currentPage' => 'series'
        ]);
    });

    Route::get('outros', function () {
        return view('conteudo', [
            'currentPage' => 'outros'
        ]);
    });

    Route::get('profile', function () {
        return view('welcome');
    });
    Route::get('verify', function () {
        return view('auth.verify');
    });
});
