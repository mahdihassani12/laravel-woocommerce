@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header" style="display: none;">
	 <h3 class="box-title">  <i class="ion ion-clipboard"></i> {{trans('labels.categories')}} 
	       <button type="button" class="btn btn-default pull-left" style="display: none;">
              	<a href="{{ route('product_categories.create') }}" >
              		<i class="fa fa-plus"></i> {{ trans('labels.new') }}
              	</a>
              </button>
	  </h3>		  
	</div>
	
    <section class="content">
      <div class="row">
        <div class="col-md-7">
     <!-- Tags List -->
          <div class="box box-primary">
           
             <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">{{ trans('labels.categories') }}</h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
               <ul class="todo-list">
                   @if(count($category) <= 0)
                
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
                @foreach($category as $cat)
                    <li>
                    <!-- drag handle -->
                    <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                        </span>
                    <!-- todo text -->
                    <span class="text">{{ $cat->name }}</span>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <a href="{{ route('product_categories.edit',$cat->id) }}" > 
                        {{trans('labels.edit')}}
                      </a>
                         &nbsp;&nbsp;
                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <a class="text-danger" href="{{ route('product_categories.delete',$cat->id) }}" onclick='return confirm("{{trans('msg.are_you_sure')}}")'>
                        {{ method_field('delete') }}
                        {{trans('labels.delete')}}
                      </a>
                    </div>
                  </li>
                    <ul class="todo-list">
                    <?php $childCategory= DB::table('tbl_product_category')->where('parent_id',$cat->id)->get(); ?>
                    @foreach($childCategory as $childCat)
                        <li>
                           <!-- drag handle --> 
                          &nbsp;&nbsp; <span class="fa fa-arrow-left"></span>
                    
                    <!-- todo text -->
                    <span class="text">{{ $childCat->name }}</span>

                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <a href="{{ route('product_categories.edit',$childCat->id) }}">
                        {{trans('labels.edit')}}
                      </a>  &nbsp;

                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <a class="text-danger" href="{{ route('product_categories.delete',$childCat->id) }}" 
                        onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
                        {{ method_field('DELETE') }}
                        {{trans('labels.delete')}}
                      </a>

                       </div>
                      </li>

                        <ul class="todo-list">
                    <?php $desendCategory= DB::table('tbl_product_category')->where('parent_id',$childCat->id)->get(); ?>
                    @foreach($desendCategory as $desCate)
                        <li>
                           <!-- drag handle --> 
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="fa fa-arrow-left"></span>
                    
                    <!-- todo text -->
                    <span class="text">{{ $desCate->name }}</span>

                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <a href="{{ route('product_categories.edit',$desCate->id) }}">
                        {{trans('labels.edit')}}
                      </a>  &nbsp;

                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <a class="text-danger" href="{{ route('product_categories.delete',$desCate->id) }}" 
                        onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
                        {{ method_field('DELETE') }}
                        {{trans('labels.delete')}}
                      </a>

                       </div>
                      </li>
                      @endforeach
                    </ul>
                      @endforeach
                    </ul>

                @endforeach

                @endif
               </ul>
					
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <div class="pull-left pagination_links">
                    {{ $category->links() }}
                </div>
            </div>
          </div>
          <!-- /.box -->
	      </div>
        <div class="col-md-5">
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
                  <input type="text" class="form-control" name="name" placeholder="{{ trans('labels.category') }}" autocomplete="off" required="required">
                </div>
                 
         <div class="form-group">
            <select name="parent_id" class="select2" style="width: 100%">
             <option value="">{{trans('labels.parent_category')}}</option>
             @foreach($parents as $pr)
               <option value="{{$pr->id}}">{{$pr->name}}</option>
             @endforeach
          </select>
         </div>
         
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-left btn btn-primary" id="sendEmail">{{ trans('labels.save') }}
                    <i class="fa fa-arrow-circle-left"></i></button>
                </div>
                 </form>
              </div>

             
            </div>
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

