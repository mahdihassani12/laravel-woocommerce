@extends('backend.layouts.app')
@section('main_content')
  
  <div class="content-header" style="margin-bottom: 20px;">
	     <form method="get" action="{{asset('orders/views')}}">
       <div class="row">
          <div class="col-md-3" >
             <input type="text" class="form-control jmdatepicker"  placeholder=" از  تاریخ  "  name="from_date" autocomplete="off" >
          </div>
          <div class="col-md-3" >
             <input type="text" class="form-control jmdatepicker"  placeholder=" الی  تاریخ  "  name="to_date" autocomplete="off"  >
          </div>
          <div class="col-md-2">
             <button type="submit" class="btn btn-primary">جستجو</button>
          </div>
          @if(isset($data['from_date']))
          <div class="col-md-4">
            <div class="date_result">
              نتیجه  جستجو  از      
             <span> @if(isset($data['from_date'])) {{$data['from_date']}} @endif</span>

              الی

             <span> @if(isset($data['to_date'])) {{$data['to_date']}} @endif</span>
          </div>
         </div> 
         @endif
       </div>
      </form>    	  
	</div>
	<div style="padding:0px 15px;">
	   <a class="btn label label-primary" @if(!isset($data['status'])) disabled @endif href="{{asset('orders/views')}}">{{trans('labels.all')}}</a>
	   <a class="btn label label-warning" @if(isset($data['status']) and $data['status']==1) disabled @endif href="{{asset('orders/views?status=1')}}">{{trans('labels.waiting')}}</a>
	   <a class="btn label label-info" @if(isset($data['status']) and $data['status']==2) disabled @endif href="{{asset('orders/views?status=2')}}">{{trans('labels.moved')}}</a>
	   <a class="btn label label-success" @if(isset($data['status']) and $data['status']==3) disabled @endif href="{{asset('orders/views?status=3')}}" style="margin-right: 5px;">{{trans('labels.paid_order')}}</a>
	</div>
    <section class="content">
     <!-- Tags List -->
          <div class="box box-primary">
           
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
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
                    <th style="width: 220px">{{trans('labels.change_status')}}</th>
                    
                  
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($data['orders'] as $ord)
                  <tr>
                    <td style="width: 70px;">{{$ord->bill_no}}</td>
                    <td>{{$ord->name}} {{$ord->last_name}}
                         
                           <p class="row_options">
                              <a target="_blank" href="{{asset('order/success?key='.$ord->order_key.'&mnsh=1')}}" > 
                              {{trans('labels.view')}}
                            </a>

                               &nbsp;&nbsp;
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <a class="text-danger" href="{{ route('order.delete',$ord->id) }}" onclick='return confirm("{{trans('msg.are_you_sure')}}")' >
                              {{ method_field('delete') }}
                              {{trans('labels.delete')}}
                            </a>
                               &nbsp;&nbsp;
                            <a target="_blank" href="{{ asset('public/uploads/bank_bill')}}/{{$ord->bank_bill}}" > 
                              {{trans('labels.view_bill')}}
                            </a>
                           </p>

                    </td>
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
                    <td style="width: 220px">
                      <select class="change_status_dropdown" order_id="{{$ord->bill_no}}" @if($ord->status==3)  disabled @endif>
                                              <option value="1" @if($ord->status==1)  selected @endif>{{trans('labels.waiting')}}</option>
                                              <option value="2" @if($ord->status==2)  selected @endif>{{trans('labels.moved')}}</option>
                                              <option value="3" @if($ord->status==3)  selected @endif>{{trans('labels.paid_order')}}</option>
                                            </select>
                                          </td>
                                        </tr>
                                        @endforeach
                                        
                                        </tbody>
                                      </table>
                                  </div>
                                  <!-- /.box-body -->
                                  <div class="box-footer clearfix no-border">
                                    <div class="pull-left pagination_links">
                                          {{ $data['orders']->appends(request()->input())->links() }}
                                      </div>
                                  </div>
                                </div>
                                <!-- /.box -->
                        
                        </section>
                      @include('backend.includes.message')  "
@endsection

@section('style')
  <style>
       table td, table th{
        width:auto !important; 
       }
       .date_result{
          background: #fff;
          padding: 10px;
          font-size: 15px;
       }
       .date_result span{
        text-align: left;
    background: #e4e4e48c;
    padding: 0px 5px;
    border-radius: 6px;
    margin: 0px 3px;
       }
  </style>
@endsection

@section('script')
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}

   $(document).on("change",".change_status_dropdown",function(){
     var id=$(this).attr("order_id");
     var status=$(this).val();

      $.ajax({
          type:'get',
          url:APP_URL+'/orders/change_status?id='+id+'&status='+status,
          success:function(resource){
                 location.reload();
          }
         })
   })

    $('.jmdatepicker').persianDatepicker({
            // altField: '.jl_datepicker',
            altFormat: 'X',
            format: 'YYYY-M-D',
            observer: true,
            timePicker: { 
                enabled: false
            },
           });
       

</script>
@endsection

