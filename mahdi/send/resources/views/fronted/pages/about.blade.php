@extends('fronted.layout.app')
   @section('main_content')
   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                @foreach($about as $abt)
                   <h1 class="about_title">{{ $abt->title }}</h1>
                    <div class="about_banner">
                        <img src='{{ asset("uploads/about/$abt->image") }}'>
                    </div>

                    

                    <div class="about_content">
                        {!! $abt->content !!}
                    </div>

                @endforeach

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
 
   @endsection