<!DOCTYPE html>
<html>
  <head>
  	@include('layout.header')
  </head>

  <body>
    <div class="container">
      @yield('content')
    </div>
	@include('layout.footer')
  </body>
</html>
