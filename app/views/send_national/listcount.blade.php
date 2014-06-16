<?php $packages = NationalInventory::all() ?>
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
    @foreach($packages as $pack)
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
    @endforeach
</table>