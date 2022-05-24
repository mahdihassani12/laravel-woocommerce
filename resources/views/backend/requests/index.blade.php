@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
	 <h3 class="box-title"> 
	 	<i class="fa fa-download"></i>
	 	{{ trans('labels.requests') }}
	  </h3>		  
	</div>
    <section class="content">
     
    	<!-- Posts List -->
          <div class="box box-primary">
            
            <div class="box-body table-responsive">
             
            	<table class="table">
            		<thead>
    					<tr>
    						<th>{{ trans('labels.name') }}</th>
    						<th>{{ trans('labels.phone') }}</th>
    						<th>{{ trans('labels.email') }}</th>
    						<th>{{ trans('labels.product_name') }}</th>
    						<th>{{ trans('labels.address') }}</th>
    						<th>{{ trans('labels.status') }}</th>
    					</tr>
            		</thead>
            		<tbody>
            			@if(count($requests) <= 0)
            				<tr>
            					<td>
            						<span class="handle">
				                          <i class="fa fa-ellipsis-v"></i>
				                          <i class="fa fa-ellipsis-v"></i>
				                    </span>
				                    {{ trans('labels.no_request') }}
            					</td>
            				</tr>
		                @else
            			@foreach($requests as $request)
            				<tr>
            					<td>
            						{{ $request->name }}
            						<div class="tools row_options">

				                      <meta name="csrf-token" content="{{ csrf_token() }}">
				                      <a class="text-danger" href="{{ route('requests.delete',$request->id) }}" 
				                        onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
				                        {{ method_field('DELETE') }}
				                        {{trans('labels.delete')}}
				                      </a>

				                    </div>
            					</td>
            					<td>{{ $request->phone }}</td>
            					<td>{{ $request->email }}</td>
            					<td>{{ $request->product_name }}</td>
            					<td>{{ $request->address }}</td>
            					<td>
								   <select class='change_status' req_id='{{$request->id}}' @if($request->status==1)  style='background:red' @else style='background:lightgreen' @endif>
								      <option value='1' @if($request->status==1) selected  @endif>{{trans('labels.new')}}</option>
								      <option value='2' @if($request->status==2) selected  @endif>{{trans('labels.reviewed')}}</option>
								   </select>
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
               	{{ $requests->links() }}     
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
  var APP_URL = {!! json_encode(url('/')) !!}
   $(document).on('change','.change_status',function(){
	   var status=$(this).val();
	   var request_id=$(this).attr('req_id');
	   $.ajax({
		url:APP_URL+ '/request/change_status?id='+request_id+'&status='+status,
        type: "get",
        success: function(url) {
           location.reload();
       },
        error: function(data) {
            console.log(data);
        }  
	   })
   })
</script>
@endsection

