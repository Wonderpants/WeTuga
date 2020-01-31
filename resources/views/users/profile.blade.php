@extends('layouts.app')

@section('content')
    <hr>
    <div class="container rounded p-4 text-white" style="background-color: #000000bf">
        @if (isset($error))
            <center><h1>{{$error}}</h1></center>
        @endif
        <div class="row">
            <div class="col-sm-3">
            </div>

            <div class="col-sm-6">
                <div style="text-align: center;"><ul class="nav nav-tabs d-inline-flex">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#settings">Settings</a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#history">Viewing History</a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#subscription">Subscription</a>
                        </li>
                    </ul></div>

                <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                        <hr>
                        <form class="form" action="{{route('users.update')}}" method="post" id="registrationForm">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="first_name"><h4>First name</h4></label>
                                            <input type="text" class="form-control bg-transparent" name="first_name" id="first_name" value="{{explode(" ", $user->name)[0]}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="last_name"><h4>Last name</h4></label>
                                            <input type="text" class="form-control bg-transparent" name="last_name" id="last_name" value="{{last(explode(" ", $user->name))}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email"><h4>Email</h4></label>
                                    <input type="email" class="form-control bg-transparent" name="email" id="email" value="{{$user->email}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="password"><h4>Password</h4></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="password" title="enter your password.">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="password2"><h4>Password (verify)</h4></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="password" title="confirm your password.">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit">
                                        <i class="glyphicon glyphicon-ok-sign"></i> Save
                                    </button>
                                    <button class="btn btn-lg btn-danger" type="reset">
                                        <i class="glyphicon glyphicon-repeat"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>

                    </div>

                    <!--/tab-pane-->
                    <div class="tab-pane" id="history">
                        <hr>
                    </div>

                    <!--/tab-pane-->
                    <div class="tab-pane" id="subscription">
                        <hr>
                    </div>

                </div>
                <!--/tab-pane-->
            </div>

            <div class="col-sm-3">
            </div>
        </div>
        <!--/col-9-->
    </div>
@endsection

