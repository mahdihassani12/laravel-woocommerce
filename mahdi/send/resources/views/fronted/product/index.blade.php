@extends('fronted.layout.app')
   @section('main_content')
      <div class="container">
      
      <div class="row">
        <!--Left Part Start -->
        <aside id="column-left" class="col-sm-3 hidden-xs">
           @include('fronted.includes.right-sidebar')  
        </aside>
        <!--Left Part End -->
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <h1 class="title"> {{$data['title']}}  @if(isset($data['title2']) and $data['title2']!='') &nbsp;<span class="fa fa-angle-left"></span> &nbsp;{{$data['title2']}} @endif </h1>
          @foreach($data['category'] as $ct)
              <a href="{{asset('store?category_id='.$ct->id.'&name='.$ct->name)}}">{{$ct->name}}</a>
          @endforeach
          <div class="product-filter">
            <div class="row">
              <div class="col-md-4 col-sm-5">
                <div class="btn-group">
                  <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                </div>
                </div>
              <div class="col-sm-2 text-right" style="display: none">
                <label class="control-label" for="input-sort">{{trans('labels.sort_by')}}:</label>
              </div>
              <div class="col-md-3 col-sm-2 text-right" style="display: none">
                <select id="input-sort" class="form-control" name="sort">
                  <option value="" selected="selected">پیشفرض</option>
                  <option value="">نام (الف - ی)</option>
                  <option value="">نام (ی - الف)</option>
                  <option value="">قیمت (کم به زیاد)</option></option>
                  <option value="">قیمت (زیاد به کم)</option>
                </select>
              </div>
              <div class="col-sm-1 text-right" style="display: none">
                <label class="control-label" for="input-limit">نمایش :</label>
              </div>
              <div class="col-sm-2 text-right" style="display: none">
                <select id="input-limit" class="form-control">
                  <option value="" selected="selected">20</option>
                  <option value="">25</option>
                  <option value="">50</option>
                  <option value="">75</option>
                  <option value="">100</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <div class="row products-category">
           @foreach($data['product'] as $product) 
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}"><img src="{{asset('uploads/products')}}/{{$product->feature_image}}" alt="{{$product->name}}" title="{{$product->name}}" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}">{{$product->name}}</a></h4>
                    <p class="description"> {{$product->short_desc}}</p>
                    <p class="price"> <span class="price-new"> {{$product->price}} {{$data['setting']->currency}}</span> <span class="price-old">{{$product->old_price}} {{$data['setting']->currency}}</span> 
                     @if($product->old_price) <span class="saving">{{trans('labels.discount')}}</span> @endif 
                      <span class="price-tax">
                      <table class="table price-tax"> 
                      <tr><th>{{trans('labels.qty')}}</th><th>{{trans('labels.price')}}</th></tr> 
                      <?php  $morePrice= explode(",", $product->more_price);
                        foreach ($morePrice as $mp) {
                          $price=explode(":", $mp)[0];
                          $qty=explode(":", $mp)[1];
                          echo '<tr><td>'.$qty.'</td><td>'.$price.'</td></tr>';
                        }  
                       ?>
                       </table>
                      </span>
                    </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>{{trans('labels.add_to_cart')}}</span></button>
                    
                  </div>
                </div>
              </div>
            </div>
           @endforeach
            <div class="col-xs-12">
                {{$data['product']->appends(request()->input())->links()}} 
            </div>
           </div> 
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
    
   @endsection