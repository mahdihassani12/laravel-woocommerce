@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="row product_request">

     		<div class="col-md-6">
     			<div class="product_request_text">
     				<h3>لورم ایپسوم</h3>

     				لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.

     			</div>
     		</div> <!-- end of col -->

     		<div class="col-md-6">
     			<div class="product_request_form">
     				<div class="row">

     					<form action="{{ route('requests.store') }}" method="post">
     						@csrf
	     					<div class="form-group col-md-6">
	     						<label for='name'>{{ trans('labels.name') }}</label>
	     						<input type="text" required id="name" name="name" class="form-control" placeholder="{{ trans('labels.name') }}">
	     					</div>
	     					<div class="col-md-6 form-group">
	     						<label for="phone">{{ trans('labels.phone') }}</label>
	     						<input type="text" required id='phone' name="phone" class="form-control" 
	     								placeholder="{{ trans('labels.phone') }}">
	     					</div>
	     					<div class="col-md-6 form-group">
	     						<label for="email" >{{ trans('labels.email') }}</label>
	     						<input type="email"  name="email" class="form-control" id="email" 
	     								placeholder="{{ trans('labels.email') }}">
	     					</div>
	     					<div class="col-md-6 form-group">
	     						<label for="product_name">{{ trans('labels.product_name') }}</label>
	     						<input type="text" required name="product_name" id="product_name" class="form-control" 
	     								placeholder="{{ trans('labels.product_name') }}">
	     					</div>
	     					<div class="col-md-12">
	     						<label for="address">{{ trans('labels.address') }}</label>
	     						<textarea required cols="5" rows="5" name="address" id="address" class="form-control" 
	     									placeholder="{{ trans('labels.address') }}"></textarea>
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
	
 	@include('backend.includes.message')
 	@endsection