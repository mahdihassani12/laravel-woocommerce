<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>{{$data['setting']->app_name}} | {{$data['page_title']}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  
  <link rel="stylesheet" href="{{asset('backend/css/bootstrap-theme.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/rtl.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/jquery-jvectormap.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/AdminLTE.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/persian-datepicker-0.4.5.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/summernote.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/fileinput.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/theme.css')}}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">

  <link rel="stylesheet" href="{{asset('backend/css/custome.css')}}">


  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,40    0,600,700,300italic,400italic,600italic">
   <link rel="icon" type="image/x-icon" href="{{asset('icons')}}/{{$data['setting']->logo}}">     
  @yield('style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
     <!-- header -->
	 @include('backend.includes.header')
	 
    <!--sidebar right-->
	@include('backend.includes.sidebar')
	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     
	 @yield('main_content')
	 
  </div>
  <!-- /.content-wrapper -->
 
 
 <!--footer-->
 @include('backend.includes.footer')
 
</div>
<!-- ./wrapper -->


<script src="{{asset('backend/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/fastclick.js')}}"></script>
<script src="{{asset('backend/js/adminlte.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('backend/js/select2.full.min.js')}}"></script>
<script src="{{asset('backend/js/Chart.min.js')}}"></script>
<script src="{{asset('backend/js/dashboard2.js')}}"></script>
<script src="{{asset('backend/js/demo.js')}}"></script>
<script src="{{asset('backend/js/persian-date-0.1.8.min.js')}}"></script>
<script src="{{asset('backend/js/persian-datepicker-0.4.5.min.js')}}"></script>
<script src="{{asset('backend/js/summernote.min.js')}}"></script>
<script src="{{asset('backend/js/piexif.js')}}"></script>
<script src="{{asset('backend/js/sortable.js')}}"></script>
<script src="{{asset('backend/js/fileinput.js')}}"></script>
<script src="{{asset('backend/js/fa.js')}}"></script>
<script src="{{asset('backend/js/theme.js')}}"></script>
<script src="{{asset('backend/js/theme-fas.js')}}"></script>


<script>
    $(document).ready(function () {
		//format: 'D MMMM YYYY HH:mm a',
        $('.datepicker').persianDatepicker({
            altField: '.jl_datepicker',
            altFormat: 'X',
            format: 'YYYY-M-D',
            observer: true,
            timePicker: {
                enabled: false
            },
           });
		   
		   
		    
  $(document).ready(function() {
	   $('.summernote').summernote({
        height: ($(window).height() - 300),
		callbacks:{
			onImageUpload: function(image) {
				var destination=$(this).attr("name");
				
				uploadImage(image[0],destination);
			}
		}
       });
	});
	
        });
		
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
  })
 
	
   setTimeout(function() {
        $('.wrongmessages').fadeOut('slow');
        $('.successmessages').fadeOut('slow');
    }, 3000);
             
</script>
@yield('script')
</body>
</html>
