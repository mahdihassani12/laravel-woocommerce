@extends('backend.layouts.app')
@section('main_content')

	<section class="content-header">
		<h3 class="box-title">{{ trans('labels.editing_slider') }}</h3>
 	</section>

 	<section class="content">
 		<div class="row">
 			<div class="col-md-12">
 			<div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.create_new_slider')}}
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
 				<form action="{{ route('sliders.update',$slider->id) }}" method="post" enctype="multipart/form-data">
			      	@csrf
			      	@method('PUT')
			      <div class="row">
			        <div class="col-md-9">	

			        <div class="form-group">
			          <input type="text" class="form-control" name="title" value="{{$slider->title}}">
			        </div>
			       
			        <div style="display: none;">
			          <textarea class="form-control" name="description" rows="10" cols="10">{{ $slider->description }}</textarea>
			        </div>

			        <div class="box-footer clearfix">
				      <button type="submit" class="btn btn-primary pull-left">
				      	<i class="fa fa-plus"></i> {{ trans('labels.save') }}
		              </button>
				    </div>
				   </div>
				   <div class="col-md-3">
				   	  <div class="form-group">
			        	<img class="editing_slider_img" src='{{ url("public/uploads/sliders/$slider->image") }}' style="max-width: 100%">
			        	<label class="text-danger" style="font-size: 11px;">{{trans('labels.leave_empty')}}</label>
			          <input type="file" class="form-control" name="image" id="image">
			        </div>
				   </div>
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

img.editing_slider_img{
	width: 250px;
		height: auto;
	object-fit: cover;
	margin-bottom: 10px;
}

  </style>
@endsection

@section('script')
<script type="text/javascript">
       $("#image").fileinput({
        theme: 'fas',
        language: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });

</script>
@endsection