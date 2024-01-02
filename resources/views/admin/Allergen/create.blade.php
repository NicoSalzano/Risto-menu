@extends('Admin.layouts.master')

@section('content')
    <!-- Main Content -->
     
    <section class="section">
        <div class="section-header">
          <h1>Allergeni</h1>
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
                  <h4>Aggiungi allergene</h4>
                  {{-- <p>Modificare button aggiungi riga e metterlo vicino all input</p> --}}
                  @if ($errors->any())
                          @foreach ($errors->all() as $error )
                              <div class="alert alert-danger mt-2">{{$error}}</div>
                          @endforeach
                  @endif  
                  <div class="card-header-action">
                      <a href="{{route('admin.allergeni.index')}}" class="btn btn-primary">Index allergeni</a>
                  </div>
                </div>
                {{-- togliere il col-md-6 per avere il full width --}}
                <div class="card-body col-md-6">
                    <form action="{{route('admin.allergeni.store')}}" method="POST" >
                      @csrf
                      <div id="rows-container">
                        {{-- <div class="section-title">Button</div> --}}
                        <div class="form-group">
                          <label for="">Nome</label>
                           <div class="input-group mb-3">
                            <input type="text" class="form-control"value="{{old('name')}}" name="name[]">
                            <div class="input-group-append">
                              <button class="btn btn-success ml-3" onclick="addRow()" type="button"><i class="ion-plus-round"></i></button>
                              {{-- <button class="btn btn-danger ml-1" onclick="rmvRow(this)" type="button"><i class="ion-trash-a"></i></button> --}}
                            </div>
                        </div>
                       </div>
                      </div>
                      <div class="text-right">
                        {{-- <button type="button" onclick="addRow()" class="btn btn-info">Aggiungi riga</button> --}}
                        <button type="submit" class="btn btn-success">Aggiungi</button>
                      </div>
                    </form>
                </div>    
              </div>
            </div>
          </div>
        </div>
      </section>
      <script>
        function addRow() {
          let newRow = `
                        <div class="form-group">
                          <label for="">Nome</label>
                           <div class="input-group mb-3">
                            <input type="text" class="form-control"value="{{old('name')}}" name="name[]">
                            <div class="input-group-append">
                              <button class="btn btn-success ml-3" onclick="addRow()" type="button"><i class="ion-plus-round"></i></button>
                              <button class="btn btn-danger ml-1" onclick="rmvRow(this)" type="button"><i class="ion-trash-a"></i></button>
                            </div>
                        </div>
                       </div>`;
                      $(`#rows-container`).append(newRow);
        }

        function rmvRow(button) {
          $(button).closest('.form-group').remove();
        }
      </script>
@endsection


