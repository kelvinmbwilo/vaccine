<ul class="sidebar-menu">
    <li class="active">
        <a href="{{url("home")}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="{{ 'package/index' }}">
            <i class="fa fa-cubes"></i>
            <span>Packages</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('package/receive') }}"><i class="fa fa-angle-double-right"></i> Receive Package</a></li>
            <li><a href="{{ url('package/send') }}"><i class="fa fa-angle-double-right"></i> Send Package</a></li>
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
            <i class="fa fa-folder"></i> <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('users') }}"><i class="fa fa-angle-double-right"></i> Users</a></li>
            <li><a href="{{ url('vaccine') }}"><i class="fa fa-angle-double-right"></i> Vaccine</a></li>
            <li><a href="{{url('diluent')}}"><i class="fa fa-angle-double-right"></i> Diluent</a></li>
            <li><a href="{{url('manufacture')}}"><i class="fa fa-angle-double-right"></i> Manufacturer</a></li>
            <li><a href="{{url('manubarcode')}}"><i class="fa fa-angle-double-right"></i> Manufacture Barcodes</a></li>
            </ul>
    </li>
</ul>