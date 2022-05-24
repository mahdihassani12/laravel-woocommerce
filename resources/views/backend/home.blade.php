@extends('backend.layouts.app')
 @section('main_content')
  
   


    
	
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            
            <a href="{{ route('products.index') }}">
              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
            </a>

            <div class="info-box-content">
              <span class="info-box-text">
                <a href="{{ route('products.index') }}">
                  {{ trans('labels.products') }}
                </a>
              </span>
              <span class="info-box-number content_amounts">{{ count($products) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            
            <a href="{{ route('downloads.index') }}">
              <span class="info-box-icon bg-red"><i class="fa fa-download"></i></span>
            </a>

            <div class="info-box-content">
              <span class="info-box-text">
                <a href="{{ route('downloads.index') }}">
                  {{ trans('labels.downloads') }}
                </a>
              </span>
              <span class="info-box-number content_amounts">{{ count($downloads) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            
            <a href="{{ route('posts.index') }}">
              <span class="info-box-icon bg-green"><i class="fa fa-paragraph"></i></span>
            </a>

            <div class="info-box-content">
              <span class="info-box-text">
                <a href="{{ route('posts.index') }}">
                  {{ trans('labels.posts') }}
                </a>
              </span>
              <span class="info-box-number content_amounts">{{ count($posts) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            
            <a href="{{ route('requests.index') }}">
              <span class="info-box-icon bg-yellow"><i class="fa fa-address-card"></i></span>
            </a>

            <div class="info-box-content">
              <span class="info-box-text">
                <a href="{{ route('requests.index') }}">
                  {{ trans('labels.requests') }}
                </a>
              </span>
              <span class="info-box-number content_amounts">{{ count($requests) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-xs-12">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{trans('labels.latest_orders')}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th style="width: 70px;">{{trans('labels.No.')}}</th>
                    <th>{{trans('labels.client_name')}}</th>
                    <th>{{trans('labels.phone')}}</th>
                    <th>{{trans('labels.city')}}</th>
                    <th>{{trans('labels.address')}}</th>
                    <th>{{trans('labels.total_purchase')}}</th>
                    <th>{{trans('labels.status')}}</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($data['orders'] as $ord)
                  <tr>
                    <td style="width: 70px;">{{$ord->bill_no}}</td>
                    <td>{{$ord->name}} {{$ord->last_name}}</td>
                    <td>{{$ord->phone}}</td>
                    <td>{{$ord->city}}</td>
                    <td>{{$ord->address1}}</td>
                    <td>{{$ord->total}}</td>
                    <td>
                       @if($ord->status==1)
                          <span class="label label-warning">{{trans('labels.waiting')}}</span>
                       @elseif($ord->status==2)
                          <span class="label label-info">{{trans('labels.moved')}}</span>
                       @else
                          <span class="label label-success">{{trans('labels.paid_order')}}</span>
                       @endif
                    </td>
                  </tr>
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="{{asset('orders/views')}}" class="btn btn-sm btn-info btn-flat pull-left">
                {{trans('labels.view_all')}}
              </a>
              
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        
      </div>
      <!-- /.row -->
    
	
	    <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-xs-12">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">بازدید ها</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th> </th>
                    <th>بازدیدکننده ها</th>
                    <th>بازدید ها</th>
                  
                   
                  </tr>
                  </thead>
                  <tbody>
            
                  <tr>
                    <td>امروز</td>
                    <td>{{$data['todayVisitors']}}</td>
                    <td>{{$data['todayVisits']}}</td>
                  </tr>
                  <tr>
                   <td>هفته جاری</td>
                    <td>{{$data['weekVisitors']}}</td>
                    <td>{{$data['weekVisits']}}</td>
                  </tr>
                  <tr>
                    <td>ماه جاری</td>
                    <td>{{$data['monthVisitors']}}</td>
                    <td>{{$data['monthVisits']}}</td>
                  </tr>
                  <tr>
                    <td>همه</td>
                    <td>{{$data['allVisitors']}}</td>
                    <td>{{$data['allVisits']}}</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             
              
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        
      </div>
      <!-- /.row -->
	
	
	</section>
    <!-- /.content -->
	
@endsection

@section('style')
  <style>
  </style>
@endsection

@section('script')
<script type="text/javascript">
    
</script>
@endsection

