@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content-header">
	  <h3 class="box-title">{{ trans('labels.add_new_category') }}</h3>
    </section>

     <section class="content">	
    
        <form action="{{ route('categories.store') }}" method="post">
          @csrf
    			  <div class="col-md-6">	
              <div class="form-group">
    	          <label for="categories">
                  {{ trans('labels.name') }}
                </label>
                <input type="text" class="form-control" name="name" placeholder="{{ trans('labels.name') }}" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="categories">
                  {{ trans('labels.select_parent_category') }}
                </label>
                <select class="form-control select2 " name="parent" id="categories">
                  <option>{{ trans('labels.select_category') }}</option>
                  @foreach($categories as $category)

                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <button type="submit" class="pull-left btn btn-primary" id="sendEmail">{{ trans('labels.save') }}
                  <i class="fa fa-arrow-circle-left"></i></button>
              </div>
            </div>
        </form>
  
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

