@extends("layout.master")

@section('title')
<h1>
    Inventory
    <small>National Inventory Information </small>
</h1>
@stop
@section('contents')
<ul id="myTab" class="nav nav-tabs" style="margin-left: 15px">
    <li class="active"><a href="#stock" data-toggle="tab">Stock</a></li>
    <li><a href="#receive" data-toggle="tab">Received</a></li>
    <li><a href="#dispatch" data-toggle="tab">Dispatch</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="stock">
        <div class="col-sm-12" >
            @include('send_national.stocklevel')
        </div>
    </div>
    <div class="tab-pane fade" id="receive">
        <div class="col-sm-12" >
            @include('send_national.listreceived')
        </div>
    </div>
    <div class="tab-pane fade" id="dispatch">
        <div class="col-sm-12" >
            @include('send_national.List_sent')
        </div>
    </div>
</div>

@stop