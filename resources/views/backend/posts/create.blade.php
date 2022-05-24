@extends('backend.layouts.app')
@section('main_content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  {{trans('labels.add_post')}}
      </h1>

    </section>


     <section class="content" style="">
        
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" style="background: #fff;border-radius: 5px;padding:10px;">
          @csrf

            <div class="form-group">
              <label>{{ trans('labels.post_title') }}</label>
              <input type="text" name="title" placeholder="{{ trans('labels.title') }}" class="form-control post_title" required="required">
            </div>

            <div class="row">
			
			         <div class="col-md-9 control-label margin-bottom-8">
                 <textarea class="form-control summernote" cols="33" name="content" rows="4" required="required"></textarea>

                 <div class="form-group">
                   <label for="excerpt">{{trans('labels.excerpt')}}</label>
                   <textarea class="form-control" name="excerpt" rows="5"></textarea>
                 </div>
                </div>
              
               

               <div class="col-md-3">
                  <div class="form-group">
				    <label>{{ trans('labels.date') }}</label>
                    <input type="text" class="form-control datepicker" name="date">
				  </div> 
                
                <div class="form-group">				 
				    <label>{{ trans('labels.categories') }}</label>
					 <select class="select2 " style="width: 100%" name="categories[]" multiple required="required">
					  @foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					  @endforeach
					 </select>
				 </div>
				 
				 <div class="form-group">
					 <label>{{ trans('labels.tags') }}</label>
					 <select class="select2 " style="width: 100%" name="tags[]" multiple="multiple" data-select2-tags="true">
					  @foreach($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					  @endforeach
					 </select>
				 </div>
				 
				  <div class="form-group ">				  
				    <label for="featured_image">{{ trans('labels.featured_image') }}</label>
            <input required="required" type="file" class="form-control" name="featured_image" id="featured_image"    data-theme="fas">
				 </div>
				 
				 <div class="form-group">
				    <button type="submit" class=" btn btn-primary " id="sendEmail">{{ trans('labels.save') }}
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

  input.post_title{
    height: 40px;
    border-radius: 5px;
    font-size: 15px;
  }

  div.control-label{
    padding-top: 15px;
  }

  </style>
@endsection

@section('script')
<script type="text/javascript">
    $(".select_with_dynamic_option").select2();

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

