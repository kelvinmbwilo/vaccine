
<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("vaccine/edit/{$vaccine->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
        <h3 class="text-center text-muted">Update Vaccine Information</h3>
        <div class='form-group'>
            <div class='col-sm-6'>
                GTN Number <br>  {{ Form::text('gtn',$vaccine->GTIN,array('class'=>'form-control','placeholder'=>'GTN Number','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Type <br> {{ Form::text('name',$vaccine->vaccine_name,array('class'=>'form-control','placeholder'=>'Vaccine Common Name','required'=>'required')) }}
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-6'>
                Doses per unit <br> {{ Form::text('dose',$vaccine->doses_per_vial,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Doses per Vials','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Packaging<br> {{ Form::text('box',$vaccine->vials_per_box,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Vials Per Box','required'=>'required')) }}
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-10 col-sm-offset-1'>
                Warning Period<br>
                <span class="help-block">Number of month before expiry to display warning</span>
                {{ Form::text('warning',$vaccine->warning_period,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Warning Period (Month)','required'=>'required')) }}
            </div>
        </div>


        <div id="output"></div>
       <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Submit',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
           {{ Form::button('Cancel',array('class'=>'btn btn-danger','id'=>'cancel')) }}
        </div>
      {{ Form::close() }}
    </div>
      </div>
<script>
    $(document).ready(function (){
        $('#FileUploader').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#FileUploader').resetForm();
            setTimeout(function() {
                $("#output").html("");
                $("#adduser").load("<?php echo url("vaccine/add") ?>")
            }, 3000);
            $("#listuser").load("<?php echo url("vaccine/list") ?>")
        }
    });
</script>


