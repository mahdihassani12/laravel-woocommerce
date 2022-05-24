@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="our_services">
     		<?php $counter = 1; ?>
     		@foreach($services as $service)

     			@if ($counter == 1)
     				<div class="row services_section">
	     				<div class="col-md-8 service_description">
	     					<h3 class="service_title ">{{ $service->name }}</h3>
	     					{!! $service->description !!}
	     				</div>
	     				<div class="col-md-4 col-sm-12  service_image">
	     					<div class="service_img">
	     						<img src='{{ asset("public/uploads/services/$service->image") }}'>
	     					</div>
	     				</div>
	     			</div>
	     		<?php $counter = 0; ?>	
	     		@else
	     			<div class="row">
	     				<div class="col-md-4">
	     					<div class="service_img">
	     						<img src='{{ asset("public/uploads/services/$service->image") }}'>
	     					</div>
	     				</div>
	     				<div class="col-md-8">
	     					<h3 class="service_title">{{ $service->name }}</h3>
	     					{!! $service->description !!}
	     				</div>
	     			</div>
	     		<?php $counter = 1; ?>
	     		@endif	
     		@endforeach
     	</div> <!-- end of our services -->
    </div> <!-- end of container -->
 
 <style type="text/css">
 	@media(max-width: 768px){
 		.services_section{
 			display: flex;
 			flex-direction: column;
 		}
 		.services_section .service_description{
            order: 2;
            }
 		.services_section .service_image{
 			order: 1; 
 			 
 		}
 	}
 </style>
   @endsection