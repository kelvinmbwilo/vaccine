
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="text-muted bootstrap-admin-box-title">Received Packages</div>
    </div>
    <div class="bootstrap-admin-panel-content">
        @if(ManufacturerBarcode::whereIn('ssc',ArrivalNational::all()->lists('ssc'))->count() == 0)
        <h3>There are no Packages</h3>
        @else
        <table class="table table-striped table-bordered example3" id="example3">
            <thead>
            <tr>
                <th> # </th>
                <th>SSCC</th>
                <th>Manufacture</th>
                <th>Lot Number</th>
                <th>#Packages</th>
                <th>Content</th>
                <th>Type</th>
                <th>Doses</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach(ManufacturerBarcode::whereIn('ssc',ArrivalNational::all()->lists('ssc'))->get() as $pack1)
            @foreach($pack1->packages as $pack)
            @if($pack)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $pack->manufacture->ssc }}</td>
                <td>{{ $pack->manufacture->manufacturer->name }}</td>
                <td>{{ $pack->lot_number }}</td>
                <td>{{ $pack->manufacture->number_of_packages }}</td>
                <td>{{ $pack->content }}</td>
                <td>
                    @if($pack->vaccine_id != 0){{ $pack->vaccine->vaccine_name }}@endif
                    @if($pack->diluent_id != 0){{ $pack->diluent->diluent_name }}@endif
                </td>
                <td>{{ $pack->number_of_doses }}</td>

            </tr>
            @endif
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
