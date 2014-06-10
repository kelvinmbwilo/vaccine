@extends("layout.master")

@section('title')
<h1>
    Received Packages
    <small>{{Auth::user()->district->district }} District level </small>
</h1>
@stop
@section('contents')
@if(Arrivaldistrict::all()->count() == 0)
<h3>There are no recieved packages</h3>
@else
<table class="table table-striped table-bordered" id="example2">
    <thead>
    <tr>
        <th> # </th>
        <th>Package Number</th>
<!--        <th>Number Of Packages</th>-->
        <th>Coolant type</th>
        <th>Temperature Monitor</th>
        <th>Labels</th>
        <th>Condition</th>
        <th>Received By</th>

    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(ArrivalDistrict::all() as $us)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $us->ssc }}</td>
<!--        <td>{{ $us->number_of_packages }}</td>-->
        <td>{{ $us->coolant_type }}</td>
        <td>{{ $us->temperature_monitor }}</td>
        <td>{{ $us->labels_available }}</td>
        <td>{{ $us->condition }}</td>
        <td>{{ $us->user->firstname }}</td>

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
@stop