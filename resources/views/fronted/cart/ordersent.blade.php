@extends('fronted.layout.app')
   @section('main_content')

    <div class="container">
      @if(isset($_GET['mnsh']) and $_GET['mnsh']==1)
      
      @else
    	<div class="success_message">
    		 <h1>
			   @if($data['wrong_key']==0)
    		 	{{trans('labels.sent_success')}}  <span class="fa fa-check-circle"></span>
    		   @else
              {{trans('labels.not_valid_id')}}
			   @endif
			 </h1>
    	</div>
      @endif
    <br><br>
	@if($data['wrong_key']==0)
      <div class="row">
        <div class="col-md-6">
        	<img style="max-width: 320px;" src="{{asset('public/icons')}}/{{$data['setting']->logo}}">
        </div>
     </div>
	 
    	<div class="row">
    		 
	    	<div class="company_info col-md-6 col-xs-6">
	    		
	    		 <h1>{{$data['setting']->app_name}}</h1>
	    		 <h3>{{$data['setting']->phone}}</h3>
	    		 <h3>{{$data['setting']->address}}</h3>
	    		 
	    	</div>
	    	<div class="orders_user_info col-md-6 col-xs-6">
    		    <h1>{{$data['order']->name}} - {{$data['order']->last_name}}</h1>
    		    <h3>{{$data['order']->email}} ({{$data['order']->phone}})</h3>
    		    <h3>{{$data['order']->company}}</h3>
    		    <h3>{{$data['order']->address1}} / {{$data['order']->address2}}</h3>
    		    
    		    <h3> {{trans('labels.city')}} : <b>{{$data['order']->city}}</b></h3>
    		    <h3>{{trans('labels.bank_name')}}: <b>{{$data['order']->bank_name}}</b></h3>
				<h3>{{trans('labels.date')}}: <b><?php echo convertDateToJalali(explode(" ",$data['order']->created_at)[0]);?></b></h3>
	    	</div>
    	</div>
    	<div class="order_item_info"><br>
    		 <table class="table table-bordered">
                            <thead>
                              <tr>
			                    <td class="text-left">{{trans('labels.product_name')}}</td>
			                    <td class="text-left">{{trans('labels.qty')}}</td>
			                    <td class="text-left">{{trans('labels.price')}}</td>
			                    <td class="text-left">{{trans('labels.total')}}</td>

                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                //print_r($data['item']);
                               ?>
                            	<?php $total_price=0; ?>
                           @foreach($data['item'] as $ct) 	
                             <tr>
			                  
			                    <td class="text-left">
			                         {{$ct->productName}}
			                    </td>
			                    <td class="text-left"><div class="input-group btn-block quantity">
			                        {{$ct->qty}}
			                        <?php $total_price +=$ct->price*$ct->qty; ?>
			                    </td>
			                    <td class="text-right"> <b>{{$ct->price}}</b>  {{$data['setting']->currency}}</td>
			                    <td class="text-right"><b>{{$ct->price*$ct->qty}}</b> {{$data['setting']->currency}}</td>
			                  
			                   </tr>
                             @endforeach 
                            </tbody>
                            <tfoot>
                              <tr>
				                  <td class="text-right" colspan="2"><strong>{{trans('labels.grad_total')}}:</strong></td>
				                  <td class="text-right" colspan="3"><b>{{$total_price}}</b> {{$data['setting']->currency}}</td>
				                </tr>
				                <tr>
				                  <td class="text-right" colspan="2"><strong>{{trans('labels.discount')}}:</strong></td>
				                  <td class="text-right" colspan="3"> <b>0</b>  {{$data['setting']->currency}}</td>
				                </tr>
				                <tr>
				                  <td class="text-right" colspan="2"><strong>{{trans('labels.payable')}}:</strong></td>
				                  <td class="text-right" colspan="3"> <b >{{$total_price}}</b> {{$data['setting']->currency}}</td>
				                </tr>
                            </tfoot>
                          </table>
    	</div>
    	<button class="btn btn-primary print_btn" onclick="print()">{{trans('labels.print')}}</button>
    </div>
    @endif
   @endsection

   @section('style')
    <style type="text/css">
    	 .success_message h1{
            border: 1px solid #ddd;
		    padding: 15px;
		    text-align: center;
		    border-radius: 6px;
		    color: #848484;
    	 }
    	 .success_message h1 span{
    	 	color: #63e163;
		    font-size: 52px;
		    /*border: 1px solid #dddd;*/
		    border-radius: 50%;
		    padding: 3px;
    	 }
    	 table td, table th{
            vertical-align: middle;
            padding:4px;
    	 }
    	 .company_info h3, .orders_user_info h3{
    	 	margin: 8px 0px; 
    	 	font-size: 16px;
        font-weight: normal;
    	 }
    	 .company_info h1, .orders_user_info h1{
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 15px;
    	 } 

    	 @media print{
           #footer, #header,.success_message,.print_btn{
           	display: none;
           }
    	 }
       tfoot td{
        border-width: 2px !important;
        border-color: #bcbcbc !important;
       }
    </style>
   @endsection


   @section('script')
    <script type="text/javascript">
    	
    </script>
   @endsection