<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{session('lang') == 'ar'? settings()->sitename_ar:settings()->sitename_en}}</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="{{url('login')}}/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('login')}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('login')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('login')}}/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('login')}}/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{url('login')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('login')}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('login')}}/css/util.css">
  <link rel="stylesheet" type="text/css" href="{{url('login')}}/css/main.css">
<!--===============================================================================================-->
</head>
<body>
  <!-- <ul class="nav nav-tabs" style="background-color: #00c6fb;">
    <li class="active"><a data-toggle="tab" href="#home" class="btn btn-info">{{trans('admin.desc')}}</a></li>
    <li><a data-toggle="tab" href="#menu1" class="btn btn-info">{{trans('admin.about')}}</a></li>
  </ul>

  <div class="tab-content" style="background-color: #00c6fb;">
    <div id="home" class="tab-pane fade in active">
        
    <center><span style="font-size: 30px;" class="">{{trans('admin.desc')}}</span></center>
        <h4  class="alert alert-info">{{settings()->description}}</h4>
        <br>
    </div>
    <div id="menu1" class="tab-pane fade">
    <center><span style="font-size: 30px;" class="">{{trans('admin.about')}}</span></center>
        <br>
        <span style="font-size: 17px;"  class="alert alert-info">{{settings()->about_us}}</span>
        <br>
        <br>
    </div>
  </div> -->
  <div class="limiter">
    <div class="container-login100" >
      <div class="wrap-login100 p-t-190 p-b-30">
        <form class="login100-form validate-form" action="{{uurl('login')}}" method="POST">
          {!! csrf_field() !!}
          <div class="login100-form-avatar">
            <img src="{{Storage::url(settings()->logo)}}" alt="AVATAR">
          </div>

          <span class="login100-form-title p-t-20 p-b-45">
            <a class="login100-form-title p-t-20 p-b-45" href="{{url('/')}}">{{session('lang') == 'ar'? settings()->sitename_ar:settings()->sitename_en}}</a>
          </span>

          <div class="wrap-input100 validate-input m-b-10" data-validate = "{{trans('admin.email')}} is required">
            <input class="input100" type="email" name="email" placeholder="{{trans('admin.email')}}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input m-b-10" data-validate = "{{trans('admin.pass')}} is required">
            <input class="input100" type="password" name="password" placeholder="{{trans('admin.pass')}}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock"></i>
            </span>
          </div>

          <div class="container-login100-form-btn p-t-10">
            <button class="login100-form-btn" type="submit">
              {{trans('admin.login')}}
            </button>
          </div>

          <div class="text-center w-full p-t-25 p-b-230">
            <a href="{{uurl('forgot/password')}}" class="txt1">
              {{trans('admin.forgot_password')}}?
            </a>
          </div>

          <div class="text-center w-full">
            <a class="txt1" href="{{url('user/signup')}}">
              {{trans('admin.sign_up')}}
              <i class="fa fa-long-arrow-right"></i>            
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  

  
<!--===============================================================================================-->  
  <script src="{{url('login')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="{{url('login')}}/vendor/bootstrap/js/popper.js"></script>
  <script src="{{url('login')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="{{url('login')}}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="{{url('login')}}/js/main.js"></script>

</body>
</html>