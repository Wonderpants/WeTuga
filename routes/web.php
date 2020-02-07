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

Route::get('/', ['uses' => 'ContentController@general'])->name('home');

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {

    Route::prefix('filmes')->group(function () {
        Route::get('/', ['uses' => 'ContentController@getMovies'])->name('movies');
        Route::post('/', ['uses' => 'ContentController@contentSeen'])->name('movie.seen');
        Route::post('search', ['uses' => 'ContentController@movieSearch'])->name('movie.search');
    });

    Route::prefix('series')->group(function () {
        Route::get('/', ['uses' => 'ContentController@getSeries'])->name('series');
        Route::post('/', ['uses' => 'ContentController@contentSeen'])->name('series.seen');
        Route::post('search', ['uses' => 'ContentController@seriesSearch'])->name('series.search');
    });

    Route::get('outros', function () {
        $content = getContent('others', Auth::user()->underage);
        return view('conteudo', [
            'currentPage' => 'others',
            'pageTitle' => 'others',
            'contents' => $content
        ]);
    })->name('others');
    Route::get('outros/{id}', function ($id = 0) {
        $content = DB::table('content')->where([["type", "other"], ["id", $id]])->limit(6)->get();
        return view('conteudo', [
            'currentPage' => 'others',
            'pageTitle' => 'others',
            'id' => $id,
            'contents' => $content
        ]);
    });

    Route::get('perfil', function () {
        $history = DB::table('content')
            ->join('historic', function ($join) {
                $join->on('content.id', '=', 'historic.content_id')
                    ->where('historic.user_id', '=', 5);
            })->select('content.*', 'historic.timestamp')
            ->orderBy('timestamp', 'desc')
            ->get();
        return view('users.profile', ['user' => Auth::user(), 'history' => $history]);
    })->name('profile');

    Route::get('verify', function () {
        return view('auth.verify');
    });
    Route::middleware('throttle:60,1')->group(function () {
        Route::patch('profile/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('dashboard', function () {
                return view('dashboard.index');
            })->name('admin.dashboard');

            Route::get('content', function () {
                return view('dashboard.content');
            })->name('admin.content');

            Route::post('content/submit',
                ['uses' => 'ContentController@contentInsert']
            )->name('dashboard.content.submit');
        });
    });

});
