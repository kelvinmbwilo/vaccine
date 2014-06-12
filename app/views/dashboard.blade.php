@extends("layout/master")

@section("title")
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
@stop

@section("breadcumb")
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@stop

@section("contents")
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    150
                </h3>
                <p>
                   Received Packages
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    53<sup style="font-size: 20px">%</sup>
                </h3>
                <p>
                   Sent Packages
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    44
                </h3>
                <p>
                    User Registrations
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    65
                </h3>
                <p>
                    Damaged Packages
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div><!-- /.row -->

<!-- top row -->
<div class="row">
    <div class="col-xs-12 connectedSortable">

    </div><!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
<!-- Left col -->
<section class="col-lg-6 connectedSortable">
    <!-- Box (with bar chart) -->


    <div class="box box-warning">
        <div class="box-header">
            <i class="fa fa-calendar"></i>
            <div class="box-title">Calendar</div>

            <!-- tools box -->
            <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                    <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Add new event</a></li>
                        <li><a href="#">Clear events</a></li>
                        <li class="divider"></li>
                        <li><a href="#">View calendar</a></li>
                    </ul>
                </div>
            </div><!-- /. tools -->
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
            <!--The calendar -->
            <div id="calendar"></div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- quick email widget -->
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-envelope"></i>
            <h3 class="box-title">Quick Email</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div><!-- /. tools -->
        </div>
        <div class="box-body">
            <form action="#" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                </div>
                <div>
                    <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
            </form>
        </div>
        <div class="box-footer clearfix">
            <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
        </div>
    </div>

</section><!-- /.Left col -->
<!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-6 connectedSortable">
<!-- /.box -->

<!-- Chat box -->
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-comments-o"></i> Chat</h3>
        <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
            <div class="btn-group" data-toggle="btn-toggle" >
                <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
            </div>
        </div>
    </div>
    <div class="box-body chat" id="chat-box">
        <!-- chat item -->
        <div class="item">
            <img src="{{ asset('img/avatar.png') }}" alt="user image" class="online"/>
            <p class="message">
                <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                    Mike Doe
                </a>
                I would like to meet you to discuss about the delays in arrivals of vaccines that were sent to your station last mounth
            </p>
            <div class="attachment">
                <h4>Attachments:</h4>
                <p class="filename">
                    Vaccine_arrival_report.pdf
                </p>
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm btn-flat">Open</button>
                </div>
            </div><!-- /.attachment -->
        </div><!-- /.item -->
        <!-- chat item -->
        <div class="item">
            <img src="{{ asset('img/avatar2.png')}}" alt="user image" class="offline"/>
            <p class="message">
                <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                    Jane Doe
                </a>
                Thanks for information i think we can arrange to meet any time from next month because there are many activities as we finish this month
            </p>
        </div><!-- /.item -->
        <!-- chat item -->

    </div><!-- /.chat -->
    <div class="box-footer">
        <div class="input-group">
            <input class="form-control" placeholder="Type message..."/>
            <div class="input-group-btn">
                <button class="btn btn-success"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div><!-- /.box (chat box) -->

<!-- TO DO List -->
<div class="box box-primary">
    <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title">To Do List</h3>
        <div class="box-tools pull-right">
            <ul class="pagination pagination-sm inline">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <ul class="todo-list">
            <li>
                <!-- drag handle -->
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                <!-- checkbox -->
                <input type="checkbox" value="" name=""/>
                <!-- todo text -->
                <span class="text">Receive a Package</span>
                <!-- Emphasis label -->
                <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                <!-- General tools such as edit or delete-->
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>
            <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                <input type="checkbox" value="" name=""/>
                <span class="text">Compile a report to send to national level</span>
                <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>
            <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                <input type="checkbox" value="" name=""/>
                <span class="text">Prepare a package for Kagera region</span>
                <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>

        </ul>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix no-border">
        <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
    </div>
</div><!-- /.box -->

</section><!-- right col -->
</div><!-- /.row (main row) -->

@stop