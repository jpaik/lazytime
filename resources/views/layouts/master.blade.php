<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')Lazytime</title>
  <link rel="shortcut icon" type="image" href="/images/favicon.png" />
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
