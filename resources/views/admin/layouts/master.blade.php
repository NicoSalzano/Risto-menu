<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>General Dashboard &mdash; Stisla</title>
  
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('backend/assets/css/personalStyle.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/fontawesome/css/all.min.css')}}">
  
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/summernote/summernote-bs4.css')}}">
  {{-- link per lo style del dataTable --}}
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  {{-- <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-iconpicker.min.css')}}"> --}}
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/css/components.css')}}">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-9403462423"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-94034622-3');
  </script>
<!-- /END GA -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body style="background-color: rgb(243, 243, 243)">
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      {{-- navbar content --}}
      @include('admin.layouts.navbar')
      
      {{-- sidebar content --}}
      @include('admin.layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
         @yield('content')
      </div>
      {{-- footer content --}}
      @include('admin.layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('backend/assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('backend/assets/modules/popper.js')}}"></script>
    <script src="{{asset('backend/assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('backend/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('backend/assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/stisla.j')}}s"></script>
  
  <!-- JS Libraies -->
  <script src="{{asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{asset('backend/assets/modules/chart.min.js')}}"></script>
    <script src="{{asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('backend/assets/modules/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
    {{-- script per il dataTable --}}
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    {{-- SCRIPT PER IL DELETE ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('backend/assets/js/page/index-0.js')}}"></script>
    
  <!-- Template JS File -->
  <script src="{{asset('backend/assets/js/scripts.js')}}"></script>
  <script src="{{asset('backend/assets/js/custom.js')}}"></script>
  

  @stack('scripts')

  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('body').on('click','.delete-item', function(event){
        event.preventDefault();
        
        let deleteUrl = $(this).attr('href');
        
        Swal.fire({
          title: "Cancellare la categoria?",
          text: "La categoria non potra piu essere recuperata!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Cancella !",
          cancelButtonText:"Annulla!"
        }).then((result) => {
          if (result.isConfirmed) {
            
            $.ajax({
              type:'DELETE',
              url: deleteUrl,
              success: function(data){
                if (data.status == 'success') {
                  Swal.fire(
                    'Cancellata!',
                    data.message,
                    'success'
                    );
                    setTimeout(() => {
                      window.location.reload();
                    }, 2000);
                } else if (data.status == 'error') {
                  Swal.fire(
                    'cant delete',
                    data.message,
                    'error'
                    )
                } 
              },
              error: function(xhr,status,error){
                console.log(error);
              }
              
            })
          }
        });
      })
    })
  </script>

</body>
</html>