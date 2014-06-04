
<div class="row">
<div class="panel panel-default">
<div class="panel-heading">
    <div class="text-muted bootstrap-admin-box-title">User Roles</div>
</div>
<div class="bootstrap-admin-panel-content">
   @if(ManufacturerBarcode::all()->count() == 0)
    <h3>There are no defined roles</h3>
    @else
    <table class="table table-striped table-bordered" id="example2">
    <thead>
    <tr>
        <th> # </th>
        <th>Manufacturer</th>
        <th>Barcode</th>
        <th>Vaccine / Diluent</th>
        <th>Manufacturer Date</th>
        <th>Expiry Date</th>
        <th>Lot Number</th>
        <th>Quantity</th>
        <th>Number of boxes</th>
        <th>Number of vials</th>


        <th> Action </th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(ManufacturerBarcode::all() as $us)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $us->manufacturer->name }}</td>
        <td>{{ $us->barcode }}</td>
        <td>
            @if($us->vaccine_id != 0){{ $us->vaccine->vaccine_name }}@endif
            @if($us->diluent_id != 0){{ $us->diluent->diluent_name }}@endif
        </td>
        <td>{{ $us->Manufacture_date }}</td>
        <td>{{ $us->expiry_date }}</td>
        <td>{{ $us->lot_number }}</td>
        <td>{{ $us->quantity }}</td>
        <td>{{ $us->boxes }}</td>
        <td>{{ $us->vials }}</td>
        <td id="{{ $us->id }}">
            <a href="#edit" title="edit Role" class="edituser"><i class="fa fa-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
            <a href="#b" title="delete Role" class="deletevaccine"><i class="fa fa-trash-o text-danger"></i> </a>
        </td>
    </tr>
    @endforeach

    </tbody>
    </table>

    @endif
</div>
</div>
</div>


<!--script to process the list of users-->
<script>
    /* Table initialisation */
    $(document).ready(function() {
        $('#example2').dataTable({
            "fnDrawCallback": function( oSettings ) {
                //editing a room
                $(".edituser").click(function(){
                    var id1 = $(this).parent().attr('id');
                    $("#addroles").html("<br><i class='fa fa-spinner fa-spin'></i>loading...");
                    $("#addroles").load("<?php echo url("roles/edit") ?>/"+id1);
                })


                $(".deletevaccine").click(function(){
                    var id1 = $(this).parent().attr('id');
                    $(".deletevaccine").show("slow").parent().parent().find("span").remove();
                    var btn = $(this).parent().parent();
                    $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                    $("#no").click(function(){
                        $(this).parent().parent().find(".deletevaccine").show("slow");
                        $(this).parent().parent().find("span").remove();
                    });
                    $("#yes").click(function(){
                        $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                        $.post("<?php echo url('roles/delete') ?>/"+id1,function(data){
                            btn.hide("slow").next("hr").hide("slow");
                        });
                    });
                });//endof deleting category
            }
        });
        $('#example').dataTable({
            "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            }
        });
        $('input[type="text"]').addClass("form-control");
        $('select').addClass("form-control");

    } );
</script>
