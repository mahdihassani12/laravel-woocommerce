@extends('backend.layouts.app')
@section('main_content')

	<section class="content-header">
		<h3 class="box-title">{{ trans('labels.contact_details') }}</h3>
 	</section>

 	<section class="content">
 		<div class="row">
 			<div class="col-md-6">
 				
 				<form action="{{ route('contact.store') }}" method="post" enctype="multipart/form-data">
			      	@csrf
			        <div class="form-group">
			          <input type="text" class="form-control" name="phone" placeholder="{{ trans('labels.phone') }}">
			        </div>
			        <div class="form-group">
			        	<input type="text" name="phone2" class="form-control" placeholder="{{ trans('labels.phone') }}">
			        </div>
			        <div class="form-group">
			        	<input type="email" name="email" class="form-control" placeholder="{{ trans('labels.email') }}">
			        </div>
			        <div class="form-group">
			        	<input type="email" name="email2" class="form-control" placeholder="{{ trans('labels.email') }}">
			        </div>
			        <div>
			          <textarea class="form-control" name="address" placeholder="{{ trans('labels.address') }}" 
			          			rows="10" cols="10"></textarea>
			        </div>

			        <div class="box-footer clearfix">
				      <button type="submit" class="btn btn-default pull-left">
				      	<i class="fa fa-plus"></i> {{ trans('labels.new') }}
		              </button>
				    </div>
			     </form>

 			</div> <!-- end of col -->
 		</div>
 	</section>

@include('backend.includes.message')	
@endsection

@section('style')
  <style>

  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection