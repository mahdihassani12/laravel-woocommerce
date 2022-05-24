@extends('backend.layouts.app')
@section('main_content')
  
    <section class="content-header">
     
     <!-- Tags List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">{{ trans('labels.sliders') }}</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                <h3 class="slider_title">
                    {{ $slider->title }}

                    <div class="tools slider_edit">
                      <a href="{{ route('sliders.edit',$slider->id) }}">
                          {{trans('labels.edit')}}
                      </a>&nbsp;

                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <a class="text-danger" href="{{ route('slider.delete',$slider->id) }}" onclick="return confirm('آیا مطمین هستید ؟')">
                        {{ method_field('delete') }}
                        {{trans('labels.delete')}}
                      </a>

                    </div>
                </h3>
                
                <p class="slider_desc">
                  {{ $slider->description }}
                </p>

                <div class="img_container">
                  <img class="slider_image" src='{{ url("/uploads/sliders/$slider->image") }}'>
                </div>

            </div>

	   </section>
	
@endsection

@section('style')
  <style>

      h3.slider_title{
        background: #f4f4f4;
        padding: 10px;
        border-radius: 5px;
        border-right: 2px solid #e6e7e8;
      }
      h3.slider_title a{
        font-size: 13px;
      }
      p.slider_desc{
        margin-bottom: 30px;
        text-align: right;
        line-height: normal;
      }
      div.img_container{
        text-align: center;
      }
      img.slider_image{
        width: 90%;
        height: auto;
        object-fit: cover;
      }
      div.slider_edit{
        display: inline;
        float: left;
        margin-left: 10px;
      }

  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection