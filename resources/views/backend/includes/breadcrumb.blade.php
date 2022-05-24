<ol class="breadcrumb no-border-radius">
   	<li>
   		@if(isset($data['breadcrumb_level_two']))
   		<a href="{{asset(''.$data['link'].'')}}">{{$data['breadcrumb_level_one']}}</a>
   		@else
   			{{$data['breadcrumb_level_one']}}
   		@endif 
   	</li> 
    @if(isset($data['breadcrumb_level_two']))
    	<li>
        @if($data['user_data']->sys_dir=='ltr')
          <i class="fa fa-angle-right arrow"></i>
        @else
          <i class="fa fa-angle-left arrow"></i>
        @endif
      </li> 
        <li>{{$data['breadcrumb_level_two']}}</li> 
    @endif 
</ol>
        