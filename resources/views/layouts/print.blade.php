<!DOCTYPE html>
<html lang="en">
  <!--begin::Head-->
  <head>
    @include('partials.admin-head')
    <style>
      body{font-family: 'Arial'}
      td, th {border: 1px solid black !important; padding: 8px !important}
      th {font-weight: 600 !important; text-align: center !important}
    </style>
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="bg-white">
    <!--begin::Main-->
    <script>
      @if(session()->has('success'))
        Swal.fire({title:'Berhasil', text:'{{session('success')}}', icon:'success'})
      @endif
      @if(session()->has('error'))
        Swal.fire({title:'Error!', text:'{{session('error')}}', icon:'error'})
      @endif
      @if(session()->has('info'))
        Swal.fire({title:'Info', text:'{{session('info')}}', icon:'info'})
      @endif
      @if($errors->any())
        Swal.fire({title:'Error!', html:'{!! implode('', $errors->all(':message<br>')) !!}', icon:'error'})
      @endif
    </script>
    
    @yield('content')

    @include('partials.admin-script')
  </body>
  <!--end::Body-->
</html>