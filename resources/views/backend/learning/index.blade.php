@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
   <h3 class="box-title">  <i class="fa fa-pen"></i> {{trans('labels.learning')}} 
         <button type="button" class="btn btn-default pull-left">
                <a href="{{ route('learnings.create') }}">
                  <i class="fa fa-plus"></i> {{ trans('labels.new') }}
                </a>
            </button>
    </h3>     
  </div>
    <section class="content">
     
      <!-- Posts List -->
          <div class="box box-primary">
            
            <div class="box-body table-responsive">
             
              <table class="table downloads_table">
                <thead>
                  <tr>
                    <th>
                      <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                          </span>
                      {{ trans('labels.title') }}
                    </th>
                    <th style="width: 65%">{{ trans('labels.excerpt') }}</th>
                    <th>{{ trans('labels.image') }}</th>
                    <th>{{ trans('labels.file') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @if( count($learning) <= 0 )
                    <tr>
                      <td colspan="3">{{trans('labels.no_learning')}}</td>
                    </tr>
                  @else
                  @foreach($learning as $lr)
                    <tr>
                      <td>
                        {{ $lr->title }}

                        <div class="tools row_options">
                              <a href="{{ route('learnings.show',$lr->id) }}" style="display: none;">
                                 {{trans('labels.view')}}     
                              </a> &nbsp;
                              <a href="{{ route('learnings.edit',$lr->id) }}">
                                {{trans('labels.edit')}}
                              </a> &nbsp;

                              <meta name="csrf-token" content="{{ csrf_token() }}">
                              <a class="text-danger" href="{{ route('learnings.delete',$lr->id) }}" 
                                onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
                                {{ method_field('DELETE') }}
                                {{trans('labels.delete')}}
                              </a>

                            </div>

                      </td>
                     <td style="width: 65%">{{$lr->excerpt}}</td>
                      <td class="download_image">
                          <img src='{{ asset("public/uploads/learning_images/".$lr->feature_image) }}' style="width: 60px;">
                      </td>
					           <td class="download_image">
                           <a href="{{ asset('public/uploads/learning_files/'.$lr->file) }}" target="_blanked">{{trans('labels.learning_file')}}</a>
                      </td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <div class="pull-left pagination_links">
                {{ $learning->links() }}     
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

