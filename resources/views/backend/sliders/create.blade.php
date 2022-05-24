@extends('backend.layouts.app')
@section('main_content')

	<section class="content-header">
 	</section>

 	<section class="content">
 		<div class="row">
 			<div class="col-md-2"></div>
 			<div class="col-md-8">
 			<div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.create_new_slider')}}
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	
 				<form action="{{ route('sliders.store') }}" method="post" enctype="multipart/form-data">
			      	@csrf
			        <div class="form-group">
			          <input type="text" class="form-control" name="title" placeholder="{{ trans('labels.title') }}">
			        </div>
			        <div class="form-group" >
                       <label style="color: red">{{trans('labels.dimension_should_be')}} <span style="direction: ltr;">920x380</span></label> 
			          <input type="file" class="form-control" name="image" id="image">
			        </div>
			        <div  style="display: none;">
			          <textarea class="form-control" name="description" placeholder="{{ trans('labels.description') }}" rows="10" cols="10"></textarea>
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