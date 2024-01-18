@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Menu</h1>
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
              <h4>Index Piatti</h4>
              <div class="card-header-action">
                  <a href="{{route('admin.piatti.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Aggiungi piatto</a>
              </div>
            </div>
            <div class="card-body">
              {{ $dataTable->table() }}
              <p><code>*Nascondi il piatto al cliente</code></p> 
              <p><code>**Il cliente vede il piatto ma non e disponibile</code></p>
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
                url:"{{route('admin.plates.change-status')}}",
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
        })
      })
    </script>
@endpush