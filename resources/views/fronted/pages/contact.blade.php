@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="contact_us">
     		
     		<div class="row">
     			@foreach($contacts as $contact)

     				<div class="col-md-4">
     					<div class="contact_icon">
     						<i class="fa fa-phone"></i>
     					</div>
     					<h3>{{ trans('labels.phone_numbers') }}</h3>
     					<div>
     						<p>{{ $contact->phone }} </p>
     						<p>{{ $contact->phone2 }}</p>
                                   <p>{{ $contact->phone3 }} </p>
                                   <p>{{ $contact->phone4 }}</p>
     					</div>
     				</div> <!-- end of col -->

     				<div class="col-md-4">
     					<div class="contact_icon">
     						<i class="fa fa-envelope"></i>
     					</div>
     					<h3>{{ trans('labels.email_addresses') }}</h3>
     					<div>
     						<p>{{ $contact->email }}</p>
     						<p>{{ $contact->email2 }}</p>
     					</div>
     				</div> <!-- end of col -->

     				<div class="col-md-4">
     					<div class="contact_icon">
     						<i class="fa fa-map-marker"></i>
     					</div>
     					<h3>{{ trans('labels.address') }}</h3>
     					<div>
     						<p>{{ $contact->address }}</p>
     					</div>
     				</div> <!-- end of col -->

     			@endforeach
     		</div> <!-- end of row -->

     		<div class="contact_form">

     			<h1>{{ trans('labels.contact_us_text') }}</h1>
     			<div class="row">
                         <form method="post" action="{{asset('contact/send_email')}}">
                              @csrf
          				<div class="col-md-6 form-group">
          					<label for="name">{{ trans('labels.name') }}</label>
          					<input type="text" name="firstName" id="name" class="form-control" placeholder="{{ trans('labels.name') }}" value="{{old('firstName')}}">
          				</div>
          				<div class="col-md-6 form-group">
          					<label for="lastName">{{ trans('labels.lastname') }}</label>
          					<input type="text" name="lastName" id="lastName" class="form-control"  placeholder="{{ trans('labels.lastname') }}" value="{{old('lastName')}}">
          				</div>
          				<div class="col-md-6 form-group">
          					<label for="email">{{ trans('labels.email_address') }}</label>
          					<input type="text" name="email" id="email" class="form-control" placeholder="{{ trans('labels.email_address') }}"  value="{{old('email')}}">
          				</div>
          				<div class="col-md-6 form-group">
          					<label for="subject">{{ trans('labels.subject') }}</label>
          					<input type="text" name="subject" id="subject" class="form-control" placeholder="{{ trans('labels.subject') }}" value="{{old('subject')}}">
          				</div>
          				<div class="col-md-12 form-group">
          					<label for="message">{{ trans('labels.message') }}</label>
          					<textarea name="message" id="message" class="form-control" placeholder="{{ trans('labels.message') }}"	cols="10" rows="8">{{old('message')}}</textarea>
          				</div>
          				<div class="form-group submit_btn">
          					<button type="submit" class="btn">{{ trans('labels.send') }}</button>
          				</div>
                         </form>

     			</div> <!-- end of row -->

     		</div> <!-- end of contact_form -->

     	</div> <!-- end of contact_us -->
    </div> <!-- end of container -->

   @endsection