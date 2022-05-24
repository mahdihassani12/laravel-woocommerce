@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
  	 <h3 class="box-title">
      <i class="ion ion-clipboard"></i> 
      {{trans('labels.services')}} 
  	       <button type="button" class="btn btn-default pull-left">
            	<a href="{{ route('services.create') }}">
            		<i class="fa fa-plus"></i> {{ trans('labels.new') }}
            	</a>
            </button>
  	  </h3>		  
  	</div>
	
    <section class="content">
     
          <div class="box box-primary">
            <div class="box-body">
              <ul class="todo-list">

                @if(count($services) <= 0)

                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <!-- todo text -->
                    <span class="text">{{ trans('labels.no_service') }}</span>
                  </li>

                @else

                @foreach($services as $service)

                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <!-- todo text -->
                    <span class="text">
                    	<a href="{{ route('services.edit',$service->id) }}">
                    		{{ $service->name }}
                    	</a>
                    </span>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <a href="{{ route('services.edit',$service->id) }}">
                        {{trans('labels.edit')}}
                      </a>  &nbsp;

                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <a class="text-danger" href="{{ route('services.delete',$service->id) }}" 
                        onclick='return confirm("{{trans('msg.are_you_sure')}}")'  >
                        {{ method_field('DELETE') }}
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
                    {{ $services->links() }}
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

