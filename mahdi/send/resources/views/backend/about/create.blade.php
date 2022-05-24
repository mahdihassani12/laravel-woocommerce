@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
	 <h3 class="box-title">
	 	<i class="fa fa-address-card"></i> {{trans('labels.about_us')}} 
	  </h3>		  
	</div>
    <section class="content">
    	<div class="row">
    		<div class="col-md-8">
    			
    			<form enctype="multipart/form-data" method="post" action="{{ route('about.store') }}">
    				@csrf
    				<div class="form-group"> 
    					<label for="title">{{ trans('labels.title') }}</label>
    					<input type="text" id="title" name="title" placeholder="{{ trans('labels.title') }}" class="form-control">
    				</div>
    				<div class="form-group">
    					<label for="image">{{ trans('labels.featured_image') }}</label>
    					<input type="file" id="image" name="image" class="form-control">
    				</div>
    				<div class="form-group">
    					<textarea class="form-control summernote" name="content"></textarea>
    				</div>
    				<div class="form-group">
    					<button type="submit" class="btn btn-primary pull-left">{{ trans('labels.save') }}
                   		 <i class="fa fa-arrow-circle-left"></i></button>
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

