
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="text-muted bootstrap-admin-box-title">Received Packages</div>
    </div>
        <div class="bootstrap-admin-panel-content">
            @if(RegionalPackage::where('district_id', Auth::user()->district_id)->where('received_status','received')->count() == 0)
            <h3>There are no Packages</h3>
            @else
            <table class="table table-striped table-bordered" id="example3">
                <thead>
                <tr>
                    <th> # </th>
                    <th>Shipment Number</th>
                    <th>Item</th>
                    <th>Manufacture</th>
                    <th>GTIN</th>
                    <th>Lot Number</th>
                    <th>Expiry</th>
                    <th>Doses</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach(RegionalPackage::where('district_id', Auth::user()->district_id)->where('received_status','received')->get() as $pack)
                @foreach($pack->packages as $us)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $pack->package_number }}</td>
                    <td>{{ $us->vaccine->name }}</td>
                    <td>{{ $us->vaccine->manufacturer }}</td>
                    <td>{{ $us->vaccine->GTIN }}</td>
                    <td>{{ $us->lot_number }}</td>
                    <td>{{ date('j M Y',strtotime($us->manufacturer->expiry_date)) }}</td>
                    <td>{{ $us->number_of_boxes*$us->vaccine->vials_per_box*$us->vaccine->doses_per_vial }}</td>
                </tr>
                @endforeach
                @endforeach

                </tbody>
            </table>

            @endif
        </div>
</div>



<!--script to process the list of users-->
<script>
    /* Table initialisation */
    $(document).ready(function() {
        $('.example3').dataTable({

        });

        $('input[type="text"]').addClass("form-control");
        $('select').addClass("form-control");

    } );
</script>
