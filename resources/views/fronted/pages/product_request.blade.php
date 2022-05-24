@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="row product_request">
           <div class="col-xs-12 request_title"><h2>{{$data['setting']->request_title}}</h2></div>
     		<div class="col-md-6">
     			<div class="product_request_text">
				    {!!$data['setting']->request_text!!}
					
     			</div>
     		</div> <!-- end of col -->

     		<div class="col-md-6">
     			<div class="product_request_form">
     				<div class="row">

     					<form action="{{ route('requests.store') }}" method="post">
     						@csrf
	     					<div class="form-group col-md-6">
	     						<label for='name'>{{ trans('labels.name') }}</label>
	     						<input type="text" required id="name" name="name" class="form-control" placeholder="{{ trans('labels.name') }}"  value="{{old('name')}}">
	     					</div>
	     					<div class="col-md-6 form-group">
	     						<label for="phone">{{ trans('labels.phone') }}</label>
	     						<input type="text" required id='phone' name="phone" class="form-control"  placeholder="{{ trans('labels.phone') }}" value="{{old('phone')}}">
	     					</div>
	     					<div class="col-md-6 form-group">
	     						<label for="email" >{{ trans('labels.email') }}</label>
	     						<input type="email"  name="email" class="form-control" id="email" placeholder="{{ trans('labels.email') }}" value="{{old('email')}}">
	     					</div>
	     					<div class="col-md-6 form-group">
	     						<label for="product_name">{{ trans('labels.product_name') }}</label>
	     						<input type="text" required name="product_name" id="product_name" class="form-control" placeholder="{{ trans('labels.product_name') }}" value="{{old('product_name')}}">
	     					</div>
	     					<div class="col-md-12">
	     						<label for="address">{{ trans('labels.address') }}</label>
	     						<textarea required cols="5" rows="5" name="address" id="address" class="form-control" placeholder="{{ trans('labels.address') }}">{{old('address')}}</textarea>
	     					</div>
	     					<div class="product_request_btn">
	     						<button class="btn" type="submit">{{ trans('labels.send') }}</button>
	     					</div>
	     				</form>

     				</div>
     			</div>
     		</div> <!-- end of col -->

     	</div> <!-- end of row -->
    </div> <!-- end of container -->
	
 	<style>
	  .product_request_text{
		  font-size:18px;
	  }
	  .request_title{
		  margin-bottom:22px;
	  }
	  .product_request_text ol li ul{list-style:none; font-weight:bold;margin:13px 0px;padding-right:10px;}
	  .product_request_text ol li ul li{color:red;}
	</style>
 	@endsection