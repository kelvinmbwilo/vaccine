@extends("layout.master")

@section('title')
<h1>
    Dispatch
    <small>{{ Auth::user()->district->district }} District Dispatch Information </small>
</h1>
@stop
@section('contents')
@if(DistrictPackage::where('sender','!=','0')->count() == 0)
<h3>There are no packages sent</h3>
@else
<table class="table table-striped table-bordered example3" id="example2">
    <thead>
    <tr>
        <th>Shipment Number</th>
        <th>Destination</th>
        <th>Status</th>
        <th>
            Contents
            <div class="col-sm-12">
                <div class="col-sm-1">#</div>
                <div class="col-sm-3">GTIN</div>
                <div class="col-sm-2">Name</div>
                <div class="col-sm-2">Expiry Date</div>
                <div class="col-sm-2">Boxes</div>
                <div class="col-sm-2">Doses</div>
            </div>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(DistrictPackage::orderBy('created_at','DESC')->get() as $us)
    @if($us)
    <tr>
        <td>{{ $us->package_number }}</td>
        <td>{{ $us->getfacility->name }}</td>
        <td>
            @if($us->received_status == 'received')
              Received
            @else
              On Transit
            @endif
        </td>
        <td>
            <?php $i=1; ?>
            @foreach($us->packages as $pack)
            <div class="col-sm-12" style="border-bottom: 1px solid cornflowerblue">
                <div class="col-sm-1">{{ $i++ }}.</div>
                <div class="col-sm-3">{{ $pack->vaccine->GTIN }}</div>
                <div class="col-sm-2">{{ $pack->vaccine->name }}</div>
                <div class="col-sm-2">{{ date("d M Y", strtotime($pack->manufacturer->expiry_date)) }}</div>
                <div class="col-sm-2">{{ $pack->number_of_boxes }}</div>
                <div class="col-sm-2">{{ $pack->number_of_boxes*$pack->vaccine->doses_per_vial*$pack->vaccine->vials_per_box }}</div>
            </div>
            @endforeach
        </td>
    </tr>
    @endif
    @endforeach

    </tbody>
</table>

@endif
@stop