@extends('layouts.app', ['currentPage' => 'home'])

@section('content')
    @if(isset($pages))
        @foreach($pages as $page => $content)
            <div id="WTcontent">
                <div class="WTcenter">
                    <div style="text-align: center;">
                        <div id="movies-box" class="WTcontent-box">
                            <a href="/{{$page}}">
                                <div class="WTbox-header shadow">
                                    <input type="hidden" id="WTbox-media" value="movies">
                                    <div class="movies-box-icon"></div>
                                    <div class="WTbox-caption" style="width: initial;">{{ $page ?? '' }}</div>
                                    <input type="hidden" id="boxheaderBtnSlctd" value="">
                                    <a name="filmes"></a>
                                    <div class="movies-box-separator"></div>
                                </div>
                            </a>
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
                                                                <img src="/img/{{$x->image}}" alt="{{$x->name}}"
                                                                     title="{{$x->name}}" width="128" height="190">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach($content as $x)
                                                        <div id="5" class="WTitem">
                                                            <a href="{{$page}}/{{$x->id}}">
                                                                <img src="/img/{{$x->image}}" alt="{{$x->name}}"
                                                                     title="{{$x->name}}" width="128" height="190">
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
