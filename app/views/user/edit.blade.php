
<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("user/edit/{$user->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
        <h3 class="text-center text-muted">Update User Information</h3>
        <div class='form-group'>

            <div class='col-sm-6'>
                First Name <br>  {{ Form::text('firstname',$user->firstname,array('class'=>'form-control','placeholder'=>'First Name','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Middle Name<br> {{ Form::text('middlename',$user->middlename,array('class'=>'form-control','placeholder'=>'Middle Name')) }}
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-6'>
                Last Name <br> {{ Form::text('lastname',$user->lastname,array('class'=>'form-control','placeholder'=>'Last Name','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Email <br> {{ Form::email('email',$user->email,array('class'=>'form-control','placeholder'=>'Email','required'=>'required')) }}
            </div>
        </div>

        <div class='form-group'>

            <div class='col-sm-6'>
                Phone Number<br>{{ Form::text('phone',$user->phone,array('class'=>'form-control','placeholder'=>'Phone Number','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Role<br>{{ Form::select('role',array("admin"=>"Administrator","doctor"=>"Doctor"),$user->role,array('class'=>'form-control','required'=>'requiered')) }}
            </div>

        </div>
        <div class='form-group'>

            <div class='col-sm-6'>
                Region<br>{{ Form::select('region',array('0'=>'all')+Region::all()->lists('region','id'),$user->region_id,array('class'=>'form-control','required'=>'requiered')) }}
            </div>
            <div class='col-sm-6'>
                District<br><span id="district-area">{{ Form::select('district',array('0'=>'all')+District::lists('district','id'),$user->district_id,array('class'=>'form-control','required'=>'requiered')) }}</span>
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

        $("select[name=region]").change(function(){
            $("#district-area").html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
            $.post("<?php echo url('user/region_check1') ?>/"+$(this).val(),function(dat){
                $("#district-area").html(dat);
            })
        })
        function afterSuccess(){
            $('#FileUploader').resetForm();
            setTimeout(function() {
                $("#output").html("");
                $("#adduser").load("<?php echo url("user/add") ?>")
            }, 3000);
            $("#listuser").load("<?php echo url("user/list") ?>")
        }
    });
</script>


