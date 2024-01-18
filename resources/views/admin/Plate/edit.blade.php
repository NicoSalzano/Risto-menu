@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Menu</h1>
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
                  <h4>Modifica piatto</h4>
                  @if ($errors->any())
                          @foreach ($errors->all() as $error )
                              <div class="alert alert-danger mt-2">{{$error}}</div>
                          @endforeach
                  @endif  
                  <div class="card-header-action">
                      <a href="{{route('admin.piatti.index')}}" class="btn btn-primary">Index menu</a>
                  </div>
                </div>
                {{-- togliere il col-md-6 per avere il full width --}}
                <div class="card-body col-md-6">
                    <form action="{{route('admin.piatti.update', $plates->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label>Prewiev</label>
                        <br>
                        <img src="{{asset($plates->image)}}" alt="" width="200">
                    </div>
                        <div class="form-group">
                            <label>Immagine</label>
                            <input type="file" class="form-control" value="{{old('image')}}" name="image">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Categoria</label>
                            <select id="inputState" class="form-control" name="category">
                              <option>Seleziona</option>
                              @foreach ($categories as $category) 
                                  <option {{$category->id == $plates->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" value="{{$plates->name}}" name="name">
                        </div>
                        <div class="form-group">
                            <label>Descrizione</label>
                            <textarea name="description" class="form-control" type="text">{{$plates->description}}</textarea>
                           
                        </div>
                        <div class="form-group">
                            <label>Prezzo</label>
                            <input type="number" class="form-control" value="{{$plates->price}}" name="price">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <label for="inputState">Status *</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option>Seleziona</option>
                                    <option {{$plates->status == 1 ? 'selected' : ''}} value="1">Visibile</option>
                                    <option {{$plates->status == 0 ? 'selected' : ''}} value="0">Nascosto</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputState">Disponibilita**</label>
                                <select id="inputState" class="form-control" name="not_available">
                                    <option>Seleziona</option>
                                    <option {{$plates->not_available == 1 ? 'selected' : ''}} value="1">Disponibile</option>
                                    <option {{$plates->not_available == 0 ? 'selected' : ''}} value="0">Non disponibile</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputState">In evidenza</label>
                                <select id="inputState" class="form-control" name="featured">
                                    <option>Seleziona</option>
                                    <option {{$plates->featured == 1 ? 'selected' : ''}} value="1">Si</option>
                                    <option {{$plates->featured == 0 ? 'selected' : ''}} value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 form-group">
                                <label for="inputState">Etichetta</label>
                                <select id="inputState" class="form-control" name="plate_label">
                                    <option {{$plates->plate_label == 'new' ? 'selected' : ''}} value="new">Novita</option>
                                    <option {{$plates->plate_label == 'most_request' ? 'selected' : ''}} value="most_request">Il piu richiesto</option>
                                    <option {{$plates->plate_label == 'out_menu' ? 'selected' : ''}} value="out_menu">Fuori menu </option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                {{-- <input type="hidden" name="plate_id" value="{{ $plate->id }}"> --}}
                                <label for="inputState">Allergeni</label>
                                <select id="inputState" id="allergens" class="form-control selectric" name="allergen[]" multiple="">
                                    <option>Seleziona</option>
                                    @foreach ($allergens as $id => $name )
                                        <option value="{{$id}}" 
                                        @if(in_array($id, $selectedAllergens)) 
                                        selected 
                                        @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                          <div class="text-right mt-2">
                              <button type="submit" class="btn btn-success">Modifica</button>
                          </div>
                    </form>
                    <p><code>* Nascondi il piatto al cliente</code></p>
                    <p><code>** Il cliente vede il piatto ma non e disponibile</code></p>
                </div>    
              </div>
            </div>
          </div>
        </div>
    </section>
@endsection