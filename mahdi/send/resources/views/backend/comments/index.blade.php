@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
	 <h3 class="box-title">
	 	<i class="fa fa-download"></i> {{trans('labels.comments')}} 
	  </h3>		  
	</div>
    <section class="content">
     
    	<!-- Posts List -->
          <div class="box box-primary">
            
            <div class="box-body">
             
            	<table class="table downloads_table">
            		<thead>
            			<tr>
            				<th>
            					<span class="handle">
			                        <i class="fa fa-ellipsis-v"></i>
			                        <i class="fa fa-ellipsis-v"></i>
			                    </span>
			                    {{ trans('labels.name') }}
            				</th>
            				<th>{{ trans('labels.email') }}</th>
                    <th>{{ trans('labels.status') }}</th>
            				<th>{{ trans('labels.comments') }}</th>
            			</tr>
            		</thead>
            		<tbody>
                  @if( count($comments) <= 0 )
                    <tr>
                      <td>Nothing found</td>
                    </tr>
                  @else
            			@foreach($comments as $comment)
            				<tr>
            					<td>
                        {{ $comment->user_name }}

                        <div class="row_options">  
                           <form action="{{ route('comments.update',$comment->id) }}" method="post" class="comment_approve_form">
                             @csrf
                             @method('PUT')
                             <button type="submit" class="btn comment_approved">{{trans('labels.accept')}}</button>
                           </form>
                           <meta name="csrf-token" content="{{ csrf_token() }}">
                             <a class="text-danger" href="{{ route('comments.delete',$comment->id) }}" 
                                onclick='return confirm("{{trans('msg.are_you_sure')}}")'>
                              {{trans('labels.delete')}}
                             </a>
                        </div>

                      </td>
            					<td>{{ $comment->user_email }}</td>
                      <td>
                         @if($comment->status == 1)

                            <span style="background: lightgreen" class="status">{{trans('labels.reviewed')}}</span>

                         @else

                            <span style="background: red" class="status">{{trans('labels.new')}}</span>
                            
                         @endif
                      </td>
            					<td>{{ $comment->content }}</td>
            				</tr>
            			@endforeach
                  @endif
            		</tbody>
            	</table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <div class="pull-left pagination_links">
               	{{ $comments->links() }}     
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