@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content-header">
     
     <!-- Tags creation form -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">{{ trans('labels.add_new_category') }}</h3>

            </div>
            <div class="box-body">
              <form action="{{ route('product_categories.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="{{ trans('labels.category') }}" autocomplete="off">
                </div>
                 
				 <div class="form-group">
				    <select name="parent_id" class="select2 form-control">
					   <option value="">{{trans('labels.parent_category')}}</option>
					   @foreach($parents as $pr)
					     <option value="{{$pr->id}}">{{$pr->name}}</option>
					   @endforeach
					</select>
				 </div>
				 
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-left btn btn-default" id="sendEmail">{{ trans('labels.save') }}
                    <i class="fa fa-arrow-circle-left"></i></button>
                </div>
                 </form>
              </div>

             
            </div>
	
	</section>
	
@endsection

@section('style')
  <style>
  </style>
@endsection

@section('script')
<script type="text/javascript">
    
</script>
@endsection

