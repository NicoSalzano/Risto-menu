@extends('Admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Menu PAGINA DA MODIFICARE</h1>
    </div>
    <div class="section-body">
        <div class="row">
        <div class="col-8 ">
            <div class="card">
            <div class="card-header">
                <h4>Info: {{$plates->name}}</h4>
                <div class="card-header-action">
                    <a href="{{route('admin.piatti.index')}}" class="btn btn-primary">Index menu</a>
                </div>
            </div>
            {{-- togliere il col-md-6 per avere il full width --}}
            <div class="card-body">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{asset($plates->image)}}" class="rounded w-100" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Nome:{{$plates->name}}</h5>
                          <p class="card-text">Descrizione: {{$plates->description}}</p>
                          <p class="card-text">Prezzo: <small class="text-body-secondary">{{$plates->price}}</small></p>
                          <p class="card-text">Stato: <small class="text-body-secondary">{{$plates->status}}</small></p>
                          <p class="card-text">Disponibilita: <small class="text-body-secondary">{{$plates->not_available}}</small></p>
                          <p class="card-text">In evidenza: <small class="text-body-secondary">{{$plates->featured}}</small></p>
                          <p class="card-text">Etichetta: <small class="text-body-secondary">{{$plates->plate_label}}</small></p>
                          <p class="card-text">Allergeni: <small class="text-body-secondary">Qui tutti gli allergeni</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>    
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Select Image <code>Multi image supported</code></label>
                            <input type="file" name="image[]" class="form-control" multiple>
                            {{-- <input type="hidden" name="product" value="{{$products->id}}"> --}}
                      </div>
                      <button type="submit" class="btn btn-success">Aggiungi</button>
                    </form>
                </div>    
              </div> 
        </div>
        </div>
    </div>
</section>
@endsection