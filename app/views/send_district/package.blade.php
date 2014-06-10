<?php
if($package->manufacturer->content == 'vaccine'){
    $boxes = ($package->manufacturer->vaccine->doses_per_vial / $package->number_of_doses )/$package->manufacturer->vaccine->vials_per_box;
}else{

}
?>
<div class="row" id="add">
 <div class="row" style="padding-left: 15px">
     <div class="col-sm-2">
         Type : <br>{{ $package->manufacturer->content }}
     </div>
     <div class="col-sm-2">
         Name :<br>
         @if($package->manufacturer->content == 'vaccine' )
            {{ $package->manufacturer->vaccine->vaccine_name }}
         @else
            {{ $package->manufacturer->diluent->diluent_name }}
         @endif
     </div>
     <div class="col-sm-2">
         Expiry Date:<br> {{ date("d M Y",strtotime($package->manufacturer->expiry_date)) }}
     </div>
     {{ Form::open(array("url"=>url("region_package/addpack"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
     <div class="col-sm-3">
         <input type="hidden" name="lot" value="{{ $package->lot_number }}" />
         <input type="hidden" name="idd" value="" />
         Boxes:<br><input name="box" pattern="\d*" type="text" class="form-control" placeholder="Number of boxes">
     </div>
     <div class="col-sm-3">
         <input type="submit" value="Add" class="btn btn-success btn-sm">
     </div>
     {{ Form::close() }}
 </div>
</div>
<div id="output1"></div>

<script>
    $(document).ready(function(){
        if('<?php echo $idd ?>' == ''){
            $("#FileUploader input[name=idd]").val($("#addsscc input[name=id]").val())
        }else{
            $("#addsscc input[name=id]").val(<?php echo $idd ?>)
            $("#FileUploader input[name=idd]").val(<?php echo $idd ?>)
        }

    $('#FileUploader').on('submit', function(e) {
        e.preventDefault();
        $("#output1").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
        $(this).ajaxSubmit({
            target: '#output1',
            success:  afterSuccess
        });
    });
    function afterSuccess(){
        $('#FileUploader').resetForm();
        setTimeout(function() {
            $("#output").html("");
        }, 3000);
        $("#listuser").load("<?php echo url("region_package/send/list") ?>/"+$("#addsscc input[name=id]").val())
    }
    });
</script>