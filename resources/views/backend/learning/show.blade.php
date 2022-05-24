@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
	 <h3 class="box-title">  
        <i class="fa fa-download"></i> {{trans('labels.download')}} 
        <button type="button" class="btn btn-default pull-left">
            <a href="{{ route('downloads.edit',$download->id) }}">
                {{trans('labels.edit')}}
            </a>
        </button>
        <button type="button" class="btn btn-default pull-left">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <a class="text-danger" href="{{ route('downloads.delete',$download->id) }}" 
                 onclick="return confirm('آیا مطین هستید ؟')" >
                {{ method_field('DELETE') }}
                {{trans('labels.delete')}}
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
            				<th>{{ trans('labels.file_name') }}</th>
            				<th>{{ trans('labels.file_price') }}</th>
            				<th>{{ trans('labels.file_size') }}</th>
            				<th>{{ trans('labels.description') }}</th>
            			</tr>
            		</thead>
            		<tbody>
            			<tr>
            				<td>{{ $download->name }}</td>
            				<td>{{ ( $download->price == 'رایگان' ? 'رایگان' : $download->price . ' افغانی '  ) }}</td>
            				<td>{{ number_format($download->size / 1048576,2).'MB' }}</td>
            				<td>{{ $download->description }}</td>
            			</tr>
            		</tbody>
            	</table>

            </div>
	
	</section>	
@endsection

@section('style')
  <style>
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection

