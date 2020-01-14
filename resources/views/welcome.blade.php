@extends('layouts.app', ['currentPage' => 'home'])

@section('content')
    @guest
    @else
        @foreach(['filmes', 'series', 'outros'] as $pageTitle)
            <div id="WTcontent">
                <div class="WTcenter">
                    <div style="text-align: center;">
                        <div id="movies-box" class="WTcontent-box">
                            <a href="/{{$pageTitle}}">
                                <div class="WTbox-header shadow">
                                    <input type="hidden" id="WTbox-media" value="movies">
                                    <div class="movies-box-icon"></div>
                                    <div class="WTbox-caption" style="width: initial;">{{ $pageTitle ?? '' }}</div>
                                    <input type="hidden" id="boxheaderBtnSlctd" value="">
                                    <a name="filmes"></a>
                                    <div class="movies-box-separator"></div>
                                </div>
                            </a>
                            <div id="movies-box-content" class="WTbox-content" style="padding:15px">
                                <div class="WTbox-media">
                                    <div class="WTlist-content">
                                        <div id="movies-list" class="WTmovies-list">
                                            <div id="tabelafilmes" class="WTlist-aux WTlist-content" style="height:450px; overflow-x:hidden;overflow-y:auto;white-space:nowrap">
                                                <?php
                                                for ($x = 0; $x <= 17; $x++) {
                                                    echo '<div id="5" class="WTitem">
                                                <a href="'.$pageTitle.'/'.$x.'">
                                                    <img src="img/128x190.png" alt="title" title="title">
                                                </a>
                                            </div>';
                                                }
                                                ?>
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
    @endguest
@endsection
