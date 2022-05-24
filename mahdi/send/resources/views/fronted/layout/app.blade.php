<!DOCTYPE html>
<html dir="rtl">
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />
<title>{{$data['setting']->app_name}} | @if(isset($data['title2']) and $data['title2']!='') {{$data['title2']}} @else {{$data['title']}} @endif</title>
<meta name="description" content="Responsive and clean html template design for any kind of ecommerce webshop">
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/bootstrap-rtl.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/font-awesome.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/stylesheet.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/owl.carousel.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/owl.transitions.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/responsive.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/stylesheet-rtl.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/responsive-rtl.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('fronted/css/custom.css')}}" />

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>
<!-- CSS Part End-->
@yield('style')
</head>
<body>
<div class="wrapper-wide">
@include('fronted.includes.header')
  <div id="container">
      @yield('main_content')
  </div>	
@include('fronted.includes.footer')
 
</div>
<!-- JS Part Start-->
<script type="text/javascript" src="{{asset('fronted/js/jquery-2.1.1.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('fronted/js/bootstrap.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('fronted/js/jquery.easing-1.3.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('fronted/js/jquery.dcjqaccordion.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('fronted/js/owl.carousel.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('fronted/js/custom.js')}}" ></script>
<!-- JS Part End-->
@yield('script')
</body>
</html>