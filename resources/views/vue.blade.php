<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script> window.Laravel = { csrfToken: 'csrf_token() ' } </script>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="{{ url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <style>
      .media h3.media-heading{
        font-size: 15px;
        max-height: 40px;
        overflow: hidden;
        /* text-overflow: ellipsis; */
        overflow: hidden;
        word-break: break-word;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        font-size:15px;
      }
      .news_item_title h2 {
          font-size: 18px;
          margin: 0 0 10px;
          overflow: hidden;
          max-height: 50px;
          word-break: break-word;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
      }
      .item_content > .prev{
        overflow: hidden;
        max-height: 40px;
        padding-bottom: 30px;
        word-break: break-word;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;

      }
    </style>
</head>
<body>
    <div id="app">

    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- Theme Script File-->
    <script src="assets/js/script.js"></script>
</body>
</html>
