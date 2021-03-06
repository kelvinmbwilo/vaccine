
<div class="panel panel-default">
<div class="panel-heading">
    <div class="text-muted bootstrap-admin-box-title">International shipment
        <button class="btn btn-primary btn-xs pull-right add" id="add"><i class="fa fa-plus"></i> add</button>
    </div>
</div>
<div class="bootstrap-admin-panel-content">
   @if(ManufacturePackage::where('status','')->count() == 0)
    <h3>There are no Packages</h3>
    @else
    <table class="table table-striped table-bordered" id="example2">
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
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach(ManufacturePackage::where('status','')->get() as $pack)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $pack->sscc }}</td>
            <td>{{ $pack->vaccine->name }}</td>
            <td>{{ $pack->vaccine->manufacturer }}</td>
            <td>{{ $pack->vaccine->GTIN }}</td>
            <td>{{ $pack->lot_number }}</td>
            <td>{{ date('j M Y',strtotime($pack->expiry_date)) }}</td>
            <td>{{ $pack->number_of_doses }}</td>
            <td id="{{ $pack->id }}">
                <a href="#b" title="delete Role" class="deletevaccine"><i class="fa fa-trash-o text-danger"></i> </a>
            </td>
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

        $('input[type="text"]').addClass("form-control  pull-right");
        $('select').addClass("form-control");


        //managing the add button
        $(".add").click(function(){
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<h2 class="modal-title" id="myModalLabel">International Shipment</h2>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';

            modal+= ' </div>';
//            modal+= '<div class="modal-footer">';
//            modal+= '   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
//            modal+= '</div>';
            modal+= '</div>';
            modal+= '</div>';

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("manubarcode/add/") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        })
    } );
</script>
