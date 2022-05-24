 <li>
                  <table class="table">
                    <tbody>
                     @if(count($data['cart'])>0) 
                     @foreach($data['cart'] as $cart) 
                      <tr>
                        <td class="text-center"><img class="img-thumbnail" title="{{$cart->name}}" alt="{{$cart->name}}" src="{{asset('public/uploads/products')}}/{{$cart->options['image']}}" style="width: 80px;"></td>
                        <td class="text-left"> {{$cart->name}} </td>
                        <td class="text-right text-primary"><b>{{$cart->qty}}</b></td>
                        <td class="text-right">{{$cart->price}}  {{$data['setting']->currency}}</td>
                        <td class="text-center"></td>
                      </tr>
                   @endforeach 
                   @else
                     <tr><td>{{trans('labels.empty_cart')}}</td></tr>
                   @endif  
                    </tbody>
                  </table>
                </li>
                <li>
                  <div>
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td class="text-right"><strong>{{trans('labels.total')}}  </strong></td>
                          <td class="text-right">{{Cart::subtotal()}} {{$data['setting']->currency}}</td>
                        </tr>
                      </tbody>
                    </table>
                    <p class="checkout"><a href="{{asset('cart')}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> {{trans('labels.show_cart')}}</a>&nbsp;&nbsp;&nbsp;<a href="{{asset('checkout')}}" class="btn btn-primary"><i class="fa fa-share"></i> {{trans('labels.checkout')}}</a></p>
                  </div>
                </li>