@extends('backend.layouts.app')
@section('main_content')
  
 
	
    <section class="content">
     <!-- Tags List -->
       <div class="row">
         

       <div class="col-md-7">
          <div class="box box-primary">
             <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">{{trans('labels.units')}}</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                
                @if(count($unit) <= 0)
                
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                        </span>
                    <!-- todo text -->
                    <span class="text">{{ trans('labels.no_unit') }}</span>

                  </li>

                @else

                @foreach($unit as $un)

                	<li>
	                  <!-- drag handle -->
	                  <span class="handle">
	                        <i class="fa fa-ellipsis-v"></i>
	                        <i class="fa fa-ellipsis-v"></i>
	                      </span>
	                  <!-- todo text -->
	                  <span class="text">{{ $un->name }}</span>
	                  <!-- General tools such as edit or delete-->
	                  <div class="tools">
	                    <a href="{{ route('units.edit',$un->id) }}" > 
	                    	{{trans('labels.edit')}}
	                    </a>
                         &nbsp;&nbsp;
                      <meta name="csrf-token" content="{{ csrf_token() }}">
	                    <a class="text-danger" href="{{ route('units.delete',$un->id) }}" onclick='return confirm("{{trans('msg.are_you_sure')}}")'>
                        {{ method_field('delete') }}
	                    	{{trans('labels.delete')}}
	                    </a>

	                  </div>
	                </li>

                @endforeach

                @endif

              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <div class="pull-left pagination_links">
                    {{ $unit->links() }}
                </div>
            </div>
          </div>
          <!-- /.box -->
	  </div>
    <div class="col-md-5">
       <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">{{ trans('labels.add_new_unit') }}</h3>

            </div>
            <div class="box-body">
              <form action="{{ route('units.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="{{ trans('labels.unit') }}" autocomplete="off" required="required">
                </div>

                <div class="box-footer clearfix">
                  <button type="submit" class="pull-left btn btn-default" id="sendEmail">{{ trans('labels.save') }}
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
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection

