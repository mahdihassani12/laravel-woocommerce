   
  
  <!--Footer Start-->
  <footer id="footer">
    <div class="fpart-first">
      <div class="container">
        <div class="row">
          <div class="contact col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <h5>{{trans('labels.contact_info')}}</h5>
            <ul>
              <li class="address"><i class="fa fa-map-marker"></i> {{$data['setting']->address}}</li>
              <li class="mobile"><i class="fa fa-phone"></i>  {{$data['setting']->phone}}</li>
              <li class="email"><i class="fa fa-envelope"></i>{{$data['setting']->email}}</li>
              <li class="email"> {{trans('labels.bank_account_number')}} : &nbsp;&nbsp;  {{$data['setting']->bank_number}}</li>

            </ul>
          </div>
        
         
          <div class="column col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <h5> {{trans('labels.fpages')}} </h5>
            <ul>
               <li><a href="{{asset('')}}">{{trans('labels.home')}}</a></li>
              <li><a href="{{asset('about-us')}}">{{trans('labels.about_us')}}</a></li>
              <li><a href="{{asset('contact-us')}}">{{trans('labels.contact_us')}}</a></li>
              <li><a href="{{asset('our-services')}}">{{trans('labels.services')}}</a></li>
              
           
            </ul>
          </div>
          <div class="column col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <h5> {{trans('labels.fpages')}}</h5>
            <ul>
              <li><a href="{{asset('blog')}}">{{trans('labels.blog')}}</a></li>
              <li><a href="{{asset('download-file')}}">{{trans('labels.download')}}</a></li>
              <li><a href="{{asset('store')}}">{{trans('labels.store')}}</a></li>
            
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 ">
            <h5> {{trans('labels.search')}} </h5>
            <div id="search" class="input-group" style="width: 100%">
              <form method="get" action="{{asset('store')}}">
              <input id="search" type="text" name="search" value="" placeholder="{{trans('labels.search_product')}}" class="form-control input-lg" />
              <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
              </form> 
            </div>
          </div>


        </div>
      </div>
    </div>
    <div class="fpart-second">
      <div class="container">
        <div id="powered" class="clearfix">
          <div class="powered_text pull-left flip">
            © {{date('Y')}} {{trans('labels.copyright')}}


          </div>
          <div class="social pull-right flip"> 
            <a href="{{$data['setting']->facebook}}" target="_blank"> 
              <img data-toggle="tooltip" src="{{asset('public/icons/facebook.png')}}" alt="Facebook" title="Facebook">
            </a> 
            <a href="{{$data['setting']->twitter}}" target="_blank"> <img data-toggle="tooltip" src="{{asset('public/icons/twitter.png')}}" alt="Twitter" title="Twitter"> </a> 
            <a href="{{$data['setting']->youtube}}" target="_blank"> <img data-toggle="tooltip" src="{{asset('public/icons/youtube.png')}}" alt="Youtube" title="Youtube"> </a>

            <a href="{{$data['setting']->telegram}}" target="_blank"> <img data-toggle="tooltip" src="{{asset('public/icons/telegram.png')}}" alt="Telegram" title="Telegram"> </a>

            <a href="tel:{{$data['setting']->imo}}" > <img data-toggle="tooltip" src="{{asset('public/icons/imo.png')}}" alt="Imo" title="Imo"> </a>

            <a href="tel:{{$data['setting']->whatsapp}}" > <img data-toggle="tooltip" src="{{asset('public/icons/whatsapp.png')}}" alt="WhatsApp" title="WhatsApp"> </a>

            <a href="tel:{{$data['setting']->wechat}}" > <img data-toggle="tooltip" src="{{asset('public/icons/wechat.png')}}" alt="WeChat" title="WeChat"> </a>
          
         </div>
        </div>
      </div>
    </div>
    <div id="back-top"><a data-toggle="tooltip" title="بازگشت به بالا" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
  </footer>
  <!--Footer End-->

 