<!DOCTYPE html>
<html lang="en">
<head>
  @include('frontend.master.includes.head')
</head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- /Preloader -->

    @include('frontend.master.includes.header')
    @yield('banner')

    @yield('content')

    @include('frontend.master.includes.footer')
    @include('frontend.master.includes.script')

    @yield('footscript')

  </body>
</html>
