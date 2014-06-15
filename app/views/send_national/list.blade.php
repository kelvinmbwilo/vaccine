@if($natpack)
<div class="col-sm-12">
    <div class="col-sm-4">
        <b>Voucher Number</b><br>
        {{ $natpack->package_number }}
    </div>
    <div class="col-sm-4">
        <b>Name of store</b><br>
        {{ $natpack->region->region }}
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
        <th>Lot</th>
        <th>Expiry</th>
        <th>Vials</th>
        <th>Boxes</th>
        <th>Doses</th>
        <th></th>
    </tr>
    @foreach($natpack->packages as $pack)
    <tr>
        <td>{{ $pack->vaccine->GTIN }}</td>
        <td>{{ $pack->vaccine->manufacturer }}</td>
        <td>{{ $pack->vaccine->name }}</td>
        <td>{{ $pack->lot_number }}</td>
        <td>{{ $pack->manufacturer->expiry_date }}</td>
        <td>{{ $pack->number_of_boxes * $pack->vaccine->vials_per_box }}</td>
        <td>{{ $pack->number_of_boxes}}</td>
        <td>{{ ($pack->number_of_boxes * $pack->vaccine->vials_per_box) * $pack->vaccine->vials_per_box }}</td>
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
            $.post("<?php echo url('package/national/confirmsend') ?>/"+id1,function(data){
                if(data == "not"){
                    alert("nothing to add");
                    $('.sendpack').html("Confirm and Send");
                    location.reload();
                }else{
                    location.reload();
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
                $.post("<?php echo url('package/national/listed/delete') ?>/"+id1,function(data){
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
                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>Canceling...");
                $.post("<?php echo url('package/national/prepared/delete') ?>/"+id1,function(data){
                    location.reload();
                });
            });
        });//endof deleting category
    })
</script>
@endif