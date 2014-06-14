
<div class="panel panel-primary">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("facility/edit/{$facility->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
        <div class='form-group'>
            <div class='col-sm-6' id="regarea">
                Region<br>{{ Form::select('region',Region::all()->lists('region','id'),$facility->district->region_id,array('class'=>'form-control','required'=>'requiered')) }}
            </div>
            <div class='col-sm-6' id="disarea">
                District<br><span id="district-area">{{ Form::select('district',$facility->district->region->district->lists('district','id'),$facility->district_id,array('class'=>'form-control','required'=>'requiered')) }}</span>
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-6'>
                name<br> {{ Form::text('name',$facility->name,array('class'=>'form-control','placeholder'=>'Facility Name','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Target Population<br> {{ Form::text('population',$facility->target_population,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Target Population')) }}
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-6'>
                Annual Birth<br>{{ Form::text('birth',$facility->annual_birth,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Annual Birth')) }}
            </div>
            <div class='col-sm-6'>
                Surviving Infants <br> {{ Form::text('infants',$facility->surviving_infants,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Surviving Infants')) }}
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-12'>
                Contacts <br> {{ Form::text('contact',$facility->contact,array('class'=>'form-control','placeholder'=>'Contacts')) }}
            </div>
        </div>
        <div id="output"></div>

        <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Update',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
            {{ Form::reset('Reset',array('class'=>'btn btn-warning','id'=>'submitqn')) }}
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

        $("select[name=region]").change(function(){
            $("#district-area").html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
            $.post("<?php echo url('user/region_check1') ?>/"+$(this).val(),function(dat){
                $("#district-area").html(dat);
            })
        })
        function afterSuccess(){
            setTimeout(function() {
                $("#myModal").modal("hide");
            }, 1000);
            $("#listuser").load("<?php echo url("facility/list") ?>")
        }
    });
</script>


