<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Jalin || Offroad</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('theme/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="{{asset('theme/login/css/latinstatic.css')}}" rel="stylesheet">
    <link href="{{asset('theme/login/css/material.css')}}" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('theme/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('theme/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('theme/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('theme/css/style.css')}}" rel="stylesheet">
</head>

<body class="login-page" style="background-color:#3F51B5">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Jalin || Offroad</a>
            <small>Admin Control Panel</small>
        </div>
        <div class="card">
            <div class="body">
                <form action="{{url('login')}}" method="post">
                    {{ csrf_field() }}
                    <div class="msg">Silahkan lakukan proses login</div>

                    @if(Session::has('failedLogin'))
                      <p class="msg" style="color: red">{{ Session::get('failedLogin') }}</p>
                    @endif
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                              @if($errors->has('email'))
                              <p class="msg" style="color: red">{{ $errors->first('email')}}
                              </p>
                              @endif
                            <input type="text" class="form-control" name="email" placeholder="Email" autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                              @if($errors->has('email'))
                              <p class="msg" style="color: red">{{ $errors->first('password')}}
                              </p>
                              @endif
                            <input type="password" class="form-control" name="password" placeholder="Password" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-orange waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('theme/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('theme/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('theme/plugins/node-waves/waves.js')}}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{asset('theme/plugins/jquery-validation/jquery.validate.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('theme/js/admin.js')}}"></script>
    <script src="{{asset('theme/js/pages/examples/sign-in.js')}}"></script>
</body>

</html>
