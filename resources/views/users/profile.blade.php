@extends('layouts.app')

@section('content')
    <hr>
    <div class="container rounded p-4 text-white" style="background-color: #FFFFFF; max-width: 65%; min-width: 980px">
        @if (isset($error))
            <center>
                <h1>{{$error}}</h1>
            </center>
        @endif
        <div class="row w-75 m-auto">
            <div class="col-sm-10 m-auto">
                <div class="container-fluid">

                    <div class="row align-items-center">
                        <ul class="nav nav-pills nav-fill m-auto">
                            <li><a class="nav-link active" data-toggle="tab" href="#settings">Definições</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#history">Histórico</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#subscription">Subscrição</a></li>
                        </ul>
                    </div>

                </div>

                <div class="tab-content">
                    <div class="tab-pane active text-black-50" id="settings">
                        <hr>
                        <form class="form" action="{{route('users.update')}}" method="post" id="registrationForm">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="first_name">
                                                <h4>Primeiro Nome</h4>
                                            </label>
                                            <input type="text" class="form-control bg-transparent" name="first_name"
                                                   id="first_name" value="{{explode(" ", $user->name)[0]}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="last_name">
                                                <h4>Ultimo Nome</h4>
                                            </label>
                                            <input type="text" class="form-control bg-transparent" name="last_name"
                                                   id="last_name" value="{{last(explode(" ", $user->name))}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email">
                                        <h4>Email</h4>
                                    </label>
                                    <input type="email" class="form-control bg-transparent" name="email" id="email"
                                           value="{{$user->email}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="password">
                                        <h4>Palavra-passe</h4>
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" id="password" placeholder="password"
                                           title="enter your password.">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="password2">
                                        <h4>Palavra-passe (verificação)</h4>
                                    </label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           id="password_confirmation" placeholder="password"
                                           title="confirm your password.">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-success" type="submit">Guardar Alterações</button>
                                    <button class="btn btn-secondary" type="reset">Limpar Campos</button>
                                    <button class="btn btn-danger float-right" type="submit">Eleminar Conta</button>
                                </div>
                            </div>
                        </form>
                        <hr>

                    </div>

                    <div class="tab-pane" id="history">
                        <hr>
                        <div class="container-fluid text-black-50">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <ul class="list-group">
                                        @if (sizeof($history) == 0)
                                            <div class="container-fluid h-25 align-items-center">
                                                <center>
                                                    <h2>Sem conteudo visualizado</h2>
                                                </center>
                                            </div>
                                        @else
                                            @foreach($history as $x => $y )
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="row w-100 align-items-center m-auto">
                                                    <div class="col-2">{{date('d/m/Y',strtotime($y->timestamp))}}</div>
                                                    <div class="col-8"><a href="{{ URL::route(str_replace('movie', 'movies', $y->type),['id'=>$y->id]) }}"><b>{{$y->title}}</b></a></div>
                                                    <div class="col-2 align-content-center">
                                                        <div class="image-parent">
                                                            <img
                                                                src="{{Storage::url($y->image)}}"
                                                                class="img-fluid" alt="lay">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="subscription">
                        <hr>
                        <div class="card-deck">
                            <div class="card">
                                <img src="{{Storage::url('logos/WeTugaPadrao.png')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Grátis</h5>
                                    <ul class="list-group" style="list-style: none">
                                        <li>- Acesso a todo o conteúdo</li>
                                        <li>- Com publicidade</li>
                                        <li>- Baixa definição</li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-outline-secondary">Comprar</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{Storage::url('logos/WeTugaBase.png')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">4.99€</h5>
                                    <ul class="list-group" style="list-style: none">
                                        <li>- Acesso a todo o conteúdo</li>
                                        <li>- Sem publicidade</li>
                                        <li>- Alta definição</li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-outline-secondary">Comprar</button>
                                </div>
                            </div>
                            <div class="card">
                                <img
                                    src="{{Storage::url('logos/WeTugaPremium.png')}}"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">9.99€</h5>
                                    <ul class="list-group" style="list-style: none">
                                        <li>- Acesso a todo o conteúdo</li>
                                        <li>- Sem publicidade</li>
                                        <li>- Ultra definição</li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-outline-secondary">Comprar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--/tab-pane-->
        </div>

    </div>
@endsection
