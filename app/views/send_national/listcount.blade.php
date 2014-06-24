<?php $pack = NationalInventory::where('reporting_period',date('M Y'))->orderBy('created_at',"DESC")->first() ?>
<h3 class="lead">Stock count on {{ date('M Y') }}</h3>
<table class="table table-responsive table-bordered" id="alllist">
    <tr>
        <th>GTIN</th>
        <th>Manufacture</th>
        <th>Description</th>
        <th>Lot Number</th>
        <th>Expiry</th>
        <th>Vials</th>
        <th>Boxes</th>
        <th>Reporting Period</th>
    </tr>

    <tr>
        <td>{{ $pack->vaccine->GTIN }}</td>
        <td>{{ $pack->vaccine->manufacturer }}</td>
        <td>{{ $pack->vaccine->name }}</td>
        <td>{{ $pack->lot_number }}</td>
        <td>{{ $pack->manufacturer->expiry_date }}</td>
        <td>{{ $pack->vials}}</td>
        <td>{{ $pack->boxes }}</td>
        <td>{{ $pack->reporting_period }}</td>
        </tr>

</table>