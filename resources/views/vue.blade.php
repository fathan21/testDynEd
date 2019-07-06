<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ url('assets/img/logo/icon.png')}}">
    <link rel="apple-touch-icon image_src" href="{{ url('assets/img/logo/icon.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="all" />
    <meta name="title" content="jacatranet">
      <meta name="description" content="Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle. Jacatra adalah media yang menyajikan perkembangan terbaru Persija Jakarta setiap hari. Jacatra dibentuk karena masyarakat Jakarta setiap hari memerlukan informasi terbaru tentang Persija dan jakarta. Namun, pada kenyataannya, penyedia informasi yang ada belum mampu mencukupi kebutuhan.Hal tersebut membuat Jacatra tergerak. Jacatra memiliki motivasi untuk menjadikan Jakarta lebih kreatif. Khususnya dalam pemberitaan Persija dan jakarta.">
      <meta name="keywords" content="berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle,wisata, ibukota,ragunan, monas,betawi,jacatranet, koota kite">

    <meta property="og:url" content="{{ url('')}}"/>
    <meta property="og:title" content="jacatranet"/>
    <meta property="og:description" content="Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle. Jacatra adalah media yang menyajikan perkembangan terbaru Persija Jakarta setiap hari. Jacatra dibentuk karena masyarakat Jakarta setiap hari memerlukan informasi terbaru tentang Persija dan jakarta. Namun, pada kenyataannya, penyedia informasi yang ada belum mampu mencukupi kebutuhan.Hal tersebut membuat Jacatra tergerak. Jacatra memiliki motivasi untuk menjadikan Jakarta lebih kreatif. Khususnya dalam pemberitaan Persija dan jakarta."/>
    <meta property="og:image" itemprop="{{ url('assets/img/logo/logo.png')}}" />


    <meta property="og:site_name" content="jacatranet" />
    <meta property="og:type" content= "website" />
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Indoneia">



    <script> window.Laravel = { csrfToken: '{{csrf_token()}} ' } </script>
    <title>jacatranet</title>

    <!-- Bootstrap -->
    <link href="{{ url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vue/app.css?v=123112321321') }}" rel="stylesheet">
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

      .title-headline .news_item_title {
          max-height: 50px;
          word-break: break-word;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
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

    </div><!-- 
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
         /*$("document").ready(function(){
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-2307390804227223",
                enable_page_level_ads: true
            });
         });*/

    </script>
    <script src="{{ asset('assets/vue/app.js?v=123112321321') }}"></script>
    <script src="{{ url('assets/vue/MediaSkolten.bundle.js??v=123112321321') }}"></script>
    <!-- Theme Script File-->
    <script src="{{ url('assets/js/script.js?v=123112321321')}}"></script>
    <script>
    </script>
</body>
</html>
