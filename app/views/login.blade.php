<!DOCTYPE html>
<html class="bg-cover">
<head>
    <meta charset="UTF-8">
    <title>Vaccine | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    {{HTML::style("css/bootstrap.min.css") }}
    <!-- font Awesome -->
    {{HTML::style("css/font-awesome.min.css") }}
    <!-- Ionicons -->
    {{HTML::style("css/ionicons.min.css") }}
    <!-- Theme style -->
    {{HTML::style("css/AdminLTE.css") }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{HTML::script("js/html5shiv.js")}}
    {{HTML::script("js/respond.min.js")}}
    <![endif]-->
</head>
<!-- Kizito's the body bg-cover was bg-gray before -->
<body class="bg-cover">
<div class="row"><div class="col-md-6 col-md-offset-4 img-responsive text-title text-left" id="title_label" style="padding-left: 50px">Vaccine Tracking Management System</div></div>
<div class="form-box" id="login-box">
    <div class="header-mod">Sign In</div>
    @if(isset($error))
    <div class="alert alert-danger alert-dismissable" style="padding: 5px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ $error }}!</strong>
    </div>
    @endif
    <form method="post" action="{{ url('login') }}">
        <div class="body bg-none"> <!-- Kizito's: it was bg-aqua -->
            <div class="form-group">
                <input type="text" name="email" class="form-control transparent-input" placeholder="User ID" />
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control transparent-input" placeholder="Password"/>
            </div>
            <div class="form-group">
                <input type="checkbox" name="keep" title="Save my login information" value="keep"/> Remember me
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-grey btn-block big-button">Sign me in</button>

            <p><a href="#">-</a></p>

            <a href="register.html" class="text-center">-</a>
        </div>
    </form>

    <div class="margin text-center" style="height: 130px">
        <span></span>
        <br/>
<br />
    </div>
</div>


<!-- jQuery 2.0.2 -->
{{HTML::script("js/jquery.min.js")}}
<!-- Bootstrap -->
{{HTML::script("js/plugins/bootstrap.min.js")}}

</body>
</html>