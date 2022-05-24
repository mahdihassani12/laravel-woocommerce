 @extends('fronted.layout.app')
   @section('main_content')

  <div id="container">
    <div class="container">
      
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <form method="post" action="{{asset('cart/update')}}" id="updateCartForm">
          <h1 class="title">{{trans('labels.cart')}}</h1>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td class="text-center">{{trans('labels.photo')}}</td>
                    <td class="text-left">{{trans('labels.product_name')}}</td>
                    <td class="text-left">{{trans('labels.qty')}}</td>
                    <td class="text-left">{{trans('labels.price')}}</td>
                    <td class="text-left">{{trans('labels.total')}}</td>
                    <td class="text-left">{{trans('labels.delete')}}</td>
                  </tr>
                </thead>
                <tbody>
                    @if(count($data['cart'])>0)
                    @foreach($data['cart'] as $ct)
                   
                    @csrf
                   <tr rowid="{{$ct->rowId}}">
                    <td class="text-center">
                        <img src="{{asset('public/uploads/products')}}/{{$ct->options['image']}}" alt="{{$ct->name}}" title="{{$ct->name}}" style="width: 120px" class="img-thumbnail" />
                    </td>
                    <td class="text-left">
                         {{$ct->name}}
                    </td>
                    <td class="text-left"><div class="input-group btn-block quantity">
                        <input type="hidden" name="rowid[]" value="{{$ct->rowId}}">
                        <input type="number" name="quantity[]" value="{{$ct->qty}}" size="1" class="form-control" />
                    </td>
                    <td class="text-right">{{$ct->price}}  {{$data['setting']->currency}}</td>
                    <td class="text-right">{{$ct->price*$ct->qty}} {{$data['setting']->currency}}</td>
                    <td><button type="button" class="btn btn-danger remove_cart_item" onClick=""><i class="fa fa-times-circle"></i></button></td>
                   </tr>
                  
                    @endforeach
                    @else

                     <tr><td colspan="6" style="font-size: 19px;color: red;">{{trans('labels.empty_cart')}}</td></tr>
                    @endif
                </tbody>
              </table>
            </div>
          
          
          <div class="row">
            <div class="col-sm-4 col-sm-offset-8">
              <table class="table table-bordered">
                <tr>
                  <td class="text-right"><strong>{{trans('labels.grad_total')}}:</strong></td>
                  <td class="text-right">{{Cart::subtotal()}} {{$data['setting']->currency}}</td>
                </tr>
                <tr>
                  <td class="text-right"><strong>{{trans('labels.discount')}}:</strong></td>
                  <td class="text-right">0 {{$data['setting']->currency}}</td>
                </tr>
                <tr>
                  <td class="text-right"><strong>{{trans('labels.payable')}}:</strong></td>
                  <td class="text-right">{{Cart::subtotal()}} {{$data['setting']->currency}}</td>
                </tr>
               
              </table>
            </div>
          </div>
          <div class="buttons">
            <div class="pull-left"><a href="{{asset('checkout')}}" class="btn btn-default">
                {{trans('labels.purchase_continue')}}
            </a></div>
            <div class="pull-right"><button type="submit" class="btn btn-primary ">{{trans('labels.update')}}</button></div>

          </div>
        </div>
        <!--Middle Part End -->
        </form>
      </div>
    </div>
  </div>
 @endsection


 @section('script')
    <script type="text/javascript">
        $(document).on("click",".remove_cart_item",function(){
            var row=$(this).parents("tr");
            var id=row.attr("rowid");
            
        var loader=$(".page_loader");
         loader.show();
         $.ajax({
          type:'get',
          url:APP_URL+'/cart/remove_from_cart?id='+id,
          success:function(resource){
            if(resource==1){
               row.remove();
            }
             loader.hide();
          }
         })

        })

        $(".updateCartBtn").click(function(){
            $("#updateCartForm").submit();
        })
    </script>
 @endsection