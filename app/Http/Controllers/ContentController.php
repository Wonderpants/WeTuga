<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function general(Request $request) {
        $user = $request->user();
        try {$underage = (boolean)$user->underage;} catch (\Exception $exception) {$underage = (boolean)0;}
        $pages = array( "movies" => 'movie', "series" => 'series', "others" => 'others', );
        foreach ($pages as &$page) {
            if ($underage) {
                $page = DB::table('content')
                    ->whereRaw("type='".$page."' and 18rated=false")
                    ->orderby("date", "desc")
                    ->limit(6)
                    ->get();
            } else {
                $page = DB::table('content')
                    ->where('type', $page)
                    ->orderby("date", "desc")
                    ->limit(6)
                    ->get();
            }
        }
        return view('index', [ 'pages' => $pages ]);
    }
    public function contentSeen(Request $request) {
        $user = $request->user();
        $content_id = $request['content_id'];
        $seen = DB::table('historic')->where([['user_id', $user->id], ['content_id', $content_id]])->get();
        if (count($seen) < 1) { DB::table('historic')->insert(['user_id' => $user->id, 'content_id' => $content_id]);
        } else { DB::table('historic')->where([['user_id', $user->id], ['content_id', $content_id]])->delete(); }
        return redirect()->back();
    }

    public function getSeries(Request $request) {
        $user = $request->user();
        $underage = (boolean)$user->underage;
        $tvShow_id = $request->query->get('id');

        if ($tvShow_id) {
            $content = DB::table('content')->where([["type", "series"], ["id", $tvShow_id]])->first();
//            dd($content);
            $episodes = DB::table('content')->where('title', $content->title)->get();
            $cast = DB::table('crew')->where('content_id', $tvShow_id)->get();
            $seen = DB::table('historic')->where([['user_id', $user->id], ['content_id', $tvShow_id]])->get();
            return view('content.episode', [
                'currentPage' => 'series',
                'pageTitle' => 'series',
                'id' => $tvShow_id,
                'content' => $content,
                'episodes' => $episodes,
                'cast' => $cast,
                'seen' => $seen
            ]);
        }

        if ($underage) {
            $content = DB::table('content')
                ->whereRaw("type='series' and 18rated=false")
                ->orderby("date", "desc")
                ->limit(6)
                ->get();
        } else {
            $content = DB::table('content')
                ->where('type', 'series')
                ->orderby("date", "desc")
                ->limit(6)
                ->get();
        }
        return view('content.series', [
            'currentPage' => 'series',
            'pageTitle' => 'series',
            'contents' => $content
        ]);
    }
    public function seriesSearch(Request $request) {
        $user = $request->user();
        $underage = (boolean)$user->underage;
        if ($underage) {
            $content = DB::table('content')
                ->whereRaw("type='series' and 18rated=false and title like '%".$request->searchBox."%'")
                ->orderby("date", "desc")
                ->limit(6)
                ->get();
        } else {
            $content = DB::table('content')
                ->whereRaw("type='series' and title like '%".$request->searchBox."%'")
                ->orderby("date", "desc")
                ->limit(6)
                ->get();
        }
        return view('content.series', [
            'currentPage' => 'series',
            'pageTitle' => 'series',
            'contents' => $content
        ]);
    }

    public function getMovies(Request $request)
    {
        $user = $request->user();
        $underage = (boolean)$user->underage;
        $movie_id = $request->query->get('id');

        if ($movie_id) {
            $content = DB::table('content')->where([["type", "movie"], ["id", $movie_id]])->limit(1)->first();
            $cast = DB::table('crew')->where('content_id', $movie_id)->get();
            $seen = DB::table('historic')->where([['user_id', $user->id], ['content_id', $movie_id]])->get();
            $tempCast = array();
            foreach ($cast as $x ) { array_push($tempCast, $x->name); }
            $tempCast = array_slice($tempCast, 0, 3);
            return view('content.movie', [
                'currentPage' => 'movies',
                'pageTitle' => 'movies',
                'id' => $movie_id,
                'content' => $content,
                'cast' => $tempCast,
                'seen' => $seen
            ]);
        }

        if ($underage) {
            $content = DB::table('content')
                ->whereRaw("type='movie' and 18rated=false")
                ->orderby("date", "desc")
                ->limit(6)
                ->get();
        } else {
            $content = DB::table('content')
                ->where('type', 'movie')
                ->orderby("date", "desc")
                ->limit(6)
                ->get();
        }
        return view('content.movies', [
            'currentPage' => 'movies',
            'pageTitle' => 'movies',
            'contents' => $content
        ]);
    }
    public function movieSearch(Request $request) {
        $user = $request->user();
        $underage = (boolean)$user->underage;
        if ($underage) {
            $content = DB::table('content')
                ->whereRaw("type='movie' and 18rated=false and title like '%".$request->searchBox."%'")
                ->orderby("date", "desc")
                ->limit(6)
                ->get();
        } else {
            $content = DB::table('content')
                ->whereRaw("type='movie' and title like '%".$request->searchBox."%'")
                ->orderby("date", "desc")
                ->limit(6)
                ->get();
        }
        return view('content.movies', [
            'currentPage' => 'movies',
            'pageTitle' => 'movies',
            'contents' => $content
        ]);
    }

    public function contentInsert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:64',
            'date' => 'required|date',
            'contentType' => 'required|string',
            'season' => 'integer|nullable',
            'episode' => 'integer|nullable',
            'minutes' => 'required|integer|min:1',
            'description' => 'required|string|max:512',
            'classification' => 'required|integer|max:10|min:0',
            'genre' => 'required|string|max:256',
            'studio' => 'required|string|max:64',
            'video' => 'required|string|max:256',
            '+18' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->contentType != 'serie') {
            $found = DB::table('content')->where('name', $request->name)->get();
            if (sizeof($found) >= 1) {
                $validator->errors()->add('name', 'Já existe conteudo com esse nome.');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

        }
        $path = $request->file('image')->store('covers');
        DB::table('content')->insert(
            [
                'name' => $request->name,
                'date' => $request->date,
                'type' => $request->contentType,
                'season' => $request->season,
                'episode' => $request->episode,
                'minutes' => $request->minutes,
                'description' => $request->description,
                'classification' => $request->classification,
                'genre' => $request->genre,
                'studio' => $request->studio,
                'video' => $request->video,
                'image' => $path,
                '18rated' => $request["18+"]
            ]
        );
        return redirect()->back();
    }
}
