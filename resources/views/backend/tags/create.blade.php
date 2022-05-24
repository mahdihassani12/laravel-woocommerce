@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content-header">
              <h3 class="box-title">{{ trans('labels.add_new_tag') }}</h3>
	 </section>

   <section class="content">
      <div class="row">
          <div class="col-md-6">
              
              <form action="{{ route('tags.store') }}" method="post">
                @csrf
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="{{ trans('labels.tag') }}" autocomplete="off" required="required">
                  </div>

                  <div class="box-footer clearfix">
                    <button type="submit" class="pull-left btn btn-default" id="sendEmail">{{ trans('labels.send') }}
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

