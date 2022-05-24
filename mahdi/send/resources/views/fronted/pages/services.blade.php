@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="our_services">
     		<?php $counter = 1; ?>
     		@foreach($services as $service)

     			@if ($counter == 1)
     				<div class="row">
	     				<div class="col-md-8">
	     					<h3 class="service_title">{{ $service->name }}</h3>
	     					{!! $service->description !!}
	     				</div>
	     				<div class="col-md-4">
	     					<div class="service_img">
	     						<img src='{{ asset("/uploads/services/$service->image") }}'>
	     					</div>
	     				</div>
	     			</div>
	     		<?php $counter = 0; ?>	
	     		@else
	     			<div class="row">
	     				<div class="col-md-4">
	     					<div class="service_img">
	     						<img src='{{ asset("/uploads/services/$service->image") }}'>
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
 
   @endsection