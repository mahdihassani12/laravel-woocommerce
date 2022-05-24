@extends('layouts.app')
 @section('content')
<?php 
use \Morilog\Jalali\CalendarUtils;
 ?>
   <div  class="container tab-pane active">
    @include('includes.breadcrumb')
       <div class="tab-container">
       	 <div class="row">
       	 	<div class="col-md-3">
       	 		<img class="img-fluid" src="{{asset('uploads/users')}}/{{$data['user']->photo}}">
       	 		<a href="#dialog_modal" data-toggle="modal" class="update-btn" data-hid="{{$data['user']->id}}">{{trans('labels.edit')}}</a>
       	 	</div>
       	 	<div class="col-md-9">
       	 		<table class="table">
       	 			<tr><th>{{trans('labels.name')}}</th> <td>{{$data['user']->name}}</td></tr>
       	 			<tr><th>{{trans('labels.lastname')}}</th> <td>{{$data['user']->lastname}}</td></tr>
       	 			<tr><th>{{trans('labels.phone')}}</th> <td>{{$data['user']->phone}}</td></tr>
       	 			<tr><th>{{trans('labels.email')}}</th> <td>{{$data['user']->email}}</td></tr>
       	 		</table>
       	 	</div>
       	 </div>
       </div> 
    </div>

 <div id="dialog_modal" class="modal fade custom_modal" role="dialog">
  <div class="modal-dialog modal-md">
        <div class="ajxload load"><div class="ajxloader loader"></div></div>
        <div class="modal-content"></div>
  </div>
</div>
<style type="text/css">
	@media (min-width:800px){
      .wrapper div#content .row-inner .tab-container{
		width: 60%;
		margin: auto;
		float: none;
	   }
	}
	.img-fluid + a{
    width: 100%;
    display: inline-block;
    margin-top: 0px;
    text-align: center;
    padding: 2px;
    background: #39ade6;
    color: #fff;
	}
</style>
 @endsection  

 @section('script')
   <script type="text/javascript">
   	 $(document).on("click",'.update-btn',function(e){
                var user_id = $(this).data('hid');
                var ajx_loader = $(".custom_modal .ajxload");
                var result_content = $(".custom_modal .modal-content");
                ajx_loader.show();
                result_content.hide();
                $.ajax({
                    method:'get',
                    url:''+APP_URL+'/user/edit',
                    data: {user_id:user_id},
                    success:function(response){
                        ajx_loader.hide();
                        result_content.show();
                        result_content.html(response);
                    }
                });
        });

   </script>
 @endsection