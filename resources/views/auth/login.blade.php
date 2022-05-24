<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ورود | کنترل پنل</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-theme.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/css/rtl.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/css/AdminLTE.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/css/blue.css')}}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
 <div class="login-box">
    <div class="login-logo">
      <a href="{{asset('/')}}"><b>برگشت به سایت</b></a>
    </div>
  
     <div class="login-box-body">
        <p class="login-box-msg">لطفا نام کاربری و رمز عبور خود را وارد کنید</p>
        <form method="POST" action="{{ asset('admin/login') }}">
            @csrf

            <div class="form-group username-form-group">
                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" autofocus placeholder="{{trans('labels.email')}}">
                    <span class="fa fa-envelope form-control-feedback"></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group password-form-group">
              <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off" placeholder="{{trans('labels.password')}}">
                      <span class="fa fa-key form-control-feedback"></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <div class="checkbox icheck">
					   <label class="form-check-label" >
                        <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}  >                                                         
                            {{ trans('labels.remember_me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12 offset-md-2">

                    <div class="login-button-container">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">
                          {{trans('labels.login')}}
						  </button>
                       </div>


                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="display:none">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
      </div>
      
 </div>  


<script src="{{asset('public/backend/js/jquery.min.js')}}" ></script>
<script src="{{asset('public/backend/js/bootstrap.min.js')}}" ></script>
<script src="{{asset('public/backend/js/icheck.min.js')}}" ></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html> 

