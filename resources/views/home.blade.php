@extends('layouts.app', ['currentPage' => 'home'])

@section('content')
    <h1><?php
        $content = \Illuminate\Support\Facades\Storage::get('1.jpg');
    ?></h1>
@endsection
