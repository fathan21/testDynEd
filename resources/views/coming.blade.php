<!DOCTYPE html>
<html lang="en">
<head>
  
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="/assets/img/logo/icon.png"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/comingsoon/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/comingsoon/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/comingsoon/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/comingsoon/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/comingsoon/css/util.css">
  <link rel="stylesheet" type="text/css" href="/assets/comingsoon/css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  
  <div class="bg-img1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15" style="background: #5c171a;">
    <div class="wsize1 bor1 bg1 p-t-175 p-b-45 p-l-15 p-r-15 respon1">
      <div class="wrappic1">
        <img src="/assets/img/logo/logo.png" alt="LOGO">
      </div>

      <p class="txt-center m1-txt1 p-t-33 p-b-68">
        Our website is come back
      </p>

      <div class="wsize2 flex-w flex-c hsize1 cd100">
        <div class="flex-col-c-m size2 how-countdown">
          <span class="l1-txt1 p-b-9 days">35</span>
          <span class="s1-txt1">Days</span>
        </div>

        <div class="flex-col-c-m size2 how-countdown">
          <span class="l1-txt1 p-b-9 hours">17</span>
          <span class="s1-txt1">Hours</span>
        </div>

        <div class="flex-col-c-m size2 how-countdown">
          <span class="l1-txt1 p-b-9 minutes">50</span>
          <span class="s1-txt1">Minutes</span>
        </div>

        <div class="flex-col-c-m size2 how-countdown">
          <span class="l1-txt1 p-b-9 seconds">39</span>
          <span class="s1-txt1">Seconds</span>
        </div>
      </div>
      
    </div>
  </div>



  

<!--===============================================================================================-->  
  <script src="/assets/comingsoon/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="/assets/comingsoon/vendor/bootstrap/js/popper.js"></script>
  <script src="/assets/comingsoon/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="/assets/comingsoon/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="/assets/comingsoon/vendor/countdowntime/moment.min.js"></script>
  <script src="/assets/comingsoon/vendor/countdowntime/moment-timezone.min.js"></script>
  <script src="/assets/comingsoon/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
  <script src="/assets/comingsoon/vendor/countdowntime/countdowntime.js"></script>
  <script>
    $('.cd100').countdown100({
      /*Set Endtime here*/
      /*Endtime must be > current time*/
      endtimeYear: 0,
      endtimeMonth: 0,
      endtimeDate: 7,
      endtimeHours: 18,
      endtimeMinutes: 0,
      endtimeSeconds: 0,
      timeZone: "" 
      // ex:  timeZone: "America/New_York"
      //go to " http://momentjs.com/timezone/ " to get timezone
    });
  </script>
<!--===============================================================================================-->
  <script src="/assets/comingsoon/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
<!--===============================================================================================-->
  <script src="/assets/comingsoon/js/main.js"></script>

</body>
</html>