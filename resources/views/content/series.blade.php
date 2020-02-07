@extends('layouts.app')

@section('content')
    <div id="WTcontent">
        <div class="WTcenter">
            <div style="text-align: center;">
                <div id="movies-box" class="WTcontent-box">
                    <div class="WTbox-header shadow">
                        <input type="hidden" id="WTbox-media" value="movies">
                        <div class="movies-box-icon"></div>
                        <div class="WTbox-caption" style="width: initial;">{{ __($pageTitle ) ?? '' }}</div>
                        <input type="hidden" id="boxheaderBtnSlctd" value="">
                        <a name="filmes"></a>
                        <div class="movies-box-separator"></div>
                        <div class="WTbox-search">
                            <form action="{{route('series.search')}}" accept-charset="UTF-8" method="post"
                                  id="movies-searchForm">
                                @csrf
                                @method('POST')
                                <label for="searchBox">
                                    <input type="text" autocomplete="false" name="searchBox" id="searchBox"
                                           placeholder="Procure aqui por {{__($pageTitle)}}">
                                </label>
                            </form>
                        </div>
                    </div>
                    <div id="movies-box-content" class="WTbox-content" style="padding:15px">
                        <div class="WTbox-media" style="height:768px">
                            <div class="WTlist-content" style="height:768px">
                                <div id="movies-list" class="WTmovies-list">
                                    <div id="tabelafilmes" class="WTlist-aux WTlist-content"
                                         style="height:768px; overflow-x:hidden;overflow-y:auto;white-space:nowrap">
                                        @foreach($contents as $content)
                                            <div id="5" class="WTitem">
                                                <a href="{{ URL::route($currentPage,['id'=>$content->id]) }}">
                                                    <img src="{{Storage::url($content->image)}}"
                                                         alt="{{ $content->title }}"
                                                         title="{{ $content->title }}" width="128" height="190">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
