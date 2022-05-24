 @if(Session::has('alert_message'))
    <div class="alert {{ Session::get('alert_class') }} no-border-radius success_msg_div" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p>{{ Session::get('alert_message') }}
        
            <?php $message=Session::get('alert_message'); if(isset($loged_user_id) and $message=="Other Person Already is Log in"){ ?>
                <br>
                <a class='btn' href="{{asset('login/exit_other').'/'.$loged_user_id}}">
                    exit other User<i class='fa fa-sign-out' aria-hidden='true'></i>
                </a>
            <?php } ?>
        
        </p>
    </div>
 @endif

 @if(count($errors)>0)
    <div class="alert  wrongmessages" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>OOPS! </strong> 
            <ul style="margin-top:4px">
                @foreach($errors->all() as $error)
                        <li> {{$error}} </li>
                @endforeach
            </ul>
    </div>
@endif
<!-- <hr> -->