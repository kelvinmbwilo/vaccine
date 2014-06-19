
<table class="table table-responsive table-bordered">
    <tr>
        <th>GTIN</th>
        <th>Description</th>
        <th>Manufacture</th>
        <th>Lot</th>
        <th>Expiry</th>
        <th>Vials</th>
        <th>Boxes</th>
        <th>Doses</th>
    </tr>
    <tr>
        <td>{{ $arrival->vaccine->GTIN }}</td>
        <td>{{ $arrival->vaccine->name }}</td>
        <td>
            {{ $arrival->vaccine->manufacturer }}
        </td>
        <td>{{ $arrival->lot_number }}</td>
        <td>{{ $arrival->manufacturer->expiry_date }}</td>
        <td>{{ ($arrival->number_of_boxes*$arrival->vaccine->vials_per_box) }}</td>
        <td>{{ $arrival->number_of_boxes }}</td>
        <td>{{ ($arrival->number_of_boxes*$arrival->vaccine->doses_per_vial)*$arrival->vaccine->vials_per_box }}</td>

    </tr>
</table>

{{ Form::open(array("url"=>url("district_package/receive/confirmqr/{$arrival->id}"),"class"=>"form-horizontal","id"=>'confirmpackage')) }}
<div class="col-sm-12">
    <div class='form-group'>
        <div class='col-sm-2'>
            <small> Quantity Okay </small>
            {{ Form::select('quantity',array('Yes'=>'Yes','No'=>'No'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class='col-sm-2'>
            <small> Physical Damage</small><br>
            {{ Form::select('damage',array('Yes'=>'Yes','No'=>'No'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class='col-sm-2'>
            <small> VVM Status</small><br>
            {{ Form::select('vvm',array('I'=>'I (Okay)','II'=>'II (Okay)','III'=>'III (Bad)','IV'=>'IV (Bad)'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
<!--        <div class='col-sm-2'>-->
<!--            <small> Temperature monitors Status</small><br>-->
<!--            {{ Form::select('temp',array('Fine'=>'Fine','Not Fine'=>'Not Fine'),'',array('class'=>'form-control','required'=>'requiered')) }}-->
<!--        </div>-->
        <div class='col-sm-3'>
            <br>
            {{ Form::submit('Confirm',array('class'=>'btn btn-primary form-control','id'=>'submitqr')) }}
        </div>
        <div class='col-sm-3'>
            <br>
            {{ Form::button('Cancel',array('class'=>'btn btn-danger form-control','id'=>'cancel')) }}
        </div>
    </div>
    </div>
    <div class="col-sm-12">
        <div class='form-group'>
            <div class='col-sm-8'>
                Comments and Observations<br>
                <textarea rows="3" placeholder="" name="comments" class="form-control"></textarea>
            </div>
            <div id="output1" style="padding-top: 10px;text-align: center" class="col-sm-4">

            </div>
        </div>
    </div>

    {{ Form::close() }}

    </div>
<script>
    $(document).ready(function (){
        $("#alllist").find("td:contains('<?php echo $arrival->lot_number ?>')").parent().hide("5000");
        $('#confirmpackage').on('submit', function(e) {
            e.preventDefault();
            $("#output1").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Confirming please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output1',
                success:  afterSuccess1
            });

        });

        $("#cancel").click(function(){
            $("#alllist").find("td:contains('<?php echo $arrival->lot_number ?>')").parent().show("5000");
            $(this).parent().parent().parent().parent().parent().fadeOut( "slow", function() {
                $("#submitqr").parent().parent().parent().parent().parent().html("").fadeIn();
            });
            $("input[name=lot]").focus();
        })

        function afterSuccess1(){
            setTimeout(function() {
                $("#submitqr").parent().parent().parent().parent().parent().fadeOut( "slow", function() {
                    $("#submitqr").parent().parent().parent().parent().parent().html("").fadeIn();
                });
                $("input[name=lot]").focus();
            }, 2000);
        }
    });
</script>