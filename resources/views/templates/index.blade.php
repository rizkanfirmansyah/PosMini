<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POS Mini | {{$title}} </title>

  @include('templates.includes.style')

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

@include('templates.layouts.navbar')

@include('templates.layouts.sidebar')

@yield('main')

@include('templates.layouts.footer')

@include('templates.layouts.control-sidebar')

@stack('modal')

</div>
<!-- ./wrapper -->

    @include('templates.includes.script')

</body>
</html>
