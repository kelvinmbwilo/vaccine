<!DOCTYPE html>
@if(Auth::guest())
{{  Redirect::to("/")  }}
@else
<html>
<head>
    <meta charset="UTF-8">
    <title>Vaccine Tracking System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    {{HTML::style("css/bootstrap.min.css") }}
    <!-- font Awesome -->
    {{HTML::style("font-awesome/css/font-awesome.min.css") }}
    <!-- Ionicons -->
    {{HTML::style("css/ionicons.min.css") }}
    {{HTML::style("css/jvectormap/jquery-jvectormap-1.2.2.css") }}
    <!-- fullCalendar -->
     {{HTML::style("css/fullcalendar/fullcalendar.css") }}
    <!-- Daterange picker -->
    {{HTML::style("css/daterangepicker/daterangepicker-bs3.css") }}
    {{HTML::style("css/timepicker/bootstrap-timepicker.css") }}
    <!-- bootstrap wysihtml5 - text editor -->
    {{HTML::style("css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}
    <!-- Theme style -->
    {{HTML::style("css/AdminLTE.css") }}

    <!--Jquery ui-->
    {{ HTML::style("jqueryui/css/cupertino/jquery-ui.css") }}

    <!--multselect-->
    {{ HTML::style("multiselect/css/ui.multiselect.css") }}
    <!-- jQuery 2.0.2 -->
    {{HTML::script("js/jquery.min.js")}}
     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{HTML::script("js/html5shiv.js")}}
    {{HTML::script("js/respond.min.js")}}
   <![endif]-->
</head>
<body class="skin-blue" style="background-image: url({{ asset('img/body-bg.png')}})">
<!-- header logo: style can be found in header.less -->
<header class="header">
<a href="{{ url('/home') }}" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->

</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<div class="navbar-right">
<ul class="nav navbar-nav">
<!-- Messages: style can be found in dropdown.less-->
<!--<li class="dropdown messages-menu">-->
<!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--        <i class="fa fa-envelope"></i>-->
<!--        <span class="label label-success">4</span>-->
<!--    </a>-->
<!--    <ul class="dropdown-menu">-->
<!--        <li class="header">You have 2 messages</li>-->
<!--        <li>-->
<!--            <!-- inner menu: contains the actual data -->
<!--            <ul class="menu">-->
<!--                <li><!-- start message -->
<!--                    <a href="#">-->
<!--                        <div class="pull-left">-->
<!--                            <img src="{{ asset('img/avatar3.png') }}" class="img-circle" alt="User Image"/>-->
<!--                        </div>-->
<!--                        <h4>-->
<!--                            Support Team-->
<!--                            <small><i class="fa fa-clock-o"></i> 5 mins</small>-->
<!--                        </h4>-->
<!--                        <p>Challenges using this system?</p>-->
<!--                    </a>-->
<!--                </li><!-- end message -->
<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <div class="pull-left">-->
<!--                            <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="user image"/>-->
<!--                        </div>-->
<!--                        <h4>-->
<!--                            System Notification-->
<!--                            <small><i class="fa fa-clock-o"></i> 2 hours</small>-->
<!--                        </h4>-->
<!--                        <p>3 vaccines are close to expiry</p>-->
<!--                    </a>-->
<!--                </li>-->
<!---->
<!---->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="footer"><a href="#">See All Messages</a></li>-->
<!--    </ul>-->
<!--</li>-->
<!-- Notifications: style can be found in dropdown.less -->
<!-- User Account: style can be found in dropdown.less -->
    <li>
        <a href="{{ url('profile')}}">
           <b>Logged in as</b> <i>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</i>
        </a>
    </li>
    <li style="border-left:solid 2px #8FB0BD">
       <a href="{{ url('logout') }}" ><i class="fa fa-power-off text-maroon"></i> Logout</a>
    </li>
<!--<li class="user user-menu">-->
<!--    <a href="{{ url('profile')}}" class="" data-toggle="dropdown">-->
<!--        <i class="glyphicon glyphicon-user"></i>-->
<!--        <span>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}<i class="caret"></i></span>-->
<!--    </a> | <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Logout</a>-->
<!--    <ul class="dropdown-menu">-->
<!--        <!-- User image -->
<!--        <li class="user-header bg-light-blue">-->
<!--            <img src="{{ asset('img/avatar3.png') }}" class="img-circle" alt="User Image" />-->
<!--            <p>-->
<!--                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} --->
<!--                @if(Auth::user()->role_id == 'Region')-->
<!--                {{ Auth::user()->region->region }} {{ Auth::user()->role_id }}-->
<!--                @elseif(Auth::user()->role_id == 'District')-->
<!--                {{ Auth::user()->district->district }} {{ Auth::user()->role_id }}-->
<!--                @endif-->
<!---->
<!--            </p>-->
<!--        </li>--
<!--        <!-- Menu Body -->
<!---->
<!--        <!-- Menu Footer-->
<!--        <li class="user-footer">-->
<!--            <div class="pull-left">-->
<!--                <a href="{{ url('profile')}}" class="btn btn-default btn-flat">Profile</a>-->
<!--            </div>-->
<!--            <div class="pull-right">-->
<!--                <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>-->
<!--            </div>-->
<!--        </li>-->
<!--    </ul>-->
<!--</li>-->
</ul>
</div>
</nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            @include('userpanel')
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            @include("left")
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<!--            page title-->
            @yield("title")

<!--            breadcumbs-->
                @yield("breadcumb")

        </section>

        <!-- Main content -->
        <section class="content" style="background-image: url({{ asset('img/body-bg.png')}})">
                @yield("contents")
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->



<!-- Bootstrap -->
{{HTML::script("js/bootstrap.min.js")}}
<!-- AdminLTE App -->
{{HTML::script("js/AdminLTE/app.js")}}
{{HTML::script("js/AdminLTE/dashboard.js")}}

<!--data tables-->
{{ HTML::script("datatables/jquery.dataTables.js") }}
{{ HTML::script("datatables/dataTables.bootstrap.js") }}

<!--Highchart files-->
{{ HTML::script("Highcharts/js/highcharts.js") }}
{{ HTML::script("Highcharts/js/modules/exporting.js") }}
<!--{{ HTML::script("Highcharts/js/themes/gray.js") }}-->

<!--Jquery ui-->
{{ HTML::script("jqueryui/js/jquery-ui-1.10.4.custom.min.js") }}

<!--Jquery form plugin-->
{{ HTML::script("js/jquery.form.js") }}
{{ HTML::script("js/plugins/fullcalendar/fullcalendar.min.js") }}

<!--Multselect-->
{{ HTML::script("multiselect/js/plugins/localisation/jquery.localisation-min.js") }}
{{ HTML::script("multiselect/js/plugins/scrollTo/jquery.scrollTo-min.js") }}
{{ HTML::script("multiselect/js/ui.multiselect.js") }}

{{ HTML::script("js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js") }}
<!-- jQuery Knob Chart -->
{{ HTML::script("js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js") }}
{{ HTML::script("js/plugins/jqueryKnob/jquery.knob.js") }}
<!-- daterangepicker -->
{{ HTML::script("js/plugins/jqueryKnob/jquery.knob.js") }}
{{ HTML::script("js/plugins/timepicker/bootstrap-timepicker.js") }}
<!-- Bootstrap WYSIHTML5 -->
{{ HTML::script("js/plugins/daterangepicker/daterangepicker.js") }}
{{ HTML::script("js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}
<!-- iCheck -->
{{ HTML::script("js/plugins/iCheck/icheck.min.js") }}


</body>
</html>
@endif
