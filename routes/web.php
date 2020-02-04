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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $pages = array(
        "movies" => DB::table('content')->where('type', 'movie')->orderby("date", "desc")->limit(6)->get(),
        "series" => DB::table('content')->where('type', 'series')->limit(6)->get(),
        "others" => DB::table('content')->where('type', 'other')->limit(6)->get(),
    );
    return view('welcome', [
        'pages' => $pages
    ]);
})->name('home');

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {

    Route::get('filmes', function () {
        $content = DB::table('content')->where("type", "movie")->limit(6)->get();
        return view('conteudo', [
            'currentPage' => 'filmes',
            'pageTitle' => 'Filmes',
            'contents' => $content
        ]);
    })->name('movies');
    Route::get('filmes/{id}', function ($id = 0) {
        $content = DB::table('content')->where([["type", "movie"], ["id", $id]])->limit(6)->get();
        return view('conteudo', [
            'currentPage' => 'filmes',
            'pageTitle' => 'Filmes',
            'id' => $id,
            'contents' => $content
        ]);
    });

    Route::get('series', function () {
        $content = DB::table('content')->where("type", "series")->limit(6)->get();
        return view('conteudo', [
            'currentPage' => 'series',
            'pageTitle' => 'Séries',
            'contents' => $content
        ]);
    })->name('series');
    Route::get('series/{id}', function ($id = 0) {
        $content = DB::table('content')->where([["type", "series"], ["id", $id]])->limit(6)->get();
        return view('conteudo', [
            'currentPage' => 'series',
            'pageTitle' => 'Séries',
            'id' => $id,
            'contents' => $content
        ]);
    });

    Route::get('outros', function () {
        $content = DB::table('content')->where("type", "other")->limit(6)->get();
        return view('conteudo', [
            'currentPage' => 'outros',
            'pageTitle' => 'Outros',
            'contents' => $content
        ]);
    })->name('others');
    Route::get('outros/{id}', function ($id = 0) {
        $content = DB::table('content')->where([["type", "other"], ["id", $id]])->limit(6)->get();
        return view('conteudo', [
            'currentPage' => 'outros',
            'pageTitle' => 'Outros',
            'id' => $id,
            'contents' => $content
        ]);
    });

    Route::get('perfil', function () {
        return view('users.profile', ['user' => Auth::user()]);
    })->name('profile');

    Route::get('verify', function () {
        return view('auth.verify');
    });
    Route::middleware('throttle:60,1')->group(function () {
        Route::patch('profile/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
    });

    Route::middleware(['isAdmin'])->group(function() {
        Route::name('admin.')->group(function () {

            Route::get('dashboard', function () {
                return view('home');
            })->name('dashboard');

        });
    });

});
