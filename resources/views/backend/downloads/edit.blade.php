@extends('backend.layouts.app')
@section('main_content')

	<section class="content-header">
		<h3 class="box-title">{{ trans('labels.download_editing') }}</h3>
 	</section>

 	<section class="content">
 		<div class="row">
 			<div class="col-md-12">
 				
 				<form action="{{ route('downloads.update',$download->id) }}" method="post" enctype="multipart/form-data" style="background: #fff; border-radius: 5px; padding:10px; ">
			      	@csrf
			      	@method('PUT')
			        <div class="form-group">
			          <input type="text" class="form-control" name="name" value="{{ $download->name }}" >
			        </div>
			        <div class="row">
			          <div class="col-md-9">	
				        <div class="form-group">
				        	<input type="text" name="price" class="form-control" value="{{ $download->price }}">
				        </div>
				        <div class="form-group">
				          حجم فایل: {{ number_format($download->size / 1048576,2).'MB' }}
				          <input type="file" class="form-control" name="file" id="download_file">
				        </div>
				        <div>
				          <textarea class="form-control summernote" name="description" rows="10" 
				          			cols="10">{{ $download->description }}</textarea>
				        </div>

				        
					   </div>
					   <div class="col-md-3">
					   	  <div class="form-group download_image download_image_edit" >
			        	<img src='{{ asset("public/uploads/files_image/$download->image") }}' style="max-width: 100%">
			        	<label class="text-danger" style="font-size: 11px;">{{trans('labels.leave_empty')}}</label>
			        	<input type="file" name="image" class="form-control" id="featured_image">
			        </div>

                         <div class="form-group">
                          <button type="submit" class="btn btn-primary pull-left">
                            <i class="fa fa-plus"></i> {{ trans('labels.save') }}
                          </button>
                        </div>

					   </div>
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
   
    $("#featured_image").fileinput({
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

    $("#download_file").fileinput({
        theme: 'fas',
        language: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['zip', 'rar', 'exe','msi','pdf'],
        overwriteInitial: false,
        maxFileSize: 100000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });


   var APP_URL = {!! json_encode(url('/')) !!}

$(document).ready(function() {
     $('.summernote').summernote({
        height: ($(window).height() - 300),
    callbacks:{
      onImageUpload: function(image) {
        var destination=$(this).attr("name");
        
        uploadImage(image[0],destination);
      }
    }
    });
  });

    function uploadImage(image,destination) {
    var data = new FormData();
    data.append("image", image);
  //alert('{{ csrf_token() }}');
    data.append("_token", '{{ csrf_token() }}');
    
    $.ajax({
        url:APP_URL+ '/post/upload_image',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
        
      url=APP_URL+"public/uploads/posts/content/"+url;
      
            var image = $('<img>').attr('src', url);
            $("textarea[name='"+destination+"']").summernote("insertNode", image[0]);
        },
        error: function(data) {
            console.log(data);
        }
    });
}
</script>
@endsection