@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content-header">
     <!-- Tags creation form -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">{{ trans('labels.edit_category') }}</h3>

            </div>
            <div class="box-body">
              <form action="{{ route('product_categories.update',$data['category']->id) }}" method="post" enctype="multipart/form-data">
              	@method('PUT')
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="{{ $data['category']->name }}" autocomplete="off">
                </div>

                 <div class="form-group">
				    <select name="parent_id" class="select2" style="width: 100%">
					   <option value="">{{trans('labels.parent_category')}}</option>
					   @foreach($data['parents'] as $pr)
					     <option value="{{$pr->id}}" @if($pr->id==$data['category']->parent_id) selected @endif>{{$pr->name}}</option>
					   @endforeach
					</select>
				 </div>
				 
				  <div class="form-group">
                 <label for="photo">
                  {{ trans('labels.photo') }}
                </label>
                <input type="file" class="form-control" name="photo" >
              </div>
              
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-left btn btn-primary" id="sendEmail">{{ trans('labels.edit') }}
                    <i class="fa fa-arrow-circle-left"></i></button>
                </div>
              </div>

              </form>
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

