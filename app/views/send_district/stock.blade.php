@extends("layout.master")

@section('title')
<h1>
    Inventory
    <small>{{ Auth::user()->district->district }} District Inventory Information </small>
</h1>
@stop
@section('contents')
<ul id="myTab" class="nav nav-tabs" style="margin-left: 15px">
    <li class="active"><a href="#stock" data-toggle="tab">Stock</a></li>
    <li><a href="#receive" data-toggle="tab">Received</a></li>
    <li><a href="#dispatch" data-toggle="tab">Dispatch</a></li>
    <li><a href="#transit" data-toggle="tab">Not Received</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="stock">
        <div class="col-sm-12" >
            @include('send_district.stocklevel')
        </div>
    </div>
    <div class="tab-pane fade" id="receive">
        <div class="col-sm-12" >
            @include('send_district.listreceived')
        </div>
    </div>
    <div class="tab-pane fade" id="dispatch">
        <div class="col-sm-12" >
            @include('send_district.List_sent')
        </div>
    </div>
    <div class="tab-pane fade" id="transit">
        <div class="col-sm-12" >
            @include('send_district.expected')
        </div>
    </div>
</div>

@stop