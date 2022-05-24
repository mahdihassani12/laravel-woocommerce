@extends('backend.layouts.app')
 @section('main_content')


 <div class="content-header">
   <h3 class="box-title">  <i class="ion ion-clipboard"></i> {{trans('labels.users')}} 
         <button type="button" class="btn btn-default pull-left">
                <a href="{{asset('user/add')}}">
                  <i class="fa fa-plus"></i> {{ trans('labels.add_user') }}
                </a>
              </button>
    </h3>     
  </div>
   <section class="content">
        <div class="box box-primary">
          <div class="box-body table-responsive">
            @include('backend.includes.message')
           
              <table class="table">
              	<thead>
              		<tr>
              			<th>
                          <span class="handle">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                          </span>

                       {{trans('labels.photo')}} </th>
                    <th>{{trans('labels.name')}}</th>
              			<th>{{trans('labels.lastname')}}</th>
                    <th>{{trans('labels.phone')}}</th>
              			<th>{{trans('labels.email')}}</th>
              		</tr>
              	</thead>
              	<tbody>
              		 <?php 
                       $counter=1;
              		 ?>
              		@foreach($data['users'] as $us)
              		<tr>
                    @php
                       $photo=$us->photo;
                       if($photo==""){
                       $photo='default.png';
                     }
                    @endphp
                     <td><img width="70px" src="{{asset('public/uploads/users')}}/{{$photo}}"></td>
              			 <td>
                         {{$us->name}}
                      <p class="row_options">  
                     
                      <a href="{{asset('user/edit?user_id=')}}{{$us->id}}" class="text-success"data-hid="{{$us->id}}">
                          <span>{{trans('labels.edit')}}</span>
                      </a> &nbsp;&nbsp;
                  @if($us->role_id!=-1)
                   <meta name="csrf-token" content="{{ csrf_token() }}">
                       <a class="text-danger" href="{{ asset('user/delete?user_id='.$us->id) }}" onclick="return confirm('{{trans("msg.are_you_sure")}}')">
                                {{trans('labels.delete')}}
                               </a> @endif  
                  </p>
                     </td>
                     <td>{{$us->lastname}}</td>
                     <td>{{$us->phone}}</td>
              			 <td>{{$us->email}}</td>
              			 
              		</tr>
              		<?php $counter++;?>
              	   @endforeach 	
              	</tbody>
              </table>
              {{$data['users']->links()}}
        </div>
        </div>
    </section>

  <!-- Modal -->
<div id="dialog_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <h4>{{trans('msg.are_you_sure')}}</h4>
        <form action="{{asset('user/delete')}}">
            <input type="hidden" name="user_id" class="id">
            <button type="submit" class="btn btn-success">{{trans('labels.yes')}}</button>
            <button type="button" class=" btn btn-danger" data-dismiss="modal">{{trans('labels.no')}}</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
 @endsection  


 @section('style')
<style type="text/css">
  
</style>
@endsection

@section('script')
 <script type="text/javascript">
   $(document).on("click",".delete_user",function(){
      $("#dialog_modal input.id").val($(this).attr('userid'));
   })
 </script>
@endsection 