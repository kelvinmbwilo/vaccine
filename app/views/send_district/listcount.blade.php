<?php $pack = DistrictInventory::where('district_id',Auth::user()->district_id)->where('reporting_period',date('M Y'))->orderBy('updated_at',"DESC")->first() ?>
<h3 class="lead">Stock count on {{ date('M Y') }}</h3>
<button class="btn btn-info btn-sm pull-right" id="listall">All count for {{ date('M Y') }}</button></h3>
<table class="table table-responsive table-bordered" id="alllist">
    <tr>
        <th>GTIN</th>
        <th>Manufacturer</th>
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
<script>
    $(document).ready(function(){
        $("#listall").click(function(){
            $("#listuser").html("<h4><i class='fa fa-spin fa-spinner'></i><span>please wait...</span><h4>");
            $("#listuser").load("<?php echo url("district_package/inventory/list1") ?>")
        })
    })
</script>