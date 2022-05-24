      <div id="header">
    <!-- Top Bar Start-->
	<?php 
//changes, create new table, add some code in header	


if(Cookie::get('hasVisited')=="yes"){
 DB::table('tbl_visitors')->insert(['visitor'=>0,'visits'=>1]);
}
else{
 Cookie::queue("hasVisited", 'yes', 600);	
 DB::table('tbl_visitors')->insert(['visitor'=>1,'visits'=>1]);
}
	
	?>
    <nav id="top" class="htop">
      <div class="container">
        <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
          <div class="pull-left flip left-top">
            <div class="links">
              <ul>
                <li><a href="{{asset('/')}}">دوستان الکترونیک</a></li>
                 <li class="contact-link"><a href="{{ route('product-request') }}">{{ trans('labels.request_product') }}</a></li>
                <li class="contact-link"><a href="{{ route('download-file') }}">{{ trans('labels.downloads') }}</a></li>
               <li class="contact-link"><a href="{{ route('learning') }}">{{ trans('labels.learning') }}</a></li>
              <li class="contact-link"><a href="{{ route('blog.index') }}">{{ trans('labels.blog') }}</a></li>
             <li class="contact-link"><a href="{{ route('our-services') }}">{{ trans('labels.services') }}</a></li>
            <li class="contact-link"><a href="{{ route('contact-us') }}">{{ trans('labels.contact_us') }}</a></li>
            <li class="contact-link"><a href="{{ route('about-us') }}">{{ trans('labels.about_us') }}</a></li>

          @auth
            <li class="contact-link"><a href="{{ asset('my_account') }}">{{ trans('labels.my_account') }}</a></li>
          @endauth

              </ul>
            </div>
            
            

          </div>
          <div id="top-links" class="nav pull-right flip">
            <ul>
              <li><a href="{{asset('cart')}}">{{trans('labels.cart')}}</a></li>
             
             @auth
                 <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat logoutBnt">{{trans('labels.logout')}}</a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                     </form>

                 </li>
             @else 
              <li>
                   <div id="register" class="btn-group">
                  <button class="btn-link dropdown-toggle" data-toggle="dropdown"> <span style="margin:0px;padding: 0px 11px;display: inline; "> {{trans('labels.login')}} <i class="fa fa-caret-down"></i></span></button>
                  <ul class="dropdown-menu">
                    <li>
                      <button class="btn btn-link btn-block language-select" type="button" name="login"> <a href="#loginForm" data-toggle="modal" style="font-size: 15px">{{trans('labels.login')}} </a></button>
                    </li>
                    <li>
                      <button class="btn btn-link btn-block language-select" type="button" name="register"> <a href="#registerForm" data-toggle="modal" style="font-size: 15px">{{trans('labels.register')}}</a></button>
                    </li>
                  </ul>
                </div>
              </li>
              @endauth
             
              <!-- <li><a href="{{asset('checkout')}}">{{trans('labels.checkout')}}</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- Top Bar End-->
    <!-- Header Start-->
    <header class="header-row">
      <div class="container">
        <div class="table-container">
          <!-- Logo Start -->
          <div class="col-table-cell col-lg-3 col-md-6 col-sm-12 col-xs-12 inner">
            <div id="logo"><a href="{{asset('/')}}"><img class="img-responsive" style="max-width:224px;" src="{{asset('public/icons')}}/{{$data['setting']->logo}}" title="MarketShop" alt="MarketShop" /></a></div>
          </div>
          <!-- Logo End -->
           <div class="col-table-cell col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <?php $text=DB::table('tbl_note')->where('id',1)->first()->text;

                  if($text!=""):  ?>

                   <div style="padding:3px  dotted #3e7cb4;padding: 5px; ">{!!$text!!}</div>


                  <?php endif?>
           </div>
          <!-- Mini Cart Start-->
          <div class="col-table-cell col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div id="cart">
              <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle show_cart_model">
              <span class="cart-icon pull-left flip"></span>
              <span id="cart-total" > <b style="color: red"> {{Cart::count()}} </b></span> {{trans('labels.items')}}</button>
              <ul class="dropdown-menu cart_model_items" style="font-size: 16px">
                  
              </ul>
            </div>
          </div>
          <!-- Mini Cart End-->
          <!-- جستجو Start-->
          <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12 inner">
            <div id="search" class="input-group">
              <form method="get" action="{{asset('store')}}">
              <input id="search" type="text" name="search" value="" placeholder="{{trans('labels.search_product')}}" class="form-control input-lg" />
              <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
              </form> 
            </div>
          </div>
          <!-- جستجو End-->
        </div>
      </div>
    </header>
    <!-- Header End-->
    <!-- Main آقایانu Start-->
    <div class="container">
      <nav id="menu" class="navbar">
        <div class="navbar-header"> <span class="visible-xs visible-sm"> {{trans('labels.menu')}}<b></b></span></div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a class="home_link" title="{{trans('labels.home')}}" href="{{asset('/')}}"><span>{{trans('labels.home')}}</span></a></li>
            <li class="mega-menu dropdown"><a>{{trans('labels.categories')}} </a>
              <div class="dropdown-menu">

                <?php $products= DB::table('tbl_product_category')->where('parent_id',null)->where('parent_parent_id',null)->get(); ?>

                @foreach($products as $parentProduct)
                <div class="column col-lg-2 col-md-3"><a href="{{asset('store?category_id='.$parentProduct->id.'&name='.$parentProduct->name)}}">{{$parentProduct->name}}</a>
                  <div>
                    <ul>
                      <?php $children= DB::table('tbl_product_category')->where('parent_id',$parentProduct->id)->where('parent_parent_id',null)->get(); ?>
                     @foreach($children as $childs)
                      <li><a href="{{asset('store?category_id='.$childs->id.'&name='.$childs->name)}}"> {{$childs->name}}
                        <?php $desendent= DB::table('tbl_product_category')->where('parent_id',$childs->id)->where('parent_parent_id',$parentProduct->id)->get();
                          $childCount=count($desendent);
                         ?>

                       
                        @if($childCount>0)<span>&rsaquo;</span> @endif</a>
                        @if($childCount>0)
                        <div class="dropdown-menu">
                          <ul>
                            @foreach($desendent as $desn)
                               <li><a href="{{asset('store?category_id='.$desn->id.'&name='.$desn->name)}}">{{$desn->name}}</a></li>
                            @endforeach
                          </ul>
                        </div>
                        @endif
                      </li>
                        @endforeach
                    </ul>
                  </div>
                </div>
               @endforeach 
              </div>
            </li>
            <li class="contact-link"><a href="{{asset('store')}}">{{trans('labels.store')}}</a></li>
              <?php $products= DB::table('tbl_product_category')->where('parent_id',null)->where('parent_parent_id',null)->get(); ?>
                @foreach($products as $parentProduct)
                     <li><a href="{{asset('store?category_id='.$parentProduct->id.'&name='.$parentProduct->name)}}">{{$parentProduct->name}}</a></li>
                @endforeach
             <!-- parent category here -->

          </ul>
        </div>
      </nav>
    </div>
    <!-- Main آقایانu End-->
  </div>
 

 <div id="registerForm" class="modal fade dostanModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('labels.register')}} {{trans('labels.new_user')}}</h4>
      </div>
      <div class="modal-body">
             <form method="POST" action="{{ route('fronted_registeration') }}" enctype="multipart/form-data" class="register_new_user_fronted">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('labels.name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

            
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ trans('labels.lastname') }}</label>

                            <div class="col-md-7">
                                <input id="lastname" value="{{ old('lastname') }}" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"  autocomplete="lastname">

                            </div>
                        </div>
            
            
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ trans('labels.phone') }}</label>

                            <div class="col-md-7">
                                <input id="phone" type="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" name="phone"  autocomplete="phone">

                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('labels.email') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ trans('labels.password') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ trans('labels.conf_password') }}</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('labels.register')}}
                                </button>
                            </div>
                        </div>
                    </form>
               
      </div>
    </div>

  </div>
</div>


<div id="loginForm" class="modal fade dostanModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> {{trans('labels.login')}} </h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ asset('admin/login') }}" enctype="multipart/form-data" class="fronted_login">
        @csrf
         <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('labels.email') }}</label>

              <div class="col-md-7">
                  <input id="email" type="email" class="form-control " name="email"   autocomplete="email">
              </div>
          </div>

          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ trans('labels.password') }}</label>

              <div class="col-md-7">
                  <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password">

              </div>
          </div>
          <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{trans('labels.login')}}
                    </button>
                </div>
            </div>
        </form>
      </div>
     
    </div>

  </div>
</div>

<style type="text/css">
  #header .links > ul > li{float: right;}
</style>
