@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
     	<div class="row downloads_container">

     		<div class="col-md-9">
     			
     			@foreach($learning as $lr)
                    <div class="row downloads_row">
     					<div class="col-md-4">
     						<div class="download_image">
     							<img src='{{ asset("public/uploads/learning_images/$lr->feature_image") }}'>
     						</div>
     					</div>
     					<div class="col-md-8">
     						<div class="download_details">
                              
     							<h3>     <a href='{{ asset("learning/single?id=".$lr->id."&learning=".$lr->title) }}'>{{ $lr->title }} </a></h3>
                               
     							<div>
                                    
                                    <?php echo $lr->excerpt;
                                    ?>
     							</div>
     							<a href='{{ asset("learning/single?id=".$lr->id."&learning=".$lr->title) }}' class="download_link">
     								{{ trans('labels.read_more') }} &nbsp; <span class="fa fa-angle-left"></span>
     							</a>
     						</div>
     					</div>
                    </div> <!-- end of row -->
     			@endforeach
     			

     			<div class="box-footer clearfix no-border downloads_pagination">
	               <div class="pagination_links">
	               	{{ $learning->links() }}     
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