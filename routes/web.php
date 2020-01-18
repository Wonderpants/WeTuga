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
    $pages = array(
        "filmes" => DB::table('content')->where('type', 'movie')->orderby("date", "desc")->limit(6)->get(),
        "series" => DB::table('content')->where('type', 'series')->limit(6)->get(),
        "outros" => DB::table('content')->where('type', 'other')->limit(6)->get(),
    );
    return view('welcome', [
        'pages' => $pages
    ]);
});

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {

    Route::get('filmes', function () {
        $content = DB::table('content')->where("type", "movie")->limit(6)->get();
        return view('conteudo', [
            'currentPage' => 'filmes',
            'pageTitle' => 'Filmes',
            'contents' => $content
        ]);
    });
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
    });
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
    });
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
        return view('profile');
    });
    Route::get('verify', function () {
        return view('auth.verify');
    });
});
