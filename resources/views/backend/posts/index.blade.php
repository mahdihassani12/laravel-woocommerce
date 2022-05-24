@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
	 <h3 class="box-title">  <i class="ion ion-clipboard"></i> {{trans('labels.posts')}} 
	       <button type="button" class="btn btn-default pull-left">
              	<a href="{{ route('posts.create') }}">
              		<i class="fa fa-plus"></i> {{ trans('labels.new') }}
              	</a>
              </button>
	  </h3>		  
	</div>
    <section class="content">
     
    	<!-- Posts List -->
          <div class="box box-primary">
            
            <div class="box-body table-responsive">
             
            	<table class="table">
            		<thead>
            			<tr>
            				<th>
            					<span class="handle">
	                          <i class="fa fa-ellipsis-v"></i>
	                          <i class="fa fa-ellipsis-v"></i>
	                    </span>
	            				{{trans('labels.title')}}
	            			</th>
            				<th>{{trans('labels.categories')}}</th>
            				<th>{{trans('labels.tags')}}</th>
            				<th>{{trans('labels.date')}}</th>
            			</tr>
            		</thead>
            		<tbody>

                  @if(count($posts) <= 0)

                    <tr>
                      <td>{{ trans('labels.no_posts') }}</td>
                    </tr>

                  @else
            			@foreach($posts as $post)

            				<tr>
	            				<td>
								    <a href="{{ route('posts.show',$post->slug) }}">{{ $post->title }}</a>
	            			<p class="row_options">  
								     <a target="_blank" href='{{ asset("blog/post?id=".$post->id."&title=".$post->title)}}'> {{trans('labels.view')}} </a> &nbsp;
								     <a href="{{ route('posts.edit',$post->id) }}" class="text-warning"> {{trans('labels.edit')}} </a>  &nbsp; 
									 <meta name="csrf-token" content="{{ csrf_token() }}">
		                   <a class="text-danger" href="{{ route('post.delete',$post->id) }}" onclick='return confirm("{{trans('msg.are_you_sure')}}")'>
                        {{trans('labels.delete')}}
                       </a>
								  </p>
								 </td> 
								<td>
                    <span>{{ $post->categories->pluck('name')->implode(', ') }}</span>  
                </td>
								<td>
                  {{ $post->tags->pluck('name')->implode(', ') }}
								</td>
          			<td>
                  {{ convertDateToJalali($post->date) }}
                </td>
          				
        				</tr>

            			@endforeach
                     @endif
            		</tbody>
            	</table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <div class="pull-left pagination_links">
                    {{ $posts->links() }}
                </div>
            </div>
          </div>
          <!-- /.box -->
	
	</section>
@include('backend.includes.message')	
@endsection

@section('style')
  <style>
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection

