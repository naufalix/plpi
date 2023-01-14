<!DOCTYPE html>
<html lang="en">

<head>
  @include('partials.head')
</head>

<body>

  <!-- ======= Header ======= -->
    @include('partials.header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @yield('hero')
  <!-- End Hero -->

  <main id="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('partials.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('partials.script')

</body>

</html>