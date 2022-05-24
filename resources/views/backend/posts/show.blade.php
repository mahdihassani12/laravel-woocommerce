@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content">
     
     <!-- Tags List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">{{ trans('labels.posts') }}</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                <h3 class="post_title">
                    {{ $post->title }}

                    <div class="tools posts_editing">
                        <a href="{{ route('posts.edit',$post->id) }}">
                          {{ trans('labels.edit') }}
                        </a> &nbsp

                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <a class="text-danger" href="{{ route('post.delete',$post->id) }}">
                          {{ trans('labels.delete') }}
                        </a>
                     </div>

                </h3>

                	<ul class="list">
                		<h4>دسته ها</h4>
                		@foreach($post->categories as $category)
                			<li>{{ $category->name }}</li>
                		@endforeach
                	</ul>

                	<ul class="list">
                		<h4>تگ ها</h4>
                		@foreach($post->tags as $tag)
                			<li>{{ $tag->name }}</li>
                		@endforeach
                	</ul>

                <div class="post_content">
                	{!! $post->content !!}	
                </div>

                <div class="post_image">
                	<img src='{{ url("public/uploads/posts/$post->featured_image") }}'>
                </div>

            </div>
         </div>
	   </section>
	
@endsection

@section('style')
  <style>

  	h3.post_title{
  		background: #f4f4f4;
        padding: 10px;
        border-radius: 5px;
        border-right: 2px solid #e6e7e8;
  	}
  	ul.list{
  		padding: 0;
    	list-style: none;
    	padding-right: 10px;
    	margin-top: 20px;
  	}
  	ul.list li{
  		display: inline-block;
    	padding-right: 12px;
  	}
    div.post_image{
      text-align: center;
    }
    div.post_image img{
      width: 90%;
      height: auto;
      object-fit: cover;
    }
    div.posts_editing{
      display: inline;
        float: left;
        margin-left: 10px;
    }
    h3.post_title{
      font-size: 13px;
    }
    div.post_content{
      background: #f4f4f4;
      padding-right: 15px;
      padding-top: 15px;
      border-radius: 10px;
    }
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection