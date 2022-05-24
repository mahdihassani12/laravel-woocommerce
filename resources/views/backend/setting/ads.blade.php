@extends('backend.layouts.app')
 @section('main_content')
   
   <section class="content">
    <div class="row">
        <form method="POST" action="{{asset('ads/update')}}" enctype="multipart/form-data" class="create_form">    
            {{csrf_field()}}
            
        <div class="col-md-2"></div>
       <div class="col-md-8 co-sm-12">
            <div class="box box-primary" style="padding:0px 15px 25px">
               <div class="box-header">
                <h3 class="box-title">
                <i class="ion ion-clipboard"></i> {{trans('labels.ads')}}
              </h3>
            </div>
              
            <div class="form-group">
                 <textarea name="text" class="form-control summernote" rows="4">{{$data['note']->text}}</textarea>
             </div>

              <div class="row">
			     <h3 class="col-xs-12">تبلیغات آخر صفحه اصلی</h3>
			     <div class="col-md-6">
				     <label> اول</label>
					 <input type="text" class="form-control" name="title1" placeholder="{{trans('labels.title')}}" value="{{$data['note']->title1}}">
					 <textarea name="description1" class="form-control" rows="4" placeholder="{{trans('labels.description')}}">{{$data['note']->description1}}</textarea>
				 </div>
				 <div class="col-md-6" >
				     <label> دوم</label>
					 <input type="text" class="form-control" name="title2" placeholder="{{trans('labels.title')}}" value="{{$data['note']->title2}}">
					 <textarea name="description2" class="form-control" rows="4" placeholder="{{trans('labels.description')}}">{{$data['note']->description2}}</textarea>
				 </div>
				 <hr>
			      <div class="col-md-6" style="margin-top:14px;">
				     <label> سوم</label>
					 <input type="text" class="form-control" name="title3" placeholder="{{trans('labels.title')}}" value="{{$data['note']->title3}}">
					 <textarea name="description3" class="form-control" rows="4" placeholder="{{trans('labels.description')}}">{{$data['note']->description3}}</textarea>
				 </div>
				  <div class="col-md-6" style="margin-top:14px;">
				     <label>چهارم </label>
					 <input type="text" class="form-control" name="title4" placeholder="{{trans('labels.title')}}" value="{{$data['note']->title4}}">
					 <textarea name="description4" class="form-control" rows="4" placeholder="{{trans('labels.description')}}">{{$data['note']->description4}}</textarea>
				 </div>
			  </div>
             <div style="margin-top:10px;">
             	<input type="submit" name="" value="{{trans('labels.save')}}" class="btn btn-primary">
             </div>
      </div>
</div>
</form>
</div>
</section>

<style type="text/css">
  .note-popover .popover-content .note-color .dropdown-toggle, .panel-heading.note-toolbar .note-color .dropdown-toggle{
    width: 80px !important; 
  }
</style>
@endsection