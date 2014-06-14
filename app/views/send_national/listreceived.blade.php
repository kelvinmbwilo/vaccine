
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="text-muted bootstrap-admin-box-title">Received Packages</div>
    </div>
        <div class="bootstrap-admin-panel-content">
            @if(ManufacturePackage::whereIn('sscc',array('0'=>'0')+ArrivalNational::all()->lists('ssc'))->count() == 0)
            <h3>There are no Packages</h3>
            @else
            <table class="table table-striped table-bordered" id="example3">
                <thead>
                <tr>
                    <th> # </th>
                    <th>SSCC</th>
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
                @foreach(ManufacturePackage::whereIn('sscc',array('0'=>'0')+ArrivalNational::all()->lists('ssc'))->get() as $pack)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $pack->sscc }}</td>
                    <td>{{ $pack->vaccine->name }}</td>
                    <td>{{ $pack->vaccine->manufacturer }}</td>
                    <td>{{ $pack->vaccine->GTIN }}</td>
                    <td>{{ $pack->lot_number }}</td>
                    <td>{{ date('j M Y',strtotime($pack->expiry_date)) }}</td>
                    <td>{{ $pack->number_of_doses }}</td>
                </tr>
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
