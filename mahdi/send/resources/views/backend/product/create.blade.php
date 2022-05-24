@extends('backend.layouts.app')
@section('main_content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    {{trans('labels.add_product')}}
      </h1>
    </section>

     <section class="content">

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" style="background: #fff; border-radius: 5px; padding:10px;">
          @csrf

            <div class="form-group">
              <label>{{ trans('labels.name') }}</label>
              <input type="text" name="name" placeholder="{{ trans('labels.name') }}" class="form-control" required="required">
            </div>

         <div class="row">
          <div class="col-md-9  margin-bottom-8">
            <div class="form-group">
             <textarea class="form-control summernote" cols="33" name="long_desc" rows="4" required="required"> </textarea>
            </div>
            <div class="form-group">
              <label>{{ trans('labels.short_description') }}</label>
              <textarea class="form-control"  name="short_desc" rows="4" required="required"> </textarea>
            </div>

             <div class="form-group">          
               <label>{{ trans('labels.guide_file') }}</label>
               <input type="file" class="form-control" name="guide_file">
            </div>

              <div class="form-group gallery_section">          
                <label>{{ trans('labels.gallery') }}</label>
                <input type="file" class="form-control" name="gallery[]" multiple="multiple" id="gallery">
             </div>

          </div>
          
          <div class="col-md-3"> 

           <div class="form-group">
             <label for="product_code">{{ trans('labels.product_code') }}</label>
             <input type="number"  class="form-control" name="product_code" id="product_code" required="required">
          </div> 
             
          <div class="form-group">         
            <label>{{ trans('labels.categories') }}</label>
             <select class="select2 " name="category" style="width: 100%;" required="required">
               @foreach($data['category'] as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
               @endforeach
              </select>
          </div>
         
         <div class="form-group">
           <label>{{ trans('labels.unit') }}</label>
           <select class="select2 "  name="unit" style="width: 100%;" required="required">
            @foreach($data['unit'] as $unit)
            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
            @endforeach
           </select>
         </div>
         
         <div class="form-group">
            <label for="qty">{{trans('labels.qty')}}</label>
            <input type="number" name="qty" id="qty" class="form-control" >
         </div>

         <div class="col-md-6" style="padding:0px 3px 10px">
            <label for="price">{{trans('labels.price')}}</label>
            <input type="number" id="price" name="price" class="form-control" required="required">
         </div>

         <div class="col-md-6" style="padding:0px 3px 10px">
            <label for="old_price">{{trans('labels.old_price')}}</label>
            <input type="number" id="old_price" name="old_price" class="form-control">
         </div>

           <div class="more_price_area form-group" style="margin-top: 13px;">
              <div class="more_price_feilds">
                 

              </div>

              <button type="button" class="btn btn-success add_new_value" style="margin-top: 10px;">{{trans('labels.new_value')}} <span class="fa fa-plus"></span> </button>
            </div>

          <div class="form-group">          
            <label>{{ trans('labels.featured_image') }}</label>
            <input type="file" class="form-control" name="featured_image" id="featured_image" required="required">
         </div>
         
        

         <div class="form-group">
            <button type="submit" class=" btn btn-primary " id="sendEmail">{{ trans('labels.save') }}
                    <i class="fa fa-arrow-circle-left"></i></button>
         </div>
       </div>
       </div>
        </form> 
       
      </section>
	@include('backend.includes.message')
@endsection

@section('style')
  <style>
     .gallery_section .krajee-default.file-preview-frame{
        max-width: 20%;
     }
  </style>
@endsection

@section('script')
<script type="text/javascript">
    $(document).on("click",".add_new_value",function(){
      var morefield=` <div class="row sing_price_row" style="margin-top:5px">
          <div class="col-md-5" style='padding:0px 2px'>
             <input type="number" name="mqty[]" class="qty form-control" placeholder="{{trans('labels.qty')}}">
          </div>

          <div class="col-md-5" style='padding:0px 2px'>
             <input type="number" name="mprice[]" class="price form-control"  placeholder="{{trans('labels.price')}}">
          </div>
          <div class="col-md-2" style='padding:0px 2px'>
             <button type="button" class="btn btn-danger delete_price_row" class='padding:3'>&times;</button>
          </div>
        </div> 
      `;


var values=$(".more_price_area .more_price_feilds .row");
if(values.length<3){
  var price=$('.more_price_area .more_price_feilds .row:last input.price').val();
  var qty=$('.more_price_area .more_price_feilds .row:last input.qty').val();
    if(price==""){
       $('.more_price_area .more_price_feilds .row:last input.price').css('border','1px solid red');
    } 
    if(qty==""){
      $('.more_price_area .more_price_feilds .row:last input.qty').css('border','1px solid red');
    } 
    else{
       $(".more_price_area .more_price_feilds").append(morefield);
       $('.more_price_area .more_price_feilds .row input').css('border-color','#d2d6de');
       }
  }
})


    $(document).on("click",".delete_price_row",function(){
      $(this).parents('.sing_price_row').remove();
      
    })

     $("#gallery").fileinput({
        theme: 'fas',
        language: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
        overwriteInitial: false,
        maxFileSize: 1000,
        //maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });

        $("#featured_image").fileinput({
        theme: 'fas',
        language: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
        overwriteInitial: false,
        maxFileSize: 1000,
        //maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });

</script>
@endsection

