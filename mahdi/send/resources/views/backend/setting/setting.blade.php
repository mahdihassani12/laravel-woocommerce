@extends('backend.layouts.app')
 @section('main_content')
   
   <section class="content">
    <div class="row">
        <form method="POST" action="{{asset('setting/update')}}" enctype="multipart/form-data" class="create_form">    
            {{csrf_field()}}
            
            <div class="col-md-2"></div>
            <div class="col-md-8 co-sm-12">
             <div class="row">
              <div class="box box-primary">
               <div class="box-header">
                <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.settings')}}
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12 form-group">
                   <label for="app_name">{{trans('labels.app_name')}}</label>
                   <input type="text" class="form-control " name="app_name" id="app_name" value="@if(isset($data['setting']->app_name)){{$data['setting']->app_name}}@endif">
                </div>
                <div class="col-md-12 form-group">
                    <label for="phone">{{trans('labels.phone')}}</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="@if(isset($data['setting']->phone)){{$data['setting']->phone}}@endif">
                </div>

                   <div class="col-md-12 form-group">
                    <label for="currency">{{trans('labels.currency')}}</label>
                    <input type="text" class="form-control" name="currency" id="currency" value="@if(isset($data['setting']->currency)){{$data['setting']->currency}}@endif">
                </div>

                <div class="col-md-12 form-group">
                    <label for="address">{{trans('labels.address')}}</label>
                    <input type="text" class="form-control jl_date" name="address" id="address" value="@if(isset($data['setting']->address)){{$data['setting']->address}}@endif">
                </div>
                <div class="col-md-12 form-group custom-file">
                     <img style="width: 110px" src="{{asset('icons')}}/{{$data['setting']->logo}}" >

                    <label for="logo">{{trans('labels.logo')}} <span class="text-danger" style="font-size: 11px"> {{trans('labels.leave_empty')}}</span></label>
                    <input type="file" class="form-control custom-file-input" name="logo" id="featured_image" >
                 </div>
                 
                
                
                <div class="col-md-12 form-group " style="margin-top: 10px;">

                    <button type="submit" class="btn btn-primary">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    <b>{{trans('labels.save')}}</b>
                   </button>
                </div>
               </div> 
             </div>
           </div>
         </div>
        </form>
        </div>
    </section>
 @endsection 

 @section('style')
 <style type="text/css">
    .setting_title{
        font-size: 23px;
        margin: 12px;
        border-right: 3px solid #39ade6;
        padding: 8px;
        background: #39ade60d;
    }
 </style>
 @endsection
 
 @section('script')
  <script type="text/javascript">
          $("#featured_image").fileinput({
        theme: 'fas',
        language: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
  </script>
 @endsection