<h3 class="lead text-center" style="font-size: 30px">Package Information to  {{ $natpack->getfacility->name }}  <a href="#" class="pull-right" title="Print voucher"><i class="fa fa-print"></i> </a> </h3>
<div class="col-sm-12 lead">
    <div class="col-sm-4">
        <b>Voucher Number</b><br>
        <img src="http://barcode.tec-it.com/barcode.ashx?code=Code128&modulewidth=fit&data=<?php echo $natpack->package_number ?>&dpi=96&imagetype=gif&rotation=0&color=&bgcolor=&fontcolor=&quiet=0&qunit=mm" alt="Barcode generated by TEC-IT"/>

    </div>
    <div class="col-sm-4">
        <b>Name of store</b><br>
        {{ $natpack->getfacility->name }}
    </div>
    <div class="col-sm-4">
        <b>Date</b><br>
        {{ date('j M Y',strtotime($natpack->created_at)) }}
    </div>
</div>
<table class="table table-responsive table-bordered" id="alllist">
    <tr>
        <th>GTIN</th>
        <th>Manufacturer</th>
        <th>Description</th>
        <th>Lot Number</th>
        <th>Expiry</th>
        <th>Amount Issued (Doses)</th>
        <th>Min Stock</th>
        <th>Max Stock</th>
        <th></th>
    </tr>
    @foreach($natpack->packages as $pack)
    <?php
    $max = round(($natpack->getfacility->surviving_infants *$pack->vaccine->wastage *$pack->vaccine->schedule*1.5 )/12 );
    $min = round(($natpack->getfacility->surviving_infants *$pack->vaccine->wastage *$pack->vaccine->schedule*0.5 )/12 );
    $newlevel = ($pack->number_of_boxes * $pack->vaccine->vials_per_box) * $pack->vaccine->doses_per_vial;
    ?>
    @if($max < $newlevel )
    <tr class="danger" title="amaount exceed maximum required stock">
        @elseif( $newlevel < $min   )
    <tr class="danger" title="amount is less than required minimum stock">
        @else
    <tr>
        @endif
        <td>{{ $pack->vaccine->GTIN }}</td>
        <td>{{ $pack->vaccine->manufacturer }}</td>
        <td>{{ $pack->vaccine->name }}</td>
        <td>{{ $pack->lot_number }}</td>
        <td>{{ $pack->manufacturer->expiry_date }}</td>
        <td>{{ ($pack->number_of_boxes * $pack->vaccine->vials_per_box) * $pack->vaccine->doses_per_vial }}</td>
        <td>{{ $min }}</td>
        <td>{{ $max }}</td>
        </tr>
    @endforeach
</table>