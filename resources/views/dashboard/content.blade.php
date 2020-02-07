@extends('layouts.dashboard')

@section('content')
    <h3>{{__('Adicionar novo conteudo')}}</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{route('dashboard.content.submit')}}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-lg-2">
                <div class="card mb-3">
                    <div class="card-body text-center shadow">
                        <img id="preview" class="rounded mb-3 mt-4" src="{{Storage::url('128x190.png')}}" width="128"
                             height="190" alt="cover"/>
                        <div class="mb-3">
                            <div class="form-group">
                                <input type="file" id="input_img" onchange="FileSelected()" style="width: 0;"
                                       name="image" accept="image/*">
                                <input class="btn btn-primary btn-sm" type="button"
                                       onclick="document.getElementById('input_img').click()"
                                       value="{{__('Adicionar Capa')}}" name="input_img2"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">{{__('Content Settings')}}</p>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="name">
                                                <strong>Nome</strong>
                                            </label>
                                            <input type="text" class="form-control" placeholder="nome" name="name"
                                                   value="{{old('name')}}"/>
                                        </div>
                                    </div> {{-- Nome do Filme --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="date">
                                                <strong>Data de lançamento</strong>
                                            </label>
                                            <input type="date" class="form-control" placeholder="data"
                                                   name="date" value="{{old('date')}}"/></div>
                                    </div> {{-- Data de lançamento --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="date">
                                                <strong>Tipo de Conteudo</strong>
                                            </label>
                                            <select class="form-control" name="contentType">
                                                <option value="movie">Filme</option>
                                                <option value="series">Série</option>
                                                <option value="other">Outro</option>
                                            </select>
                                        </div>
                                    </div> {{-- Tipo de Conteudo --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="season">
                                                <strong>Temporada</strong>
                                            </label>
                                            <input type="number" class="form-control" placeholder="temporada"
                                                   name="season" min="1" value="{{old('season')}}"/></div>
                                    </div> {{-- Temporada --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="episode">
                                                <strong>Episódio</strong>
                                            </label>
                                            <input type="number" class="form-control" placeholder="episódio"
                                                   name="episode" min="1" value="{{old('episode')}}"/></div>
                                    </div> {{-- Episódio --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="minutes">
                                                <strong>Duração</strong>
                                            </label>
                                            <input type="number" class="form-control" placeholder="duração em minutos"
                                                   name="minutes" min="1" value="{{old('minutes')}}"/></div>
                                    </div> {{-- Duração --}}
                                </div>
                                <div class="form-row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="genre">
                                                <strong>Descrição</strong>
                                            </label>
                                            <input type="text" class="form-control" placeholder="descrição"
                                                   name="description" maxlength="512" value="{{old('description')}}"/>
                                        </div>
                                    </div> {{-- Descrição --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="classification">
                                                <strong>Classificação</strong>
                                            </label>
                                            <input type="number" class="form-control" placeholder="classificação"
                                                   name="classification" min="0" max="10"
                                                   value="{{old('classification')}}"/></div>
                                    </div> {{-- Classificação --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="genre">
                                                <strong>Género</strong>
                                            </label>
                                            <input type="text" class="form-control" placeholder="Drama, Horror, ..."
                                                   name="genre" value="{{old('genre')}}"/></div>
                                    </div> {{-- Genero do Filme --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="studio">
                                                <strong>Estúdio</strong>
                                            </label>
                                            <input type="text" class="form-control" placeholder="estúdio" name="studio"
                                                   maxlength="64" value="{{old('studio')}}"/></div>
                                    </div> {{-- Estúdio --}}
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="video">
                                                <strong>Vídeo</strong>
                                            </label>
                                            <input type="text" class="form-control" placeholder="vídeo" name="video"
                                                   maxlength="256" value="{{old('video')}}"/>
                                        </div>
                                    </div> {{-- Vídeo --}}
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" class="form-check" placeholder="vídeo" name="18+"
                                           value="{{old('18+')}}"/>
                                    <label for="18+">
                                        <a>Para Maiores de Idade</a>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm"
                                            type="submit">{{__('Guardar Conteudo')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function FileSelected(e) {
            file = document.getElementById('input_img').files[document.getElementById('input_img').files.length - 1];
            document.getElementById('preview').src = window.URL.createObjectURL(file);
        }
    </script>
@endsection

@section('style')
    <style>
        input[type="checkbox"] {
            position: absolute;
        }

        input[type="checkbox"] ~ label {
            padding-left: 1.4em;
            display: inline-block;
        }
    </style>
@endsection
