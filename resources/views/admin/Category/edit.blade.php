@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Categorie</h1>
        </div>
        @if (session('message'))
                <div class="alert alert-success mt-3  ">
                  {{session('message')}}
                </div>
                @endif

        <div class="section-body">
          <div class="row">
            <div class="col-12 ">
              <div class="card">
                <div class="card-header">
                  <h4>Modifica categoria</h4>
                  @if ($errors->any())
                          @foreach ($errors->all() as $error )
                              <div class="alert alert-danger mt-2">{{$error}}</div>
                          @endforeach
                  @endif  
                  <div class="card-header-action">
                      <a href="{{route('admin.category.index')}}" class="btn btn-primary">Index categorie</a>
                  </div>
                </div>
                {{-- togliere il col-md-6 per avere il full width --}}
                <div class="card-body col-md-6">
                    <form action="{{route('admin.category.update', $category->id)}}" method="POST" >
                      @csrf
                      @method('PUT')
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" value="{{$category->name}}" name="name">
                        </div>
                        
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$category->status == 1 ? 'selected': ''}}  value="1">Attiva</option>
                              <option {{$category->status == 0 ? 'selected': ''}} value="0">Non attiva</option>
                            </select>
                          </div>
                        <button type="submit" class="btn btn-warning">Modifica</button>
                    </form>
                </div>    
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection