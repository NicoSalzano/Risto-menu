@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Categorie</h1>
    </div>

    <div class="section-body">
          @if (session('message'))
          <div class="alert alert-success mt-3  ">
            {{session('message')}}
          </div>
          @endif
      <div class="row">
        <div class="col-12 ">
          <div class="card">
            <div class="card-header">
              <h4>Index Categorie</h4>
              <div class="card-header-action">
                  <a href="{{route('admin.category.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Aggiungi categoria</a>
              </div>
            </div>
            <div class="card-body">
              {{ $dataTable->table() }}
            </div>    
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
  @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  
    <script>
      $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
          let isChecked = $(this).is(':checked');
            // console.log(isChecked);
            let id = $(this).data('id');
            console.log(id);

            $.ajax({
                url:"{{route('admin.category.change-status')}}",
                method:'PUT',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                data: {
                    status: isChecked,
                    id:id
                },
                success:function(data){
                    console.log(data);
                },
                error:function(xhr, status, error){
                    console.log(error);
                },
            })
          //   let id = $(this).data('id');
  
        //   $.ajax({
        //     url: "{{route('admin.category.change-status')}}",
        //     method:'PUT',
        //     data: {
        //       status: isChecked,
        //       id:id
        //     },
        //     success: function(data){
        //         console.log(data.message)
        //     },
        //     error: function(xhr, status, error){
        //       console.log(error);
        //     }
        //   })
        })
      })
    </script>
  @endpush