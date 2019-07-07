<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title')</title>

  <!-- Custom fonts for this theme -->
  <link href="{{asset('assets/css/all.css')}}" rel="stylesheet" type="text/css">
</head>

<body >

  @include('layouts.partials.topnav')
 
  <div id="app" class="container">
      @yield('content')
  </div>
  
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <script src="{{asset('js/app.js')}}"></script>
  @stack('scripts')
</body>

</html>
