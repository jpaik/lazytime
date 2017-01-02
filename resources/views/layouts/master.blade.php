<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')Lazytime</title>
  <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
  <link href="css/sweetalert2.min.css" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  {{--@include('shared.footer')--}}
  @yield('wrapper')
  {{--@include('shared.footer')--}}

  <script src="js/library.js"></script>
  @yield('scripts')
  <script src="js/script.js"></script>
</body>

</html>
