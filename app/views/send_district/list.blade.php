<h4 class="text-center">Scanned Packages Ready to Send to {{ $natpack->district->district }} </h4>
<table class="table table-hover table-responsive">
    <tr>
        <th>#</th>
        <th>Type</th>
        <th>Name</th>
        <th>Expiry Date</th>
        <th>Number Of Boxes</th>
    </tr>
    <?php $i = 1 ?>
    @foreach($natpack->packages as $pack)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $pack->manufacturer->content }}</td>
        <td>
            @if($pack->manufacturer->content == 'vaccine')
                {{ $pack->manufacturer->vaccine->vaccine_name }}
            @else
                {{ $pack->manufacturer->diluent->diluent_name }}
            @endif
        </td>
        <td>{{ date("d M Y", strtotime($pack->manufacturer->expiry_date)) }}</td>
        <td>{{ $pack->number_of_boxes }}</td>
        <td><a href="#d" class="removepack" id="{{ $pack->id }}"><i class="fa fa-trash-o text-danger"></i> remove</a></td>
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
                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>Canceling...");
                $.post("<?php echo url('region_package/national/prepared/delete') ?>/"+id1,function(data){
                    location.reload();
                });
            });
        });//endof deleting category
    })
</script>