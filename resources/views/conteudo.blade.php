@extends('layouts.app')

@section('content')
    @if( isset($contents) and isset($id) )
        @php($content = $contents[0])
        <div id="WTcontent">
            <div class="WTcenter">
                <div id="WTplayer-box" class="WTcontent-box">
                    <div class="WTplayer-aux" style="overflow: visible; padding-bottom: 15px;">
                        <div class="WTthumb" title="{{$content->name}}">
                            <a href="#" class="WTthumb-aux">
                                <img src="/img/{{$content->image}}" alt="{{$content->name}}" width="128" height="190">
                            </a>
                        </div>
                        <div class="WTmovie-info">
                            <a href="#" class="WTmovie-name">{{$content->name}}</a>
                            <div class="clear"></div>
                            <div class="WTmovie-detailed-info">
                                <div class="WTdetailed-aux" style="line-height: 18px;width:100%;">
                                    <span class="WTgenre">
                                        <a style="color: #4282A8;text-decoration: inherit;"
                                           href="#">{{ucfirst($content->genre)}}</a>
                                    </span>
                                    <span class="WTyear"><span> - (</span>{{$content->date}}<span>) </span></span>
                                </div>
                                <div class="WTdetailed-aux">
                                    <span class="WTdirector-caption">Realizador: </span>
                                    <span class="WTdirector">  </span>
                                    <br>
                                    <span class="WTdirector-caption">Elenco:</span>
                                    <span class="WTdirector"> </span>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <span id="movie-synopsis" class="WTmovie-synopsis" style="margin-top:15px;">
                                <span style="font-family: 'PTSans Bold', Tahoma,serif; font-size: 13px; color:#7F7F82">Descrição:</span>
                                {{$content->description}}
                            </span>
                        </div>
                        <div style="margin: auto;width: 80%;">
                            <center></center>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div style="z-index: 2;position: relative;">
                    <div id="media-player" class="mt-3">
                        <div class="iframe-media-player">
                            <iframe width="980" height="551" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                                    src="{{$content->video}}" ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif( isset($contents) )
        <div id="WTcontent">
            <div class="WTcenter">
                <div style="text-align: center;">
                    <div id="movies-box" class="WTcontent-box">
                        <div class="WTbox-header shadow">
                            <input type="hidden" id="WTbox-media" value="movies">
                            <div class="movies-box-icon"></div>
                            <div class="WTbox-caption" style="width: initial;">{{ $pageTitle ?? '' }}</div>
                            <input type="hidden" id="boxheaderBtnSlctd" value="">
                            <a name="filmes"></a>
                            <div class="movies-box-separator"></div>
                        </div>
                        <div id="movies-box-content" class="WTbox-content" style="padding:15px">
                            <div class="WTbox-media" style="height:768px">
                                <div class="WTlist-content" style="height:768px">
                                    <div id="movies-list" class="WTmovies-list">
                                        <div id="tabelafilmes" class="WTlist-aux WTlist-content"
                                             style="height:768px; overflow-x:hidden;overflow-y:auto;white-space:nowrap">
                                            @foreach($contents as $content)
                                                <div id="5" class="WTitem">
                                                    <a href="{{ $currentPage }}/{{ $content->id }}">
                                                        <img src="/img/{{ $content->image }}" alt="{{ $content->name }}"
                                                             title="{{ $content->name }}" width="128" height="190">
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
    @else
        Error page
    @endif
@endsection
