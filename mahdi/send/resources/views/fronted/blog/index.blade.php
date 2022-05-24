@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="row">

 			<div class="col-md-9">
 				@foreach($posts as $post)
     				<div class="post_container row">

     					<h3 >{{ $post->title }}</h3>
     					@foreach($post->tags as $tag)
                			<span class="tags">{{ $tag->name }}</span>
                		@endforeach
     					<div class="post_image col-md-4">
     						<img src='{{ asset("/uploads/posts/$post->featured_image") }}'>
     					</div>
     					<div class="post_content col-md-8">
						<?php //$content = strip_tags($post->content);?>
     					<p>{{$post->except}}</p>
     					<a href='{{ asset("blog/post?id=".$post->id."&title=".$post->title) }}' class="read_more">{{ trans('labels.read_more') }} <span class="fa fa-angle-left"></span></a>
                       </div>
     				</div>
 				@endforeach

 			<div class="box-footer clearfix no-border downloads_pagination">
		       <div class="pagination_links">
		       	    {{ $posts->links() }}
		       </div>
		    </div>

 			</div> <!-- end of col -->

     		<div class="col-md-3 hidden-xs">
     			<aside id="column-right">
		          @include('fronted.includes.left-sidebar')  
		        </aside>
     		</div> <!-- end of col -->

     	</div> <!-- end of row -->
    </div> <!-- end of container -->
 
   @endsection