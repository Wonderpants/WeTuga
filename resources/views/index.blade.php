@extends('layouts.app', ['currentPage' => 'home'])

@section('content')
    @if(isset($pages))
        @foreach($pages as $page => $content)
            <div id="WTcontent">
                <div class="WTcenter">
                    <div style="text-align: center;">
                        <div id="movies-box" class="WTcontent-box">
                            <div class="WTbox-header shadow">
                                <input type="hidden" id="WTbox-media" value="movies">
                                <div class="movies-box-icon"></div>
                                <a href="{{ route($page) }}">
                                    <div class="WTbox-caption" style="width: initial;">{{ __($page) ?? '' }}</div>
                                </a>
                                @guest
                                @else
                                    <div class="WTbox-search">
                                        <form action="{{route('movie.search')}}" accept-charset="UTF-8" method="post"
                                              id="movies-searchForm">
                                            @csrf
                                            @method('POST')
                                            <label for="searchBox">
                                                <input type="text" autocomplete="false" name="searchBox" id="searchBox"
                                                       placeholder="Procure aqui por {{__($page)}}">
                                            </label>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <div id="movies-box-content" class="WTbox-content" style="padding:15px">
                                <div class="WTbox-media">
                                    <div class="WTlist-content">
                                        <div id="movies-list" class="WTmovies-list">
                                            <div id="tabelafilmes" class="WTlist-aux WTlist-content"
                                                 style="height:450px; overflow-x:hidden;overflow-y:auto;white-space:nowrap">
                                                @guest
                                                    @foreach($content as $x)
                                                        <div id="5" class="WTitem">
                                                            <a>
                                                                <img src="{{Storage::url($x->image)}}"
                                                                     alt="{{$x->title}}"
                                                                     title="{{$x->title}}" width="128" height="190">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach($content as $x)
                                                        <div id="5" class="WTitem">
                                                            <a href="{{ URL::route($page,['id'=>$x->id]) }}">
                                                                <img src="{{Storage::url($x->image)}}"
                                                                     alt="{{$x->title}}"
                                                                     title="{{$x->title}}" width="128" height="190">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <h1>Error Page</h1>
    @endif
@endsection
