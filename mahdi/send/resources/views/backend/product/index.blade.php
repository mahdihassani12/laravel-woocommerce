@extends('backend.layouts.app')
@section('main_content')
  
    <div class="content-header">
	 <h3 class="box-title">  <i class="ion ion-clipboard"></i> {{trans('labels.products')}} 
	       <button type="button" class="btn btn-default pull-left">
              	<a href="{{ route('products.create') }}">
              		<i class="fa fa-plus"></i> {{ trans('labels.new') }}
              	</a>
              </button>
	  </h3>		  
	</div>
	
    <section class="content">
     <!-- Tags List -->
          <div class="box box-primary">
           
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <table class="table">
                
				<thead>
            			<tr>
                    <th></th>
            				<th>{{trans('labels.name')}}</th>
            				<th>{{trans('labels.price')}}</th>
                    <th>{{trans('labels.qty')}}</th>
                    <th>{{trans('labels.category')}}</th>
                    <th>{{trans('labels.unit')}}</th>
            			</tr>
            		</thead>
            		<tbody>
					
                @if(count($products) <= 0)
                
                  <tr>
                    
                    <td colspan="6" style="text-align: center;">{{ trans('labels.no_product') }}</td>

                  </tr>
                @else		 
                @foreach($products as $pr)
                	<tr>
	                  <!-- drag handle -->
	                  <!-- todo text -->
	                   <td class="text"><img src="{{asset('uploads/products')}}/{{$pr->feature_image}}" style="width: 60px;">
					             
					         </td> 
                   <td><a href="{{ route('products.edit',$pr->id) }}" >  {{ $pr->name }}</a>
                        <p class="row_options">
                        <a href="{{ route('products.edit',$pr->id) }}" > 
                        {{trans('labels.edit')}}
                      </a>
                         &nbsp;&nbsp;
                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <a class="text-danger" href="{{ route('products.delete',$pr->id) }}" onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
                        {{ method_field('delete') }}
                        {{trans('labels.delete')}}
                      </a>
                     </p>
                   </td> 
                   <td>{{ $pr->price }}</td> 
                   <td>{{ $pr->qty }}</td> 
                   <td>{{ $pr->categoryName }}</td> 
                   <td>{{ $pr->unitName }}</td> 
   
	                </tr>
                @endforeach

                @endif
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <div class="pull-left pagination_links">
                    {{ $products->links() }}
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

