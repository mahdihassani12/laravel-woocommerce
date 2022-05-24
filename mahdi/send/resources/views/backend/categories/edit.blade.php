@extends('backend.layouts.app')
@section('main_content')
  
   

   <section class="content">
     <div class="row">
       <div class="col-md-3">
         
       </div>
        <div class="col-md-6">
            <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.editing_category')}}
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <form action="{{ route('categories.update',$category->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="{{ $category->name }}" autocomplete="off" required="required">
                </div>

                <div class="form-group">
                  <label for="categories">
                    {{ trans('labels.parent_category') }}
                  </label>
                  <select class="select2 " style="width: 100%" name="parent" id="categories">
                    <option>{{ trans('labels.select_category') }}</option>
                    @foreach($categories as $cat)
                      <option value="{{ $cat->id }}" {{ ($category->parent == $cat->id) ? 'selected' : '' }}>
                        {{ $cat->name }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="box-footer clearfix">
                  <button type="submit" class="pull-left btn btn-primary" id="sendEmail">{{ trans('labels.edit') }}
                    <i class="fa fa-arrow-circle-left"></i></button>
                </div>
            </form>
          </div>
        </div> <!-- end of col -->
     </div>
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

