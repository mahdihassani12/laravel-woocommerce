@extends('backend.layouts.app')
@section('main_content')

	<section class="content-header">
		<h3 class="box-title">{{ trans('labels.add_new_learning') }}</h3>
 	</section>

 	<section class="content">
 		<div class="row">
 			<div class="col-md-12">
 				
 				<form action="{{ route('learnings.store') }}" method="post" enctype="multipart/form-data" style="background: #fff; border-radius: 5px; padding:10px; ">
			      	@csrf
			      	<div class="row">
			      	 <div class="form-group col-md-12">
			          <input type="text" class="form-control" name="title" placeholder="{{ trans('labels.title') }}" required="required">
			        </div>

			      	<div class="col-md-9">
			       
			       
			        <div class="form-group">
                       <textarea name="excerpt" placeholder="{{trans('labels.excerpt')}}" class="form-control" rows="6"></textarea>         
                    </div>

			       
                    
			        <div>
			          <textarea class="form-control summernote" name="description" placeholder="{{ trans('labels.description') }}" 
			          			rows="10" cols="10" required="required" placeholder="{{trans('labels.description')}}"></textarea>
			        </div>

                     <div class="form-group">
                         <label for="file">{{trans('labels.learning_file')}}</label>
                         <input type="file" class="form-control" name="file" id="file" required="required">
                      </div>

				     </div>
				     <div class="col-md-3">
				     	
				         <div class="form-group">
			        	  <label for="image">{{ trans('labels.image') }}</label>
			        	   <input type="file" id="featured_image" class="form-control" name="image">
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