<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rental Maquinaria</title>

  <!-- Internal Lik -->
  <link href={{ asset('css/nav-bar.css') }} rel="stylesheet">
  <link href={{ asset('css/bootstrap-select.min.css') }} rel="stylesheet">
  <link href={{ asset('css/style.css') }} rel="stylesheet"> 
  <link href={{ asset('css/sb-admin-2.css') }} rel="stylesheet">
  <link href={{ asset('css/login.css') }} rel="stylesheet">  
  <!-- Fin -->
  
    

   <!-- External link -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
   <script src={{ asset("js/bootstrap-select.min.js") }}></script>
   <script src={{ asset("js/scrolling-nav.js") }}></script>
   <!-- Fin  -->
 <style>
     .v-enter-active, .v-enter-leve{
         transition: opacity 1.0s;
     }

     .v-enter, v-enter-to{
        opacity:0;
     }
 </style> 
</head>
<body>
    <div id ="app">
            <Main-App/>
    </div>         
    <script src="{{asset('/js/app.js')}}"></script>
</body>
</html>