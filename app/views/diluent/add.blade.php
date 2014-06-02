
    <div class="panel panel-default">
      <div class="panel-body">
         {{ Form::open(array("url"=>url('diluent/add'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
         <h2 class="text-center text-muted">Add new Diluent</h2>
          <div class='form-group'>

                <div class='col-sm-10'>
                    Name <br>  {{ Form::text('name','',array('class'=>'form-control','placeholder'=>'Diluent name','required'=>'required')) }}
                </div>
            </div>
             
              <div class='form-group'>
                    <div class='col-sm-10'>
                        Vaccine<br>{{ Form::select('vaccine',Vaccine::all()->lists('vaccine_name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
                    </div>
            </div>

          <div id="output"></div>
       <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Add',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
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

            function afterSuccess(){
                $('#FileUploader').resetForm();
                setTimeout(function() {
                    $("#output").html("");
                }, 3000);
                $("#listuser").load("<?php echo url("diluent/list") ?>")
            }
        });
    </script>
