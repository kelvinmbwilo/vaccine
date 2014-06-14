<h4>Package sent on {{ date('j M Y',strtotime($package->first()->created_at)) }}</h4>
<table class="table table-responsive table-bordered" id="alllist">
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
    @foreach($package as $pack)
    <tr>
        <td>{{ $pack->vaccine->GTIN }}</td>
        <td>{{ $pack->vaccine->name }}</td>
        <td>
           {{ $pack->vaccine->manufacturer }}
        </td>
        <td>{{ $pack->lot_number }}</td>
        <td>{{ $pack->expiry_date }}</td>
        <td>{{ $pack->number_of_doses/$pack->vaccine->doses_per_vial }}</td>
        <td>{{ ($pack->number_of_doses/$pack->vaccine->doses_per_vial)/$pack->vaccine->vials_per_box }}</td>
        <td>{{ $pack->number_of_doses }}</td>
    </tr>
    @endforeach
</table>
<div class="col-sm-12" style="margin-bottom: 20px">
<form method="post" action="{{ url('') }}" id="checkqr">
    <div class="form-group" >
        <div class="col-sm-6">
            Scan the QR Code from one box from per each item in the list above <br>
            <input type="text" name="lot" placeholder="Scan Item QR Code" required class="form-control">
        </div>
        <div class="col-sm-6">
<!--            <br><button type="submit" class="btn btn-info btn-min">Add</button>-->
        </div>
    </div>
</form>
</div>
<div class="col-sm-12" id="qroutput"></div>
<script>
    $(document).ready(function(){
        $("input[name=lot]").focus();
        $('#checkqr').on('submit', function(e) {
            e.preventDefault();
            $("#qroutput").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Retriving package information please wait...</span><h4>");
            $(this).ajaxSubmit({
                url : '<?php echo url('package/receive/qrcode') ?>/'+$('input[name=lot]').val(),
                target: '#qroutput',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#checkqr').resetForm();
            $("input[name=lot]").focus();
        }
    })
</script>
