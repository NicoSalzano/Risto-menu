@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profilo Utente</h1>
    </div>
    @if (session('message'))
    <div class="alert  nico">
        {{ session('message') }}
    </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form method="POST" action="{{route('admin.profile.update')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="card-header">
                            <h4>Modifica Profilo</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">                               
                                <div class="form-group col-md-6 col-12">
                                    <label>Nome utente</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->name}}" name="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-7 col-12">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="{{Auth::user()->email}}" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">Modifica</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form method="POST" action="{{route('admin.profile.update.password')}}" >
                        @csrf
                        <div class="card-header">
                            <h4>Modifica Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">                               
                                <div class="form-group col-md-6 col-12">
                                    <label>Password</label>
                                    <input type="password" class="form-control"name="current_password">
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="form-group col-md-6 col-12">
                                    <label>Inserisci la nuova Password</label>
                                    <input type="password" class="form-control"name="password">
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="form-group col-md-6 col-12">
                                    <label>Conferma la password</label>
                                    <input type="password" class="form-control"name="password_confirm">
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">Modifica</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection