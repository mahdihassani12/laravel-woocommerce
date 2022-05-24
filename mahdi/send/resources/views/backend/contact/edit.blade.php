@extends('backend.layouts.app')
@section('main_content')

	<section class="content-header">
		<h3 class="box-title">{{ trans('labels.contact_details') }}</h3>
 	</section>

 	<section class="content">
 		<div class="row">
 			<div class="col-md-3"></div>
 			<div class="col-md-6">
 				<div class="box box-primary">
	            <div class="box-header">
	                <h3 class="box-title">
	                <i class="ion ion-clipboard"></i> {{trans('labels.editing_category')}}
	              </h3>
	            </div>
               <!-- /.box-header -->
               <div class="box-body">

 				<form action="{{ route('contact.update',$contact->id) }}" method="post" enctype="multipart/form-data">
			      	@csrf
			      	@method('PUT')
			        <div class="form-group">
			          <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}">
			        </div>
			        <div class="form-group">
			        	<input type="text" name="phone2" class="form-control" value="{{ $contact->phone2 }}">
			        </div>
			        <div class="form-group">
			        	<input type="email" name="email" class="form-control" value="{{ $contact->email }}">
			        </div>
			        <div class="form-group">
			        	<input type="email" name="email2" class="form-control" value="{{ $contact->email2 }}">
			        </div>
			        <div>
			          <textarea class="form-control" name="address"  
			          			rows="10" cols="10">{{ $contact->address }}</textarea>
			        </div>

			        <div class="box-footer clearfix">
				      <button type="submit" class="btn btn-primary pull-left">
				      	<i class="fa fa-plus"></i> {{ trans('labels.save') }}
		              </button>
				    </div>
			     </form>
                </div>
            </div>
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