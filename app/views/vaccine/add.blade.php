
    <div class="panel panel-default">
      <div class="panel-body">
         {{ Form::open(array("url"=>url('vaccine/add'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
         <h2 class="text-center text-muted">Add new Vaccine</h2>
          <div class='form-group'>
                <div class='col-sm-6'>
                    GTN Number <br>  {{ Form::text('gtn','',array('class'=>'form-control','placeholder'=>'GTN Number','required'=>'required')) }}
                </div>
              <div class='col-sm-6'>
                  Vaccine Name <br> {{ Form::text('name','',array('class'=>'form-control','placeholder'=>'Vaccine Common Name','required'=>'required')) }}
              </div>
            </div>
             
              <div class='form-group'>
                    <div class='col-sm-6'>
                        Doses per Vials <br> {{ Form::text('dose','',array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Doses per Vials','required'=>'required')) }}
                    </div>
                      <div class='col-sm-6'>
                          Vials Per Box <br> {{ Form::text('box','',array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Vials Per Box','required'=>'required')) }}
                      </div>
            </div>

            <div class='form-group'>
                    <div class='col-sm-10 col-sm-offset-1'>
                        Warning Period<br>
                        <span class="help-block">Number of month before expiry to display warning</span>
                        {{ Form::text('warning','',array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Warning Period (Month)','required'=>'required')) }}
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
                $("#listuser").load("<?php echo url("vaccine/list") ?>")
            }
        });
    </script>
