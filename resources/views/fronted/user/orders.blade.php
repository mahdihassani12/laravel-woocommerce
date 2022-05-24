@extends('fronted.layout.app')
   @section('main_content')
    <div class="container">
	  <div class="row"> 
	    <div class="col-md-2 user_profile_sidebar" style="min-height: ">
		   <ul> 
		     <li><a href="{{asset('my_account')}}"><span class="fa fa-user"> </span>{{trans('labels.profile')}}</a></li>
		     <li><a href="{{asset('my_account/orders')}}"><span class="fa fa-truck"> </span>{{trans('labels.orders')}}</a></li>
		   </ul>
		</div>
	    <div class="col-md-10">
            <div>
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
                    <td>{{$ord->name}} {{$ord->last_name}}
                         
                           <p class="row_options">
                              <a target="_blank" href="{{ asset('order/success?key='.$ord->order_key.'&mnsh=1')}}" > 
                              {{trans('labels.view')}}
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
                  </tr>
                  @endforeach
                 </tbody>
                 </table>
	    	 </div>
            <div>
                {{ $data['orders']->appends(request()->input())->links() }}
            </div>  
		</div>
	  </div>
	</div>


<style>
	   .user_profile_sidebar{
	     	background: #f3f3f3;
	    	min-height: 330px;
	   }	
	  .user_profile_sidebar ul{list-style:none;padding:0px;}
	  .user_profile_sidebar ul li{
	  	padding:10px;
	  }
	  .user_profile_sidebar ul li span{margin-left: 5px;}
	</style>


	@endsection
	
