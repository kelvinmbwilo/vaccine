@extends("layout.master")

@section('title')
<h1>
    StocK lavel
    <small>National Sent Packages </small>
</h1>
@stop
@section('contents')
@if(NationalPackage::where('region_id',Auth::user()->region_id)->count() == 0)
<h3>There are no packages sent</h3>
@else
<table class="table table-striped table-bordered" id="example2">
    <thead>
    <tr>
        <th>Package Number</th>
        <th>Destination</th>
        <th>Status</th>
        <th>
            Contents
            <div class="col-sm-12">
                <div class="col-sm-3">Type</div>
                <div class="col-sm-3">Name</div>
                <div class="col-sm-3">Expiry Date</div>
                <div class="col-sm-3">Amount(Boxes)</div>
            </div>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(NationalPackage::where('region_id',Auth::user()->region_id)->orderBy('created_at','DESC')->get() as $us)
    <tr>
        <td>{{ $us->package_number }}</td>
        <td>{{ $us->region->region }} ({{ $us->number_of_packages }})</td>
        <td>
            @if($us->received_status == 'received')
            Received
            @else
            On Transit
            @endif
        </td>
        <td>
            @foreach($us->packages as $pack)
            <div class="col-sm-12">
                <div class="col-sm-3">{{ $pack->manufacturer->content }}</div>
                <div class="col-sm-3">
                    @if($pack->manufacturer->content == 'vaccine')
                    {{ $pack->manufacturer->vaccine->vaccine_name }}
                    @else
                    {{ $pack->manufacturer->diluent->diluent_name }}
                    @endif
                </div>
                <div class="col-sm-3">{{ date("d M Y", strtotime($pack->manufacturer->expiry_date)) }}</div>
                <div class="col-sm-3">{{ $pack->number_of_boxes }}</div>
            </div>
            @endforeach
        </td>
    </tr>

    @endforeach

    </tbody>
</table>

@endif
</div>
</div>
</div>


@stop