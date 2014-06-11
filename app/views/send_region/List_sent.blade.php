@extends("layout.master")

@section('title')
<h1>
    StocK lavel
    <small>{{ Auth::user()->region->region }} Region Sent Packages </small>
</h1>
@stop
@section('contents')
@if(RegionalPackage::all()->count() == 0)
<h3>There are no packages sent</h3>
@else
<table class="table table-striped table-bordered" id="example2">
    <thead>
    <tr>
        <th>Package Number</th>
        <th>Destination</th>
        <th>Status</th>
        <th>Sent on</th>
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
    @foreach(RegionalPackage::orderBy('created_at','DESC')->get() as $us)
    <tr>
        <td>{{ $us->package_number }}</td>
        <td>{{ $us->district->district }} ({{ $us->number_of_packages }})</td>

        <td>
            @if($us->received_status == 'received')
              Received
            @else
              On Transit
            @endif
        </td>
        <td>{{ date('j M Y',strtotime($us->date_sent)) }}</td>
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