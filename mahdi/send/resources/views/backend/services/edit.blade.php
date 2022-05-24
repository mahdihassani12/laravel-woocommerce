@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
	 <h3 class="box-title">
	 	<i class="fa fa-address-card"></i> {{trans('labels.editing_service')}} 
	  </h3>		  
	</div>
    <section class="content">
    	
    			
    			<form enctype="multipart/form-data" method="post" action="{{ route('services.update',$service->id) }}" style="background: #fff; border-radius: 10px; padding:10px;">
                    <div class="form-group"> 
                        <label for="title">{{ trans('labels.title') }}</label>
                        <input type="text" id="title" name="name" value="{{ $service->name }}" class="form-control">
                    </div>

                    <div class="row">
                     <div class="col-md-9">
    				@csrf
    				@method('PUT')
    				
    				
    				<div class="form-group">
    					<textarea class="form-control summernote" name="description">{{ $service->description }}</textarea>
    				</div>
    				<div class="form-group">
    					<button type="submit" class="btn btn-primary pull-left">{{ trans('labels.save') }}
                   		 <i class="fa fa-arrow-circle-left"></i></button>
    				</div>
                 </div>
                
                 <div class="col-md-3">
                     <div class="form-group">
                        <div class="service_image">
                            <img src='{{ asset("/uploads/services/$service->image") }}'>
                        </div>
                        <label for="image">{{ trans('labels.featured_image') }} <span class="text-danger" style="font-size: 11px;">{{trans('labels.leave_empty')}}</span></label>
                        <input type="file" id="image" name="image" class="form-control">
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

  	div.service_image img{
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

  //   $(document).ready(function() {
  //    $('.summernote').summernote({
  //       height: ($(window).height() - 300),
  //   callbacks:{
  //     onImageUpload: function(image) {
  //       var destination=$(this).attr("name");
        
  //       uploadImage(image[0],destination);
  //     }
  //   }
  //   });
  // });

//     function uploadImage(image,destination) {

//     var data = new FormData();
//     data.append("image", image);
//   //alert('{{ csrf_token() }}');
//     data.append("_token", '{{ csrf_token() }}');
    
//     $.ajax({
//         url:APP_URL+ '/post/upload_image',
//         cache: false,
//         contentType: false,
//         processData: false,
//         data: data,
//         type: "POST",
//         success: function(url) {
        
//       url=APP_URL+"/uploads/posts/content/"+url;
      
//             var image = $('<img>').attr('src', url);
//             $("textarea[name='"+destination+"']").summernote("insertNode", image[0]);
//         },
//         error: function(data) {
//             console.log(data);
//         }
//     });
// }

</script>
@endsection

