@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="row downloads_container">

     		<div class="col-md-9">
     			
     			@foreach($downloads as $download)
                    <div class="row downloads_row">
     					<div class="col-md-4">
     						<div class="download_image">
     							<img src='{{ asset("/uploads/files_image/$download->image") }}'>
     						</div>
     					</div>
     					<div class="col-md-8">
     						<div class="download_details">
     							<h3>{{ $download->name }}</h3>
     							<p>
     								{!! $download->description !!}
     							</p>
     							<a href='{{ asset("view-download?id=".$download->id."&download=".$download->name) }}' class="download_link">
     								{{ trans('labels.view') }} &nbsp; <span class="fa fa-angle-left"></span>
     							</a>
     						</div>
     					</div>
                    </div> <!-- end of row -->
     			@endforeach
     			

     			<div class="box-footer clearfix no-border downloads_pagination">
	               <div class="pagination_links">
	               	{{ $downloads->links() }}     
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