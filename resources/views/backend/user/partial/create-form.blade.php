@extends('backend.layouts.app')
 @section('main_content')




   <section class="content">
        <div class="row">
          <div class="col-xs-12">
              @include('backend.includes.message')

          </div>
      
                
      <form method="POST" action="{{asset('user/create')}}" enctype="multipart/form-data" class="create_form">    
		      <div class="col-md-2"></div>
          <div class="col-md-8 col-xs-12">
            <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.add_user')}}
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            {{csrf_field()}}
                    <div class="row">
                           <div class="col-xs-12  column">
                            <div class="form-group enrole_feilds">
                                <label for="name">{{trans('labels.name')}}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="name"
                                    name="name"
                                    >
                              </div>
                             </div>
                          
                             <div class="col-xs-12  column">
                            <div class="form-group enrole_feilds">
                                <label for="lastname">{{trans('labels.lastname')}}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="lastname"
                                    name="lastname"
                                    >
                              </div>
                             </div>

                          <div class="col-xs-12  column">
                            <div class="form-group">
                                <label for="phone">{{trans('labels.phone')}}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="phone"
                                    name="phone"
                                    >
                              </div>
                             </div>

                          <div class="col-xs-12 column">
                            <div class="form-group ">
                                <label for="email">{{trans('labels.email')}}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="email"
                                    name="email"
                                    >
                              </div>
                             </div>

                           <div class="col-xs-12  column">
                            <div class="form-group ">
                                <label for="password">{{trans('labels.password')}}</label>
                                <input 
                                    type="password" 
                                    class="form-control" 
                                    id="password"
                                    name="password"
                                    >
                              </div>
                             </div>

                             <div class=" col-xs-12  column">
                            <div class="form-group ">
                                <label for="conf_password">{{trans('labels.conf_password')}}</label>
                                <input 
                                    type="password" 
                                    class="form-control" 
                                    id="conf_password"
                                    name="conf_password"
                                    >
                              </div>
                             </div>    

                         
                         
                         <div class=" col-xs-12  column">
                            <div class="form-group ">
                                <label for="photo">{{trans('labels.photo')}}</label>
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    id="featured_image"
                                    name="photo"
                                    style="padding-top: 4px;padding-bottom: 0px;" 
                                    >
                              </div>
                             </div>
        
                    </div>
                
           
                    <button 
                        type="submit" 
                        class="btn btn-primary">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <b>{{trans('labels.save')}}</b>
                    </button>
        </div>
        </div>
      </div>
       </form>
     </div>
 </section>
  @endsection

  @section('script')
  <script type="text/javascript">
     $("#featured_image").fileinput({
        theme: 'fas',
        language: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
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