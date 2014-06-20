@extends("layout.master")

@section('title')
<h1>
    Dispatched Items
    <small>National Dispatch Information </small>
</h1>
@stop
@section('contents')
@if(NationalPackage::where('sender','!=','0')->where('date_sent','!=','')->count() == 0)
<h3>There are no packages sent</h3>
@else
<table class="table table-striped table-bordered example3" id="example2">
    <thead>
    <tr>
        <th>Package Number</th>
        <th>Destination</th>
        <th>Status</th>
        <th>
            Contents
            <div class="col-sm-12">
                <div class="col-sm-1">#</div>
                <div class="col-sm-3">GTIN</div>
                <div class="col-sm-2">Name</div>
                <div class="col-sm-3">Expiry Date</div>
                <div class="col-sm-3">Amount(Boxes)</div>
            </div>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(NationalPackage::where('date_sent','!=','')->orderBy('created_at','DESC')->get() as $us)
    @if($us)
    <tr>
        <td>{{ $us->package_number }}</td>
        <td>{{ $us->region->region }}</td>
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
                <div class="col-sm-3">{{ date("d M Y", strtotime($pack->manufacturer->expiry_date)) }}</div>
                <div class="col-sm-3">{{ $pack->number_of_boxes }}</div>
            </div>
            @endforeach
        </td>
    </tr>
    @endif
    @endforeach

    </tbody>
</table>
<script>
    /* Table initialisation */
    $(document).ready(function() {
        $('#example2').dataTable({

        });

        $('input[type="text"]').addClass("form-control");
        $('select').addClass("form-control");

    } );
</script>
@endif
@stop