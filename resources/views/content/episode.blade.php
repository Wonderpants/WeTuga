@extends('layouts.app')

@section('content')
    <div id="WTcontent">
        <div class="WTcenter">
            <div id="WTplayer-box" class="WTcontent-box">
                <div class="WTplayer-aux" style="overflow: visible; padding-bottom: 15px;">
                    <div class="WTthumb" title="{{__($content->title)}}">
                        <a href="#" class="WTthumb-aux">
                            <img src="{{Storage::url($content->image)}}" alt="{{$content->title}}" width="128" height="190">
                        </a>
                    </div>
                    <div class="WT-info">
                        <a href="#" class="WT-name">{{$content->title}}</a>
                        <div class="clear"></div>
                        <div class="WT-detailed-info">
                            <div class="WTdetailed-aux" style="line-height: 18px;width:100%;">
                                    <span class="WTgenre">
                                        <a style="color: #4282A8;text-decoration: inherit;"
                                           href="#">{{ucfirst($content->genre)}}</a>
                                    </span>
                                <span class="WTyear"><span> - (</span>{{$content->date}}<span>) </span></span>
                            </div>
                            <div class="WTdetailed-aux">
                                <span class="WTdirector-caption">Realizador: {{$content->studio}} </span>
                                <br>
                                <span class="WTdirector-caption">Elenco:</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <span id="WT-synopsis" class="WT-content-synopsis" style="margin-top:15px;">
                                <span style="font-family: 'PTSans Bold', Tahoma,serif; font-size: 13px; color:#7F7F82">Descrição:</span>
                                {{$content->description}}
                            </span>
                    </div>
                    <div style="margin: auto;width: 80%;">
                        <center></center>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="WTplayer-aux" style="padding-top: 0;">
                    <div id="WT-actions" class="WT-content-actions">
                        <div id="WTvisto">
                            <form method="POST" action="{{ route('series.seen') }}" id="report">
                                @csrf
                                <input name="content_id" type="hidden" value="{{$content->id}}">
                                <button id="WTwatched" style="cursor:pointer" class="watched" type="submit">
                                    {{--                                    {{dd($seen)}}--}}
                                    @if (count($seen) < 1) {{__('Marcar como visto')}}
                                    @else {{__('Desmarcar de visto')}}
                                    @endif<span class="watch"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div style="z-index: 2;position: relative;">
                <div id="media-player" class="mt-3">
                    <div class="iframe-media-player">
                        <iframe width="980" height="551" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                src="{{$content->video}}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
