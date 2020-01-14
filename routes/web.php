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


Route::get('/', function () { return view('welcome'); });

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {

    Route::get('filmes', function () { return view('conteudo', [
            'currentPage' => 'filmes',
            'pageTitle' => 'Filmes',
        ]); });
    Route::get('filmes/{id}', function($id=0) {
        $users = DB::table('users')->get();
        return view('conteudo',[
            'currentPage' => 'filmes',
            'pageTitle' => 'Filmes',
            'id' => $id,
            'users' => $users
        ]);
    });

    Route::get('series', function () { return view('conteudo', [
            'currentPage' => 'series',
            'pageTitle' => 'Séries',
        ]); });
    Route::get('series/{id}', function($id=0) {
        $users = DB::table('users')->get();
        return view('conteudo',[
            'currentPage' => 'series',
            'pageTitle' => 'Séries',
            'id' => $id,
            'users' => $users
        ]);
    });

    Route::get('outros', function () { return view('conteudo', [
            'currentPage' => 'outros',
            'pageTitle' => 'Outros',
        ]); });
    Route::get('outros/{id}', function($id=0) {
        $users = DB::table('users')->get();
        return view('conteudo',[
            'currentPage' => 'outros',
            'pageTitle' => 'Outros',
            'id' => $id,
            'users' => $users
        ]);
    });

    Route::get('perfil', function () { return view('profile'); });
    Route::get('verify', function () { return view('auth.verify'); });
});
