<?php $count = ArrivalRegion::where('national_package',$package->id)->count()+1;
$expected = $package->number_of_packages; ?>
<p>
<p>
    Package From National Level &nbsp;&nbsp;&nbsp;
    Package Number : {{ $package->package_number }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Package : {{ ArrivalRegion::where('national_package',$package->id)->count()+1 }} / {{ $package->number_of_packages }}
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
        <td>{{ $pack->manufacturer->content }}</td>
        <td>
            @if($pack->manufacturer->content == 'vaccine')
                {{ $pack->manufacturer->vaccine->vaccine_name }}
            @endif
            @if($pack->manufacturer->content == 'diluent')
                {{ $pack->manufacturer->vaccine->diluent_name }}
            @endif
        </td>
        <td>{{ date('d M Y',strtotime($pack->manufacturer->expiry_date)) }}</td>
        <td>{{ $pack->number_of_boxes * $pack->manufacturer->vaccine->doses_per_vial*$pack->manufacturer->vaccine->vials_per_box   }}</td>
        <td>
        @if($pack->manufacturer->content == 'vaccine')
            {{ $pack->number_of_boxes}}
        @endif
        </td>
    </tr>
    @endforeach
</table>
<div class="row">
    {{ Form::open(array("url"=>url("region_package/receive/confirm/{$package->id}"),"class"=>"form-horizontal","id"=>'confirmpackage')) }}
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
                setTimeout(function() {
                    location.reload();
                }, 3000);
        }
    });
</script>