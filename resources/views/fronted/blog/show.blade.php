@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="row">

 			<div class="col-md-9">
 				<div class="post_container">
 					<h3>{{ $post->title }}</h3>
 					@foreach($post->tags as $tag)
            			<span class="tags">{{ $tag->name }}</span>
          @endforeach
 					<div class="post_image">
 						<img src='{{ asset("public/uploads/posts/$post->featured_image") }}'>
 					</div>
 					<p>

            <b>{{ trans('labels.date') }}</b> : {{ convertDateToJalali($post->date) }} <br />

 						<?php //$content = strip_tags($post->content);
 							  echo $post->content;
 						?>
 					</p>
           <p class="post_categories">
              <b>{{ trans('labels.categories') }}</b> : <span>{{ $post->categories->pluck('name')->implode(' , ') }}</span>
          </p>
          
 				</div>

          <!-- end of content and starting comments && replies -->

 				<div class="comment_container">

              @if(count($post->comments) > 0)

                @foreach($post->comments as $comment)

                  @if($comment->status ==1)

                     <div class="card">
                       <div class="card-header">
                         <h4>
                           <span><img src='{{ asset("public/uploads/images/user.png") }}'></span>
                           <span class="comment_name">{{ $comment->user_name }}</span>
                         </h4>
                       </div>

                       <div class="card-body">
                         {{ $comment->content }} 
                         <h2><b>{{ trans('labels.answers') }}</b> :</h2> 
                         @foreach($replies as $reply)

                            @if($comment->id == $reply->comment_id)

                              <div class="reply">
                                   {{ $reply->content }}
                              </div>

                           @endif
                          @endforeach

                              <div id="panel" class="panel"> 
                                  <form method="post" action="{{ route('reply.store') }}">
                                      @csrf
                                      <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                      <div class="form-group">
                                          <textarea class="form-control" placeholder="{{ trans('labels.your_answer') }}" 
                                                    name="reply" rows="5"></textarea>
                                      </div>
                                      <button type="submit">{{ trans('labels.send') }}</button>
                                  </form>
                              </div>

                       </div> <!-- card body -->
                     </div> <!-- card -->

                  @endif

                @endforeach

              @endif      

 					<h3>{{ trans('labels.comment') }}</h3>
 					<form method="Post" action="{{ route('comments.store') }}">
                        @csrf
 						<div class="row">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
 							<div class="col-md-12 form-group">
 								<textarea class="form-control" id="message" rows="6" cols="5" 
 										name="message" placeholder="{{ trans('labels.message') }}"></textarea>
 							</div>
 							<div class="col-md-6 form-group">
 								<input type="text" name="name" id="name" class="form-control" placeholder="{{ trans('labels.name') }}">
 							</div>
 							<div class="col-md-6 form-group">
 								<input type="email" name="email" id="email" class="form-control" 
 										placeholder="{{ trans('labels.email') }}">
 							</div>
 							<div class="form-group">
 								<button type="submit" class="btn">{{ trans('labels.comment') }}</button>
 							</div>
 						</div> <!-- end of row -->
 					</form>

 				</div> <!-- end of comment container div --> 
           <div class="related_data">
              <hr>
              <h3>{{trans('labels.related_articles')}}</h3>
              <div class="row">
                @foreach($data['related'] as $rel)
                  <div class="col-md-3">
                      <img src='{{ asset("public/uploads/posts/$rel->featured_image") }}' style="max-width:100%">
                      <h4>
                          <a href='{{ asset("blog/post?id=".$rel->id."&title=".$rel->title) }}' > {{$rel->title}} </a></h4>
                  </div>
                @endforeach  
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

   @section('style')
    <style type="text/css">
        
    </style>
   @endsection

   @section('script')
        <script type="text/javascript">
            $("button[type='submit']").click(function(){
                 $(".page_loader").show();
            })
        </script>   
   @endsection


