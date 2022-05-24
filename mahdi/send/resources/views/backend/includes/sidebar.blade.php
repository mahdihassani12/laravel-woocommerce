 <?php $user=Auth::user();?>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-right image">
          <img src="{{asset('uploads/users')}}/{{$user->photo}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-right info">
          <p>{{$user->name}} {{$user->lastname}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="جستجو">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         <li @if(isset($data['tab']) and  $data['tab']=="home") class="active" @endif >
          <a href="{{ asset('home') }}">
            <i class="fa fa-th"></i> <span>{{ trans('labels.home') }}</span>
          </a>
        </li>
        

        <li class="@if(isset($data['p_tab']) and  $data['p_tab']=="post") active @endif treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>{{trans('labels.posts')}}</span>
            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if(isset($data['tab']) and  $data['tab']=="post") class="active" @endif><a href="{{ route('posts.index') }}"><i class="fa fa-angle-left"></i> {{trans('labels.posts')}}</a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="add_post") class="active" @endif><a href="{{ route('posts.create') }}"><i class="fa fa-angle-left"></i>{{trans('labels.add_post')}} </a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="category") class="active" @endif><a href="{{ route('categories.index') }}"><i class="fa fa-angle-left"></i>{{trans('labels.categories')}}</a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="tag") class="active" @endif><a href="{{ route('tags.index') }}"><i class="fa fa-angle-left"></i>{{trans('labels.tags')}}</a></li>
          </ul>
        </li>
    
           <li class="treeview @if(isset($data['p_tab']) and  $data['p_tab']=="page") active @endif">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>{{trans('labels.pages')}}</span>
            
             <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if(isset($data['tab']) and  $data['tab']=="aboutus") class="active" @endif><a href="{{ route('about.index') }}"><i class="fa fa-angle-left"></i> {{trans('labels.about_us')}}</a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="contactus") class="active" @endif><a href="{{ route('contact.index') }}"><i class="fa fa-angle-left"></i> {{trans('labels.contact_us')}}</a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="service") class="active" @endif><a href="{{ route('services.index') }}"><i class="fa fa-angle-left"></i> {{trans('labels.services')}}</a></li>
          </ul>
        </li>

          <?php
              $comments = DB::table('tbl_comments')->where('status','0')->get();
          ?>

         <li>
          <a href="{{ route('comments.index') }}">
            <i class="fa fa-comments"></i><span>{{ trans('labels.comments') }}</span>
              <?php $number=0; ?>
              @foreach($comments as $comment)
                @if($comment -> status ==0 )
                  <?php $number++; ?>
                @endif
              @endforeach
              <span class="label label-warning">{{ $number }}</span>
          </a>
        </li>

        <li @if(isset($data['tab']) and  $data['tab']=="slider") class="active" @endif>
          <a href="{{ route('sliders.index') }}" >
            <i class="fa fa-th"></i> <span>{{ trans('labels.sliders') }}</span>
          </a>
        </li>
        
         <li @if(isset($data['tab']) and  $data['tab']=="download") class="active" @endif>
          <a href="{{ route('downloads.index') }}">
            <i class="fa fa-download"></i><span>{{ trans('labels.downloads') }}</span>
          </a>
        </li>
        
		 <li @if(isset($data['tab']) and  $data['tab']=="request") class="active" @endif>
          <a href="{{ route('requests.index') }}">
            <i class="fa fa-address-card"></i> <span>{{ trans('labels.requests') }}</span>
          </a>
        </li>
       
        
		
        <li class="treeview @if(isset($data['p_tab']) and  $data['p_tab']=="product") active @endif">
          <a href="#">
            <i class="fa fa-cube"></i>
            <span>{{trans('labels.products')}}</span>
            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if(isset($data['tab']) and  $data['tab']=="product") class="active" @endif ><a href="{{route('products.index')}}"><i class="fa fa-angle-left"></i>{{trans('labels.products')}}</a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="add_product") class="active" @endif><a href="{{route('products.create')}}"><i class="fa fa-angle-left"></i>{{trans('labels.add_product')}}</a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="pcategory") class="active" @endif><a href="{{route('product_categories.index')}}"><i class="fa fa-angle-left"></i>{{trans('labels.categories')}}</a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="punit") class="active" @endif><a href="{{route('units.index')}}"><i class="fa fa-angle-left"></i>{{trans('labels.units')}}</a></li>
          </ul>
        </li>
      
        <li class="treeview @if(isset($data['p_tab']) and  $data['p_tab']=="user") active @endif">
          <a href="#">
            <i class="fa fa-user"></i> <span>{{trans('labels.users')}}</span>
            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if(isset($data['tab']) and  $data['tab']=="user") class="active" @endif><a href="{{asset('users')}}"><i class="fa fa-angle-left"></i> {{trans('labels.users')}}</a></li>
            <li @if(isset($data['tab']) and  $data['tab']=="add_user") class="active" @endif><a href="{{asset('user/add')}}"><i class="fa fa-angle-left"></i> {{trans('labels.add_user')}}</a></li>
          </ul>
        </li>
       
       
        
         <li @if(isset($data['tab']) and  $data['tab']=="setting") class="active" @endif>
          <a href="{{asset('settings')}}">
            <i class="fa fa-th"></i> <span>{{trans('labels.settings')}}</span>
            <span class="pull-left-container">
            </span>
          </a>
        </li>

         </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

 