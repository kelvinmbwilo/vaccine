
    <div class="panel panel-default">
      <div class="panel-body">
         {{ Form::open(array("url"=>url('manubarcode/add'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
         <h2 class="text-center text-muted">Manufacture Package</h2>
          <div class='form-group'>
              <div class='col-sm-6'>
                  SSCC <br>  {{ Form::text('barcode','',array('class'=>'form-control','placeholder'=>'Serial Shipping Container Code','title'=>'Serial Shipping Container Code','required'=>'required')) }}
              </div>
              <div class='col-sm-6'>
                  Number of Packages <br>  {{ Form::text('packages','',array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Number of Packages','required'=>'required')) }}
              </div>
          </div>
          <div class='form-group'>
              <div class='col-sm-6'>
                  Manufacturer<br>{{ Form::select('manufacture',Manufacturer::all()->lists('name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
              </div>
              <div class='col-sm-6'>
                  Manufacture Date <br>  {{ Form::text('manu','',array('class'=>'dat form-control','placeholder'=>'Manufacture Date','required'=>'required')) }}
              </div>

          </div>
              <div class='form-group'>
                  <div class='col-sm-6'>
                      Content type<br>{{ Form::select('type',array('vaccine'=>'vaccine','diluent'=>'diluent'),'',array('class'=>'form-control','required'=>'requiered')) }}
                  </div>
                  <div class='col-sm-6'>
                      <span id="vacc"> Vaccine<br>{{ Form::select('vaccine',Vaccine::all()->lists('vaccine_name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
                      <span id="dil"> Diluent<br>{{ Form::select('diluent',Diluent::all()->lists('diluent_name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
                  </div>
              </div>
          <div class='form-group'>
              <div class='col-sm-6'>
                  Lot Number <br>  {{ Form::text('lot','',array('class'=>'form-control','placeholder'=>'Lot Number','required'=>'required')) }}
              </div>
              <div class='col-sm-6'>
                  Expiry Date <br>  {{ Form::text('exp','',array('class'=>'dat form-control','placeholder'=>'Expiry Date','required'=>'required')) }}
              </div>
           </div>
              <div class='form-group'>
                  <div class='col-sm-6'>
                      Quantity(Number of Doses) <br>  {{ Form::text('quantity','',array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Number of Doses','required'=>'required')) }}
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

            $(".dat").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:"yy-mm-dd"
            });

            var vacc = $("#vacc").html();
            var dil = $("#dil").html();
            $("#dil").html("");
            $("select[name=type]").change(function(){
                if($(this).val() == 'vaccine'){
                    $("#vacc").html(vacc);
                    $("#dil").html("");
                }
                if($(this).val() == 'diluent'){
                    $("#vacc").html("");
                    $("#dil").html(dil);
                }
            })
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
                $("#listuser").load("<?php echo url("manubarcode/list") ?>")
            }
        });
    </script>
