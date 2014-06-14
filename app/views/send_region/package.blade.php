<?php

  $boxes = ($package->number_of_doses / $package->vaccine->doses_per_vial  )/$package->vaccine->vials_per_box;

?>
<div class="col-sm-12" id="add" style="margin-top: 20px">
    <div class="col-sm-1">
        Item<br>
        {{ $package->vaccine->name }}
    </div>
    <div class="col-sm-2">
        Manufacture<br>
        {{ $package->vaccine->manufacturer }}
    </div>
    <div class="col-sm-2">
        GTIN<br>
        {{ $package->vaccine_id }}
    </div>
<!--    displaying warning for products near expiry-->
    @if($expiry_status == "expired")
         <div class="col-sm-2" style="background-color: #aa1111">
             Expired <i class="fa fa-times"></i> <br>
             {{ date('j M Y',strtotime($package->expiry_date)) }}
         </div>
    @elseif($expiry_status == "near expiry")
        <div class="col-sm-2" style="background-color: #aa5500">
            Near Expiry <i class="fa fa-warning"></i><br>
            {{ date('j M Y',strtotime($package->expiry_date)) }}
        </div>
    @else
        <div class="col-sm-2" style="background-color: #008d4c">
            Expiry Date <i class="fa fa-check"></i><br>
            {{ date('j M Y',strtotime($package->expiry_date)) }}
        </div>
    @endif

    <div class="col-sm-2">
        Lot<br>
        {{ $package->lot_number }}
    </div>
    {{ Form::open(array("url"=>url("region_package/addpack"),"class"=>"form-horizontal","id"=>'FileUploader6')) }}
    <div class="col-sm-2">
        <input type="hidden" name="lot" value="{{ $package->lot_number }}" />
        <input type="hidden" name="idd" value="" />
        Boxes:
        <span style="font-size: 0.7em"> ( {{ $package->vaccine->doses_per_vial*$package->vaccine->vials_per_box }} Doses 1 box)</span>
        <br><input title="Number of boxes up to {{ $boxes }} boxes" required="" name="box" pattern="\d*" type="text" class="form-control input-sm" placeholder="Max of {{ $boxes }} boxes">
    </div>
    <div class="col-sm-1">
        <br>
        @if($expiry_status != "expired")
        <input type="submit" value="Add" class="btn btn-success btn-sm">
        @endif
    </div>
    {{ Form::close() }}

<div id="output3"></div>

<script>
    $(document).ready(function(){
        if('<?php echo $idd ?>' == ''){
            $("#FileUploader6 input[name=idd]").val($("#qrform input[name=id]").val())
        }else{
            $("#qrform input[name=id]").val(<?php echo $idd ?>)
            $("#FileUploader6 input[name=idd]").val(<?php echo $idd ?>)
        }

        //showing expired and near expired warings
        if('<?php echo $other_available  ?>' == "available"){
            $("#itemarea").hide();
            $("#warn").remove();
            var warning = "<h4 id='warn'><i class='fa fa-warning fa-2x text-warning'></i> ";
            warning    +="There is other similar item in stock which will expiry sooner. Do you wish to proceed ";
            warning    +="<a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a>";
            warning    +="<a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a></h4>";
            $("#itemarea").after(warning)
            $("#no").click(function(){
                $("#warn").hide('slow');
                $("input[name=sscc]").focus().attr("placeholde","Scan QR Code Again");
            });
            $("#yes").click(function(){
                $("#warn").remove(); $("#itemarea").show('slow');

            });
        }else{
            if('<?php echo $expiry_status  ?>' == "near expiry"){
                $("#itemarea").hide();
                $("#warn").remove();
                var warning = "<h4 id='warn'><i class='fa fa-warning fa-2x text-warning'></i> ";
                warning    +="This Item is near Expiry Date Do you wish to proceed ";
                warning    +="<a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a>";
                warning    +="<a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a></h4>";
                $("#itemarea").after(warning)
                $("#no").click(function(){
                    $("#warn").hide('slow');
                    $("input[name=sscc]").focus().attr("placeholde","Scan QR Code Again");
                });
                $("#yes").click(function(){
                    $("#warn").remove(); $("#itemarea").show('slow');

                });

            }
        }

        $("input[name=box]").focus();
    $('#FileUploader6').on('submit', function(e) {
        e.preventDefault();
        $("#output3").html("<h3><i class='fa fa-spin fa-spinner '></i><span>please wait...</span><h3>");
        $(this).ajaxSubmit({
            target: '#output3',
            success:  afterSuccess
        });
    });
    function afterSuccess(){
        $('#FileUploader').resetForm();
        setTimeout(function() {
            $("#output3").html("");
            $("#itemarea").html("");
        }, 3000);
        $("#listuser").load("<?php echo url("region_package/send/list") ?>/"+$("#qrform input[name=id]").val())
    }
    });
</script>