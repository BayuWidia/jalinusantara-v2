<!DOCTYPE html>
<html lang="en">
<head>
  @yield('title')
  @include('backend.master.includes.head')
</head>
<body class="theme-indigo">
  @include('backend.master.includes.pageload')

  @include('backend.master.includes.header')

  @include('backend.master.includes.sidebar')

  <section class="content">
    @yield('content')
  </section>

  @include('backend.master.includes.script')
  @yield('footscript')

</body>
</html>
