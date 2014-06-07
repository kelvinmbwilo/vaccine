
<div class="row">
<div class="panel panel-default">
<div class="panel-heading">
    <div class="text-muted bootstrap-admin-box-title">User Roles</div>
</div>
<div class="bootstrap-admin-panel-content">
   @if(ManufacturerBarcode::all()->count() == 0)
    <h3>There are no Packages</h3>
    @else
    <table class="table table-striped table-bordered" id="example2">
        <thead>
        <tr>
            <th> # </th>
            <th>SSCC</th>
            <th>#Packages</th>
            <th>Content</th>
            <th>Name</th>
            <th>Lot Number</th>
            <th>Doses</th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach(ManufacturePackage::all() as $pack)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $pack->manufacture->ssc }}</td>
            <td>{{ $pack->manufacture->number_of_packages }}</td>
            <td>{{ $pack->content }}</td>
            <td>
                @if($pack->vaccine_id != 0){{ $pack->vaccine->vaccine_name }}@endif
                @if($pack->diluent_id != 0){{ $pack->diluent->diluent_name }}@endif
            </td>
            <td>{{ $pack->lot_number }}</td>
            <td>{{ $pack->number_of_doses }}</td>
            <td id="{{ $pack->id }}">
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
                    $("#adduser").html("<br><i class='fa fa-spinner fa-spin'></i>loading...");
                    $("#adduser").load("<?php echo url("manubarcode/edit") ?>/"+id1);
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
                        $.post("<?php echo url('manubarcode/delete') ?>/"+id1,function(data){
                            btn.hide("slow").next("hr").hide("slow");
                        });
                    });
                });//endof deleting category
            }
        });

        $('input[type="text"]').addClass("form-control");
        $('select').addClass("form-control");

    } );
</script>
