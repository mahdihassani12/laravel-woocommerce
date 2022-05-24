@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header" style="display: none;">
  	 <h3 class="box-title">
      <i class="ion ion-clipboard"></i> 
      {{trans('labels.categories')}} 
  	       <button type="button" class="btn btn-default pull-left">
            	<a href="{{ route('categories.create') }}">
            		<i class="fa fa-plus"></i> {{ trans('labels.new') }}
            	</a>
            </button>
  	  </h3>		  
  	</div>
	
    <section class="content">
        <div class="col-md-7">
          <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.categories')}}
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">

                @if(count($categories) <= 0)

                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <!-- todo text -->
                    <span class="text">{{ trans('labels.no_category') }}</span>
                  </li>

                @else

                @foreach($categories as $category)

                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <!-- todo text -->
                    <span class="text">{{ $category->name }}</span>

                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <a href="{{ route('categories.edit',$category->id) }}">
                        {{trans('labels.edit')}}
                      </a>  &nbsp;

                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <a class="text-danger" href="{{ route('category.delete',$category->id) }}" 
                        onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
                        {{ method_field('DELETE') }}
                        {{trans('labels.delete')}}
                      </a>

                    </div>
                   
                  </li>
                   <ul class="todo-list">
                    <?php $childCategory= DB::table('tbl_postscategories')->where('parent',$category->id)->get(); ?>
                    @foreach($childCategory as $childCat)
                        <li>
                           <!-- drag handle --> 
                          &nbsp;&nbsp; <b>__</b>
                    
                    <!-- todo text -->
                    <span class="text">{{ $childCat->name }}</span>

                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <a href="{{ route('categories.edit',$childCat->id) }}">
                        {{trans('labels.edit')}}
                      </a>  &nbsp;

                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <a class="text-danger" href="{{ route('category.delete',$childCat->id) }}" 
                        onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
                        {{ method_field('DELETE') }}
                        {{trans('labels.delete')}}
                      </a>

                    </div>
                        </li>
                        @endforeach
                    </ul>
                @endforeach

                @endif

              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
                <div class="pull-left pagination_links">
                    {{ $categories->links() }}
                </div>

            </div>
          </div>
         </div> 
          <!-- /.box -->
	    <div class="col-md-5">
         
         <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.add_category')}}
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
          <form action="{{ route('categories.store') }}" method="post">
          @csrf  
              <div class="form-group">
                <label for="categories">
                  {{ trans('labels.name') }}
                </label>
                <input type="text" class="form-control" name="name" placeholder="{{ trans('labels.name') }}" autocomplete="off" required="required">
              </div>

              <div class="form-group">
                <label for="categories">
                  {{ trans('labels.parent_category') }}
                </label>
                <select class="select2 " style="width: 100%" name="parent" id="categories">
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
        </form>
      </div>
    </div>
      </div>
	</section>
@include('backend.includes.message')	
@endsection

@section('style')
  <style>
   .todo-list > li:last-of-type{
    margin-bottom: 2px;
   }
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection

