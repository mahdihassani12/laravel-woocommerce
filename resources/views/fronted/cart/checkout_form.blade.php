 @extends('fronted.layout.app')
   @section('main_content')


 <div id="container">
    <div class="container">
    <form method="post" action="{{asset('checkout/update')}}" enctype="multipart/form-data">
    	@csrf
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">{{trans('labels.checkout')}}</h1>
          <div class="row">
            <div class="col-sm-4">
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-user"></i> {{trans('labels.personal_info')}}</h4>
                </div>
                  <div class="panel-body">
                        <fieldset id="account">
                          <div class="form-group required">
                            <label for="input-payment-firstname" class="control-label">{{trans('labels.name')}}</label>
                            <input type="text" class="form-control" id="input-payment-firstname" placeholder="{{trans('labels.name')}}" value="{{old('firstname')}}" name="firstname" required="required">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-lastname" class="control-label">{{trans('labels.lastname')}}</label>
                            <input type="text" class="form-control" id="input-payment-lastname" placeholder="{{trans('labels.lastname')}}" value="{{old('lastname')}}" name="lastname" required="required">
                          </div>
                          <div class="form-group">
                            <label for="input-payment-email" class="control-label">{{trans('labels.email')}}</label>
                            <input type="text" class="form-control" id="input-payment-email" placeholder="{{trans('labels.email')}}" value="{{old('email')}}" name="email" >
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-telephone" class="control-label">{{trans('labels.contact_number')}}</label>
                            <input type="text" class="form-control" id="input-payment-telephone" placeholder="{{trans('labels.contact_number')}}" value="{{old('telephone')}}" name="telephone" required="required">
                          </div>
                        </fieldset>
                      </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-book"></i> {{trans('labels.address')}}</h4>
                </div>
                  <div class="panel-body">
                        <fieldset id="address" class="required">
                          <div class="form-group">
                            <label for="input-payment-company" class="control-label">{{trans('labels.company')}}</label>
                            <input type="text" class="form-control" id="input-payment-company" placeholder="{{trans('labels.company')}}" value="{{old('company')}}" name="company">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-address-1" class="control-label">{{trans('labels.address')}} 1</label>
                            <input type="text" class="form-control" id="input-payment-address-1" placeholder="{{trans('labels.address')}} 1" value="{{old('address_1')}}" name="address_1" required="required">
                          </div>
                          <div class="form-group">
                            <label for="input-payment-address-2" class="control-label">{{trans('labels.address')}} 2</label>
                            <input type="text" class="form-control" id="input-payment-address-2" placeholder="آدرس 2" value="{{old('address_2')}}" name="address_2">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-city" class="control-label">{{trans('labels.city')}}</label>
                            <input type="text" class="form-control" id="input-payment-city" placeholder="{{trans('labels.city')}}" value="{{old('city')}}" name="city" required="required">
                          </div>
                         
                          
                          
                        </fieldset>
                      </div>
              </div>

               <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-book"></i> {{trans('labels.bank_info')}}</h4>
                </div>
                  <div class="panel-body">
                        <fieldset id="bankinfo" class="required">
                          <div class="form-group">
                            <label for="bank_name" class="control-label">{{trans('labels.bank_name')}}</label>
                            <input type="text" class="form-control" id="bank_name" placeholder="{{trans('labels.bank_name')}}" value="{{old('bank_name')}}" name="bank_name">
                          </div>
                          
                          <div class="form-group required">
                            <label for="bank_bill" class="control-label">{{trans('labels.bank_bill')}} </label>
                            <input type="file" class="form-control" id="bank_bill" name="bank_bill" required="required">
                          </div>
                        
                          
                        </fieldset>
                      </div>
              </div>

            </div>
            <div class="col-sm-8">
              <div class="row">
               
                
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-shopping-cart"></i>{{trans('labels.cart')}}</h4>
                    </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
			                    <td class="text-center">{{trans('labels.photo')}}</td>
			                    <td class="text-left">{{trans('labels.product_name')}}</td>
			                    <td class="text-left">{{trans('labels.qty')}}</td>
			                    <td class="text-left">{{trans('labels.price')}}</td>
			                    <td class="text-left">{{trans('labels.total')}}</td>

                              </tr>
                            </thead>
                            <tbody>
                          @if(count($data['cart'])>0 )  	
                           @foreach($data['cart'] as $ct) 	
                             <tr rowid="{{$ct->rowId}}">
			                    <td class="text-center">
			                        <img src="{{asset('public/uploads/products')}}/{{$ct->options['image']}}" alt="{{$ct->name}}" title="{{$ct->name}}" style="width: 120px" class="img-thumbnail" />
			                    </td>
			                    <td class="text-left">
			                         {{$ct->name}}
			                    </td>
			                    <td class="text-left"><div class="input-group btn-block quantity">
			                        <input type="hidden" name="rowid[]" value="{{$ct->rowId}}">
			                        <input type="number" name="quantity[]" value="{{$ct->qty}}" size="1" readonly="readonly" class="form-control" />
			                    </td>
			                    <td class="text-right">{{$ct->price}}  {{$data['setting']->currency}}</td>
			                    <td class="text-right">{{$ct->price*$ct->qty}} {{$data['setting']->currency}}</td>
			                  
			                   </tr>
                             @endforeach 
                              @else
		                     <tr><td colspan="5" style="font-size: 19px;color: red;">{{trans('labels.empty_cart')}}</td></tr>
		                    @endif
                            </tbody>
                            <tfoot>
                              <tr>
				                  <td class="text-right" colspan="2"><strong>{{trans('labels.grad_total')}}:</strong></td>
				                  <td class="text-right" colspan="3">{{Cart::subtotal()}} {{$data['setting']->currency}}</td>
				                </tr>
				                <tr>
				                  <td class="text-right" colspan="2"><strong>{{trans('labels.discount')}}:</strong></td>
				                  <td class="text-right" colspan="3">0 {{$data['setting']->currency}}</td>
				                </tr>
				                <tr>
				                  <td class="text-right" colspan="2"><strong>{{trans('labels.payable')}}:</strong></td>
				                  <td class="text-right" colspan="3">{{Cart::subtotal()}} {{$data['setting']->currency}}</td>
				                </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-pencil"></i>{{trans('labels.add_note')}}</h4>
                    </div>
                      <div class="panel-body">
                        <textarea rows="4" class="form-control" id="confirm_comment" name="comments">{{old('comments')}}</textarea>
                        <br>
                        
                        <div class="buttons">
                          <div class="pull-right">
                            <input type="submit" class="btn btn-primary" id="button-confirm" value="{{trans('labels.order_submit')}}">
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </form>  
    </div>
  </div>


   @endsection