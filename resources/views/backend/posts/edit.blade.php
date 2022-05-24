@extends('backend.layouts.app')
@section('main_content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ trans('labels.edit') }}
      </h1>

    </section>


     <section class="content" style="">
        
        <form action="{{ route('posts.update',$post->id) }}" method="post" enctype="multipart/form-data" style="background: #fff;border-radius: 5px;padding:10px;">
          @csrf
          @method('PUT')
            <div class="form-group">
              <label>{{ trans('labels.post_title') }}</label>
              <input type="text" name="title" class="form-control" value="{{ $post->title }}">
            </div>
			
            <div class="row">
               <div class="col-md-9 control-label margin-bottom-8">
                 <textarea class="form-control summernote" cols="33" name="content" rows="4">{{ $post->content }}</textarea>

                 <div class="form-group">
                   <label for="excerpt">{{trans('labels.excerpt')}}</label>
                   <textarea class="form-control" name="excerpt" rows="5">{{ $post->except}} </textarea>
                 </div>
               </div>
              
              <div class="col-md-3">
			      <div class="form-group">
				    <label>{{ trans('labels.date') }}</label>
                    <input type="text" class="form-control datepicker" name="date">
				  </div>
				  <div class="form-group">
              <label>{{ trans('labels.categories') }}</label>
              <select class="select2 form-control" name="categories[]" multiple style="width: 100%">
               @foreach($categories as $category)
                  @foreach($post->categories as $cat)
                    <option value="{{ $category->id }}" {{ ( $category->id == $cat->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                  @endforeach
               @endforeach
              </select>
            </div>
				  
				   <div class="form-group">
              <label>{{ trans('labels.tags') }}</label>
              <select class="select2 form-control" multiple name="tags[]" style="width: 100%">
              @foreach($tags as $tag)
                @foreach($post->tags as $tg)
                  <option value="{{ $tag->id }}" {{ ($tag->id == $tg->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
              @endforeach
             </select>
            </div>
			   
			    
                 <div class="form-group">
				    <label for="featured_image">{{ trans('labels.featured_image') }} <span class="text-danger" style="font-size: 11px;">{{trans('labels.leave_empty')}}</span></label>
                    <input type="file" id="featured_image" class="form-control" name="featured_image" >
				 </div>
				 
				 <div class="form-group">
                  <button type="submit" class="btn btn-primary" id="sendEmail">{{ trans('labels.save') }}
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

    div.post_img_edit img{
      width: 200px;
      height: auto;
    }

  </style>
@endsection

@section('script')
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
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

