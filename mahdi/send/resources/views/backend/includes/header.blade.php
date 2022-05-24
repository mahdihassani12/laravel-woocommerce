<?php $user=Auth::user();?>
<?php 
$requests = DB::table('tb_product_request')->where('status','1')->limit(5)->get();
?>
<header class="main-header">
    <!-- Logo -->
    <a href="{{asset('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">{{$data['setting']->app_name}}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{$data['setting']->app_name}} </b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown notifications-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <?php $number=0; ?>
              @foreach($requests as $request)
                @if($request->status==1)
                  <?php $number++; ?>
                @endif
              @endforeach
              <span class="label label-warning">{{ $number }}</span>
            </a>

            <ul class="dropdown-menu">
              <?php $number=0; ?>
              @foreach($requests as $request)
                @if($request->status==1)
                  <?php $number++; ?>
                @endif
              @endforeach
              <li class="header">{{ $number }} {{ trans('labels.new_request') }}</li>

              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach($requests as $request)
                    @if($request->status==1)
                      <li>
                        <a href="{{ route('requests.index') }}">
                          <i class="fa fa-users text-aqua"></i>{{ $request->product_name }}</a>
                      </li>
                    @endif
                  @endforeach
                </ul> <!-- request lists -->
              </li> <!-- inner menu -->

              <li class="footer"><a href="{{ route('requests.index') }}">{{ trans('labels.showing_all') }}</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('uploads/users')}}/{{$user->photo}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{$user->name}} {{$user->lastname}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('uploads/users')}}/{{$user->photo}}" class="img-circle" alt="User Image">

                <p>
                  {{$user->name}} {{$user->lastname}}
                  
                </p>
              </li>
              <!-- Menu Body -->
              
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat" style="display: none;">{{trans('labels.profile')}}</a>
                </div>
                <div class="pull-left">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">{{trans('labels.logout')}}</a>
				   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                     </form>
                </div>
				  			
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- right side column. contains the logo and sidebar -->
  