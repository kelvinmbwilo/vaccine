<?php $count = ArrivalNational::where('ssc',$package->ssc)->count()+1;
$expected = $package->number_of_packages; ?>
<p>
    Manufacturer: {{ $package->manufacturer->name }} &nbsp;&nbsp;&nbsp;
    SSCC : {{ $package->ssc }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Package : {{ ArrivalNational::where('ssc',$package->ssc)->count()+1 }} / {{ $package->number_of_packages }}
</p>
<table class="table table-responsive table-bordered">
    <tr>
        <th>Lot Number</th>
        <th>content</th>
        <th>Product Name</th>
        <th>Expiry Date</th>
        <th>Number of Doses</th>
        <th>Number of Boxes</th>
    </tr>
    @foreach($package->packages as $pack)
    <tr>
        <td>{{ $pack->lot_number }}</td>
        <td>{{ $pack->content }}</td>
        <td>
            @if($pack->content == 'vaccine')
                {{ $pack->vaccine->vaccine_name }}
            @endif
            @if($pack->content == 'diluent')
                {{ $pack->vaccine->diluent_name }}
            @endif
        </td>
        <td>{{ $pack->expiry_date }}</td>
        <td>{{ $pack->number_of_doses }}</td>
        <td>
        @if($pack->content == 'vaccine')
            {{ ($pack->number_of_doses/$pack->vaccine->doses_per_vial)/$pack->vaccine->vials_per_box }}
        @endif
        </td>
    </tr>
    @endforeach
</table>
<div class="row">
    {{ Form::open(array("url"=>url("package/receive/confirm/{$package->id}"),"class"=>"form-horizontal","id"=>'confirmpackage')) }}
    <div class='form-group'>
        <div class='col-sm-4'>
           <small> Was quantity received as per shipping notification? </small>
            {{ Form::select('quantity',array('Yes'=>'Yes','No'=>'No'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class='col-sm-4'>
            Coolant type:<br>
            {{ Form::select('coolant',array('Dry Ice'=>'Dry Ice','Icepacks'=>'Icepacks','No Coolant'=>'No Coolant'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class='col-sm-4'>
            Temperature monitors present<br>
            {{ Form::select('temp',array('VVM'=>'VVM','Cold-chain card'=>'Cold-chain card','Electronic device'=>'Electronic device','Other'=>'Other'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-4'>
           <small> What was the condition of boxes on arrival? </small><br>
            {{ Form::select('condition',array('Good Condition'=>'Good Condition','Bad Condition'=>'Bad Condition'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class='col-sm-4'>
            <small> Were necessary labels attached to shipping boxes? </small><br>
            {{ Form::select('labels',array('Yes'=>'Yes','No'=>'No'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class='col-sm-4'>
            Click here after checking<br>
            {{ Form::submit('Confirm',array('class'=>'btn btn-primary form-control','id'=>'submitqn')) }}
        </div>
    </div>
    {{ Form::close() }}
    <div id="output1" style="padding-top: 10px;text-align: center">

    </div>
</div>
<script>
    $(document).ready(function (){
        $('#confirmpackage').on('submit', function(e) {
            e.preventDefault();
            $("#output1").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Confirming please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            if('<?php echo $count ?>' == '<?php echo $expected ?>'){
                setTimeout(function() {
                    $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>please wait...</span><h3>");
                    $("#output").load("<?php echo url("package/receive/form") ?>")
                }, 2000);
            }else{
                setTimeout(function() {
                    $("#output").html("");
                }, 2000);

            }


        }
    });
</script>