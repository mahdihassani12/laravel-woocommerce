@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
	 <h3 class="box-title">
	 	<i class="fa fa-address-card"></i> {{trans('labels.edit_about_us')}} 
	  </h3>		  
	</div>
    <section class="content">		
    	<form enctype="multipart/form-data" method="post" action="{{ route('about.update',$about->id) }}" style="background: #fff; border-radius: 5px; padding:10px;">
    				@csrf
    				@method('PUT')
          <div class="row">
            <div class="col-md-9">
                
    				<div class="form-group"> 
    					<label for="title">{{ trans('labels.title') }}</label>
    					<input type="text" id="title" name="title" value="{{ $about->title }}" class="form-control">
    				</div>
    				
    				<div class="form-group">
    					<textarea class="form-control summernote" name="content">{{ $about->content }}</textarea>
    				</div>
    				
                   </div>

                    <div class="col-md-3">
                        <div class="form-group">
                        <div class="about_image_edit">
                            <img src='{{ url("public/uploads/about/$about->image") }}'>
                        </div>
                        <label for="image">{{ trans('labels.featured_image') }} <span class="text-danger" style="font-size: 11px;">{{trans('labels.leave_empty')}}</span></label>
                        <input type="file" id="image" name="image" class="form-control" >
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-left">{{ trans('labels.save') }}
                         <i class="fa fa-arrow-circle-left"></i></button>
                    </div>
                    
                    </div>
                  </div>  
    			</form>
    	
	</section>
@include('backend.includes.message')	
@endsection

@section('style')
  <style>

  	div.about_image_edit img{
  		width: 250px;
  		height: auto;
  	}
    

  </style>
@endsection

@section('script')
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
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

