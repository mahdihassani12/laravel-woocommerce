<!DOCTYPE html>
<html dir="rtl">
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" type="image/x-icon" href="{{asset('public/icons')}}/{{$data['setting']->logo}}">   
<title>{{$data['setting']->app_name}} | @if(isset($data['title2']) and $data['title2']!='') {{$data['title2']}} @else {{$data['title']}} @endif</title>
<meta name="description" content="{{$data['setting']->description}}">
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/bootstrap-rtl.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/font-awesome.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/stylesheet.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/owl.carousel.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/owl.transitions.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/responsive.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/stylesheet-rtl.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/responsive-rtl.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('public/fronted/css/custom.css')}}" />

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
<div class="page_loader" >
	<div class="lds-ripple"><div></div><div></div></div>
</div> 
</div>
	
<!-- JS Part Start-->
<script type="text/javascript" src="{{asset('public/fronted/js/jquery-2.1.1.min.js')}}" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{asset('public/fronted/js/bootstrap.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/fronted/js/jquery.easing-1.3.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/fronted/js/jquery.dcjqaccordion.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/fronted/js/owl.carousel.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/fronted/js/jquery.elevateZoom-3.0.8.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/fronted/js/ios-orientationchange-fix.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/fronted/js/jquery.swipebox.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/fronted/js/custom.js')}}" ></script>
<!-- JS Part End-->
<script type="text/javascript">
	var APP_URL = {!! json_encode(url('/')) !!}

	$(document).on("click",".show_cart_model",function(){
		 var loader=$(".page_loader");
		 //loader.show();
		$.ajax({
			type:'get',
			url:APP_URL+'/get_cart_modal',
			success:function(response){
              $(".cart_model_items").html(response)
              //loader.hide();
			}
		})
	})



    $(".register_new_user_fronted").validate({
            rules: {
                name: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                 lastname: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                phone: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                 email: {
                        required: true,
                        email: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                password: {
                        required: true,
                        minlength : 5,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                 password_confirmation: {
                        required: true,
                        minlength : 5,
                        equalTo : "#password",
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },

              },
          messages:{
              name:{
                        required: '{{trans("labels.required_field")}}',
              },
              lastname:{
                        required: '{{trans("labels.required_field")}}',
              },
              email:{
                        required: '{{trans("labels.required_field")}}',
                        email: '{{trans("labels.invalid_email")}}',
              },
              phone:{
                        required: '{{trans("labels.required_field")}}',
              },
              password:{
                        required: '{{trans("labels.required_field")}}',
                        minlength: '{{trans("labels.min_length_6")}}',
              },
               password_confirmation:{
                        required: '{{trans("labels.required_field")}}',
                        minlength: '{{trans("labels.min_length_6")}}',
                        equalTo: '{{trans("labels.not_match")}}',
              },
             
             

          },
          submitHandler: function (form) {
                    var ajx_loader = $(".page_loader");
                    var form_data = new FormData($('.register_new_user_fronted')[0]);

                    ajx_loader.show();
                   
                        $.ajax({
                            method:'post',
                            url:APP_URL+'/register',
                            data: form_data,
                            processData: false, 
                            contentType: false,
                            success:function(response){
                                ajx_loader.hide();  
                                setTimeout(function() {location.reload()}, 0);
                            }
                        });
                return false;
            } 
      });

   
     $(".fronted_login").validate({
            rules: {
               
                 email: {
                        required: true,
                        email: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                password: {
                        required: true,
                        minlength : 5,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                }

              },
          messages:{
             
              email:{
                        required: '{{trans("labels.required_field")}}',
                        email: '{{trans("labels.invalid_email")}}',
              },
              
              password:{
                        required: '{{trans("labels.required_field")}}',
                        minlength: '{{trans("labels.min_length_6")}}',
              }
             
             

          },
          submitHandler: function (form) {
                    var ajx_loader = $(".page_loader");
                    var form_data = new FormData($('.fronted_login')[0]);

                    ajx_loader.show();
                        $.ajax({
                            method:'post',
                            url:APP_URL+'/admin/login',
                            data: form_data,
                            processData: false, 
                            contentType: false,
                            success:function(){
                                ajx_loader.hide();   
                                setTimeout(function() {location.reload()}, 0);
                            }
                        });
                return false;
            } 
      });

   
</script>
@yield('script')


</body>
</html>

@include('backend.includes.message')