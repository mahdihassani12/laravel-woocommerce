@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content-header">
     
     <!-- Tags List -->
          <div class="box box-primary">
            <div class="box-header">
              
              <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{ trans('labels.sliders') }}
              </h3>

              <button type="button" class="btn btn-default pull-left">
                <a href="{{ route('sliders.create') }}">
                  <i class="fa fa-plus"></i> {{ trans('labels.new') }}
                </a>
              </button>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                
                @if(count($sliders) <= 0)
                
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                        </span>
                    <!-- todo text -->
                    <span class="text">{{ trans('labels.no_slider') }}</span>

                  </li>

                @else

                @foreach($sliders as $slider)

                	<li>
	                  <!-- drag handle -->
	                  <span class="handle">
	                        <i class="fa fa-ellipsis-v"></i>
	                        <i class="fa fa-ellipsis-v"></i>
	                      </span>
	                  <!-- todo text -->
	                  <span class="text">
	              		<a href="{{ route('sliders.edit',$slider->id) }}">{{ $slider->title }}</a>
	              	   </span>
	                  <!-- General tools such as edit or delete-->
	                  <div class="tools">
	                    <a href="{{ route('sliders.edit',$slider->id) }}">
	                    	{{trans('labels.edit')}}
                      </a> &nbsp;

                      <meta name="csrf-token" content="{{ csrf_token() }}">
	                    <a class="text-danger" href="{{ route('slider.delete',$slider->id) }}" onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
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
                    {{ $sliders->links() }}
                </div>

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

