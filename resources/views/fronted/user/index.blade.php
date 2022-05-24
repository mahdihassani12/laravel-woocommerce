@extends('fronted.layout.app')
   @section('main_content')
    <div class="container">
	  <div class="row"> 
	    <div class="col-md-2 user_profile_sidebar" style="min-height: ">
		   <ul> 
		     <li><a href="{{asset('my_account')}}"><span class="fa fa-user"> </span>{{trans('labels.profile')}}</a></li>
		     <li><a href="{{asset('my_account/orders')}}"><span class="fa fa-truck"> </span>{{trans('labels.orders')}}</a></li>
		   </ul>
		</div>
	    <div class="col-md-10">
	    	<div style="padding: 12px">
	    	    <a href="#editUserForm" data-toggle="modal">{{trans('labels.edit')}}</a>
	    	</div>
	    	<div>
	    		<table class="table">
	    			<tr>
	    				<td>{{ trans('labels.name') }}</td><th>{{$data['user']->name}}</th>
	    			</tr>
	    			<tr>	
	    				<td>{{ trans('labels.lastname') }}</td><th>{{$data['user']->lastname}}</th>
	    			</tr>
	    			<tr>	
	    				<td>{{ trans('labels.phone') }}</td><th>{{$data['user']->phone}}</th>
	    			</tr>
	    			<tr>	
	    				<td>{{ trans('labels.email') }}</td><th>{{$data['user']->email}}</th>
	    			</tr>
	    		</table>
	    	</div>
	    	  
		</div>
	  </div>
	</div>

<div id="editUserForm" class="modal fade dostanModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('labels.edit')}} {{trans('labels.profile')}}</h4>
      </div>
      <div class="modal-body">
             <form method="POST" action="{{ asset('my_account/save') }}" enctype="multipart/form-data" class="update_user_form">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('labels.name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control" name="name" value="{{$data['user']->name}}" required autocomplete="name" autofocus>
                                <input  type="hidden"  name="user_id" value="{{$data['user']->id}}">
                            </div>
                        </div>

            
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ trans('labels.lastname') }}</label>

                            <div class="col-md-7">
                                <input id="lastname" value="{{$data['user']->lastname}}" type="text" class="form-control" name="lastname"  autocomplete="lastname">

                            </div>
                        </div>
            
            
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ trans('labels.phone') }}</label>

                            <div class="col-md-7">
                                <input id="phone" type="phone" value="{{$data['user']->phone}}" class="form-control " name="phone"  autocomplete="phone">

                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('labels.email') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{$data['user']->email}}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ trans('labels.password') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ trans('labels.conf_password') }}</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('labels.save')}}
                                </button>
                            </div>
                        </div>
                    </form>
               
      </div>
    </div>

  </div>
</div>
<style>
	   .user_profile_sidebar{
	     	background: #f3f3f3;
	    	min-height: 330px;
	   }	
	  .user_profile_sidebar ul{list-style:none;padding:0px;}
	  .user_profile_sidebar ul li{
	  	padding:10px;
	  }
	  .user_profile_sidebar ul li span{margin-left: 5px;}
	</style>


	@endsection
	
	
@section('script')
 <script type="text/javascript">
 	
    $(".update_user_form").validate({
            rules: {
                name: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                 lastname: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                phone: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
                 email: {
                        required: true,
                        email: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },
               
                 password_confirmation: {
                        equalTo : "#password",
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                },

              },
          messages:{
              name:{
                        required: '{{trans("labels.required_field")}}',
              },
              lastname:{
                        required: '{{trans("labels.required_field")}}',
              },
              email:{
                        required: '{{trans("labels.required_field")}}',
                        email: '{{trans("labels.invalid_email")}}',
              },
              phone:{
                        required: '{{trans("labels.required_field")}}',
              },
              
               password_confirmation:{
                       
                        equalTo: '{{trans("labels.not_match")}}',
              },
             
             

          },
          submitHandler: function (form) {
                    var ajx_loader = $(".page_loader");
                    //var modal_content = $(".custom_modal .modal-content");
                    var form_data = new FormData($('.update_user_form')[0]);

                    ajx_loader.show();
                    //modal_content.hide();
                        $.ajax({
                            method:'post',
                            url:APP_URL+'/my_account/save',
                            data: form_data,
                            processData: false, 
                            contentType: false,
                            success:function(response){
                                ajx_loader.hide();  
                                setTimeout(function() {location.reload()}, 0);
                            }
                        });
                return false;
            } 
      });
 </script>
@endsection	