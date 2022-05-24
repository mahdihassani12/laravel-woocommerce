@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content">
    	@foreach($about as $ab)

    		<div class="box box-primary">
    			<div class="box-header">
    				<h3 class="about_title">
	                   {{ $ab->title }}

	                   <div class="tools slider_edit">
	                      <a href="{{ route('about.edit',$ab->id) }}">
	                          {{trans('labels.edit')}}
	                      </a>
	                    </div>

	                </h3>
    			</div>
	         </div>
    				
    		<div class="about_image">
	        	<img src='{{ url("/uploads/about/$ab->image") }}'>
	        </div>

	         <div class="box box-primary about_container">
	            <div class="box-body about_content">
	                {!! $ab->content !!}
	            </div>
	         </div>

    	@endforeach
	</section>
@include('backend.includes.message')	
@endsection

@section('style')
  <style>

  		div.about_image img{
  			width: 100%;
  			height: auto;
  			max-height: 400px;
  			object-fit: cover;
  		}
  		div.about_container{
  			margin-top: 30px;
  		}
  		h3.about_title{
  			
		    padding: 10px;
		    
		    border-right: 2px solid #3c8dbc;
  		}
  		div.about_content{
  			padding-top: 35px;
  		}
  		h3.about_title a{
	        font-size: 13px;
	    }
	    div.slider_edit{
	        display: inline;
	        float: left;
	        margin-left: 10px;
	     }
     .about_content img, .about_content .iframe{
         max-width: 100%;

     }  
  </style>
@endsection

@section('script')
<script type="text/javascript">
    $("#featured_image").fileinput({
        theme: 'fas',
        language: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif'],
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

