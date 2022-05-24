@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content-header">
          <h3 class="box-title">{{ trans('labels.editing_tag') }}</h3>
	 </section>

   <section class="content">
     <div class="row">
        <div class="col-md-6">
            
            <form action="{{ route('tags.update',$tag->id) }}" method="post">
                  @method('PUT')
                  @csrf
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" value="{{ $tag->name }}" autocomplete="off">
                  </div>

                  <div class="box-footer clearfix">
                    <button type="submit" class="pull-left btn btn-default" id="sendEmail">{{ trans('labels.edit') }}
                      <i class="fa fa-arrow-circle-left"></i></button>
                  </div>
                </div>
            </form>

        </div> <!-- end of col -->
     </div>
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

