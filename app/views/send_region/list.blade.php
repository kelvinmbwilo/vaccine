@if($natpack)
<div class="col-sm-12 lead">
    <div class="col-sm-4">
        <b>Voucher Number</b><br>
        {{ $natpack->package_number }}
    </div>
    <div class="col-sm-4">
        <b>Name of store</b><br>
        {{ $natpack->district->district }} District
    </div>
    <div class="col-sm-4">
        <b>Date</b><br>
        {{ date('j M Y',strtotime($natpack->created_at)) }}
    </div>
</div>
<table class="table table-responsive table-bordered" id="alllist">
    <tr>
        <th>GTIN</th>
        <th>Manufacture</th>
        <th>Description</th>
        <th>Lot Number</th>
        <th>Expiry</th>
        <th>Amount Issued (Doses)</th>
        <th>Amount Issued (Doses)</th>
        <th>Max Stock</th>
        <th>Current Stock</th>
        <th>New Stock</th>
        <th></th>
    </tr>
    @foreach($natpack->packages as $pack)
    <?php
    $stock = $natpack->district->stock()->where('vaccine_id',$pack->vaccine->GTIN)->get();
    $level=0;
    if($stock){
        foreach($stock as $stoc){
            $level += $stoc->number_of_doses;
        }
    }
    $max = round(($natpack->district->surviving_infants *$pack->vaccine->wastage *$pack->vaccine->schedule*1.5 )/12 );
    $min = round(($natpack->district->surviving_infants *$pack->vaccine->wastage *$pack->vaccine->schedule*0.5 )/12 );
    $newlevel = $level+ (($pack->number_of_boxes * $pack->vaccine->vials_per_box) * $pack->vaccine->doses_per_vial);
    ?>
    @if($max < $newlevel )
    <tr class="danger" title="amaount exceed maximum amount needed">
        @elseif($max > $newlevel )
    <tr class="danger" title="amount is less than amount needed">
        @else
    <tr>
        @endif
        <td>{{ $pack->vaccine->GTIN }}</td>
        <td>{{ $pack->vaccine->manufacturer }}</td>
        <td>{{ $pack->vaccine->name }}</td>
        <td>{{ $pack->lot_number }}</td>
        <td>{{ $pack->manufacturer->expiry_date }}</td>
        <td>{{ ($pack->number_of_boxes * $pack->vaccine->vials_per_box) * $pack->vaccine->doses_per_vial }}</td>
        <td>{{ $min }}</td>
        <td>{{ $max }}</td>
        <td>{{ $level }}</td>
        <td>{{ $newlevel }}</td>
        <td ><a href="#k" id="{{ $pack->id }}" class="removepack"><i class="fa fa-trash-o text-danger"></i> </a> </td>
    </tr>
    @endforeach

</table>
<p><button type="button" class="btn btn-danger delpack" style="margin-top: 10px" id="{{ $natpack->id }}">Cancel</button>
<button type="button" class="btn btn-primary sendpack" style="margin-top: 10px" id="{{ $natpack->id }}">Confirm and Send</button></p>
<script>
    $(document).ready(function(){
        $('.sendpack').click(function(){
            var id1 = $(this).attr('id');
            $(this).html("<br><i class='fa fa-spinner fa-spin'></i>confirming...");
            $.post("<?php echo url('region_package/national/confirmsend') ?>/"+id1,function(data){
                if(data == "not"){
                    alert("nothing to add");
                    setTimeout(function() {
                        $("#itemarea").fadeOut( "slow", function() {
                            $("#itemarea").html("").fadeIn();
                        });
                        $("#listuser").fadeOut( "slow", function() {
                            $("#listuser").html("").fadeIn();
                        });
                        $("#output").fadeOut( "slow", function() {
                            $("#output").html("").fadeIn();
                        });
                    }, 1500);
                }else{
                    $("#listuser").html("<h3 class='text-success'>Package sent successful</h3>");
                    setTimeout(function() {
                        $("#itemarea").fadeOut( "slow", function() {
                            $("#itemarea").html("").fadeIn();
                        });
                        $("#listuser").fadeOut( "slow", function() {
                            $("#listuser").html("").fadeIn();
                        });
                        $("#output").fadeOut( "slow", function() {
                            $("#output").html("").fadeIn();
                        });
                    }, 1500);
                }
            });
        })

        $(".removepack").click(function(){
            var id1 = $(this).attr('id');
            $(".removepack").show("slow").parent().parent().find("span").remove();
            var btn = $(this).parent().parent();
            $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
            $("#no").click(function(){
                $(this).parent().parent().find(".removepack").show("slow");
                $(this).parent().parent().find("span").remove();
            });
            $("#yes").click(function(){
                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                $.post("<?php echo url('region_package/national/listed/delete') ?>/"+id1,function(data){
                    btn.hide("slow").next("hr").hide("slow");
                });
            });
        });//endof deleting category

        $(".delpack").click(function(){
            var id1 = $(this).attr('id');
            $(".delpack").show("slow").parent().find("span.del").remove();
            var btn = $(this).parent().parent();
            $(this).hide("slow").parent().append("<span class='del'><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
            $("#no").click(function(){
                $(this).parent().parent().find(".delpack").show("slow");
                $(this).parent().parent().find("span.del").remove();
            });
            $("#yes").click(function(){
                var area = $(this).parent();
                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>Canceling...");
                $.post("<?php echo url('region_package/national/prepared/delete') ?>/"+id1,function(data){
                    area.html(data);
                    setTimeout(function() {
                        $("#itemarea").fadeOut( "slow", function() {
                            $("#itemarea").html("").fadeIn();
                        });
                        $("#listuser").fadeOut( "slow", function() {
                            $("#listuser").html("").fadeIn();
                        });
                        $("#output").fadeOut( "slow", function() {
                            $("#output").html("").fadeIn();
                        });
                    },500);
                });
            });
        });//endof deleting category
    })
</script>
@endif