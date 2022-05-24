@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
   <h3 class="box-title">  <i class="fa fa-download"></i> {{trans('labels.downloads')}} 
         <button type="button" class="btn btn-default pull-left">
                <a href="{{ route('downloads.create') }}">
                  <i class="fa fa-plus"></i> {{ trans('labels.new') }}
                </a>
            </button>
    </h3>     
  </div>
    <section class="content">
     
      <!-- Posts List -->
          <div class="box box-primary">
            
            <div class="box-body">
             
              <table class="table downloads_table">
                <thead>
                  <tr>
                    <th>
                      <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                          </span>
                      {{ trans('labels.file_name') }}
                    </th>
                    <th>{{ trans('labels.file_size') }}</th>
                    <th>{{ trans('labels.image') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @if( count($downloads) <= 0 )
                    <tr>
                      <td colspan="3">{{trans('labels.no_downloads')}}</td>
                    </tr>
                  @else
                  @foreach($downloads as $download)
                    <tr>
                      <td>
                        {{ $download->name }}

                        <div class="tools row_options">
                              <a href="{{ route('downloads.show',$download->id) }}" style="display: none;">
                                 {{trans('labels.view')}}     
                              </a> &nbsp;
                              <a href="{{ route('downloads.edit',$download->id) }}">
                                {{trans('labels.edit')}}
                              </a> &nbsp;

                              <meta name="csrf-token" content="{{ csrf_token() }}">
                              <a class="text-danger" href="{{ route('downloads.delete',$download->id) }}" 
                                onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
                                {{ method_field('DELETE') }}
                                {{trans('labels.delete')}}
                              </a>

                            </div>

                      </td>
                      <td>{{ number_format($download->size / 1048576,2).'MB' }}</td>
                      
                      <td class="download_image">
                          <img src='{{ asset("public/uploads/files_image/$download->image") }}' style="width: 60px;">
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
                {{ $downloads->links() }}     
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

