<ul class="sidebar-menu">
    <li class="active">
        <a href="{{url("home")}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Packages</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @if(Auth::user()->role_id == 'admin' || Auth::user()->role_id == 'National' || Auth::user()->role_id == 'National IVD' )
            <li><a href="{{ url('package/receive/national') }}"><i class="fa fa-sign-in"></i> Receive <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('package/send/national') }}"><i class="fa fa-send-o"></i> Dispatch <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('package/national/stock') }}"><i class="fa fa-database"></i> Inventory <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('package/national/sent') }}"><i class="fa fa-angle-double-right"></i> Out Packages</a></li>
            @elseif(Auth::user()->role_id == 'Region')
            <li><a href="{{ url('region_package/receive/national') }}"><i class="fa fa-sign-in"></i> Receive <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('region_package/send/national') }}"><i class="fa fa-send-o"></i> Dispatch <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('region_package/national/stock') }}"><i class="fa fa-database"></i> Inventory <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('region_package/national/received') }}"><i class="fa fa-angle-double-right"></i> In Packages</a></li>
            <li><a href="{{ url('region_package/national/sent') }}"><i class="fa fa-angle-double-right"></i> Out Packages</a></li>
            @elseif(Auth::user()->role_id == 'District')
            <li><a href="{{ url('district_package/receive/national') }}"><i class="fa fa-sign-in"></i> Receive <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('district_package/send/national') }}"><i class="fa fa-send-o"></i> Dispatch <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('district_package/national/stock') }}"><i class="fa fa-database"></i> Inventory <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{ url('district_package/national/received') }}"><i class="fa fa-angle-double-right"></i> In Packages</a></li>
            <li><a href="{{ url('district_package/national/sent') }}"><i class="fa fa-angle-double-right"></i> Out Packages</a></li>
            @endif

        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Reports</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-angle-double-right"></i> Morris</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i> Flot</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
        </ul>
    </li>


    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i> <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('users') }}"><span class="glyphicon glyphicon-user"></span> Users <i class="fa fa-angle-double-right pull-right"></i> </a></li>
            <li><a href="{{ url('vaccine') }}"><span class="glyphicon glyphicon-pushpin"></span> Vaccine/Diluent <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="#"> <i class="fa fa-institution"></i> Facility <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{url('manufacture')}}"><span class="glyphicon glyphicon-tower"></span> Manufacturer <i class="fa fa-angle-double-right pull-right"></i></a></li>
            <li><a href="{{url('manubarcode')}}"> <i class="fa fa-cube"></i> International Shipment </a></li>
            </ul>
    </li>
</ul>