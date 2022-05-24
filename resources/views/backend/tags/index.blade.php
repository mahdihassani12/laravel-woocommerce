@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content-header">
      <div class="col-md-7">
     <!-- Tags List -->
          <div class="box box-primary">
            <div class="box-header">
            
              <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.tags')}}
              </h3>

              <button type="button" class="btn btn-default pull-left" style="display: none;">
                <a href="{{ route('tags.create') }}">
                  <i class="fa fa-plus"></i> {{ trans('labels.new') }}
                </a>
              </button>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                
                @if(count($tags) <= 0)
                
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                        </span>
                    <!-- todo text -->
                    <span class="text">{{ trans('labels.no_tag') }}</span>

                  </li>

                @else

                @foreach($tags as $tag)

                	<li>
	                  <!-- drag handle -->
	                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
	                  <!-- todo text -->
	                  <span class="text">{{ $tag->name }}</span>
	                  <!-- General tools such as edit or delete-->
	                  <div class="tools">
	                    <a href="{{ route('tags.edit',$tag->id) }}" style="display: none">
	                    	 {{trans('labels.edit')}}
	                    </a> &nbsp;

                      <meta name="csrf-token" content="{{ csrf_token() }}">
	                    <a class="text-danger" href="{{ route('tag.delete',$tag->id) }}" onclick='return confirm("{{trans('msg.are_you_sure')}}")'>
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
                    {{ $tags->links() }}
                </div>
            </div>
          </div>
          <!-- /.box -->
	     </div>

       <div class="col-md-5">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.add_tag')}}
              </h3>
            </div>
           <div class="box-body">   
            <form action="{{ route('tags.store') }}" method="post">
                @csrf
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="{{ trans('labels.tag') }}" autocomplete="off">
                  </div>

                  <div class="box-footer clearfix">
                    <button type="submit" class="pull-left btn btn-primary" id="sendEmail">{{ trans('labels.save') }}
                      <i class="fa fa-arrow-circle-left"></i></button>
                  </div>
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

