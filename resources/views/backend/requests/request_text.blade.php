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
             
            <form method="POST" action="{{asset('request_text/update')}}" enctype="multipart/form-data" class="create_form">    
               {{csrf_field()}}
                  <div class="form-group">  
                     <input type="text" class="form-control" name="title" placeholder="{{trans('labels.title')}}" value="{{$data['setting']->request_title}}">
                   </div>  
                 <div class="form-group" style="margin-top:14px;">
					 <textarea name="description" class="summernote form-control" rows="6" placeholder="{{trans('labels.description')}}">{{$data['setting']->request_text}}</textarea>
				 </div>
             <div style="margin-top:10px;">
             	<input type="submit" name="" value="{{trans('labels.save')}}" class="btn btn-primary">
             </div>

            </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              
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

