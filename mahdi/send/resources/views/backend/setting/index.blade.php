@extends('layouts.app')
 @section('content')
<?php 
use App\Http\Controllers\Controller;
 ?>
   <div  class="container tab-pane active">
    @include('includes.breadcrumb')
        <div class="tab-container">

                @if(Controller::checkPermission($data['role_id'],28)) 
                <div class="box-col">
                    <a href="{{asset('users')}}">
                        <div class="internal">
                        <i class="fas fa-users"></i>
                            <span>{{trans('labels.users')}}</span>
                        </div>
                    </a>
                </div>
                @endif
                
                  @if(Controller::checkPermission($data['role_id'],32)) 
                <div class="box-col">
                    <a href="{{asset('roles')}}">
                        <div class="internal">
                        <i class="fas fa-cube"></i>
                            <span>{{trans('labels.roles')}}</span>
                        </div>
                    </a>
                </div>
               @endif
                
               @if(Controller::checkPermission($data['role_id'],36)) 
                <div class="box-col">
                    <a href="{{asset('settings')}}">
                        <div class="internal">
                            <i class="fas fa-cogs"></i>
                            <span>{{trans('labels.settings')}}</span>
                        </div>
                    </a>
                </div> 
               @endif    
                
        </div>
        
</div><!--dashboard-->
@endsection

@section('style')
<style type="text/css">
    .wrapper div#content .row-inner .tab-container .box-col{
        width: 25%;
    }
</style>
@endsection

@section('script')
<script type="text/javascript">
    
</script>
@endsection

