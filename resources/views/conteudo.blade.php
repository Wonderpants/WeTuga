@extends('layouts.app')

@section('content')
    @if( isset($id) && isset($users))
        {{--        {{ $users }}--}}
    @else
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
                                        <div id="tabelafilmes" class="WTlist-aux WTlist-content" style="height:768px; overflow-x:hidden;overflow-y:auto;white-space:nowrap">
                                            <?php
                                            for ($x = 0; $x <= 23; $x++) {
                                                echo '<div id="5" class="WTitem">
                                                    <a href="'.$currentPage.'/'.$x.'">
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
    @endif
@endsection
