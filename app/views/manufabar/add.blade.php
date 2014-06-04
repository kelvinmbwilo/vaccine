
    <div class="panel panel-default">
      <div class="panel-body">
         {{ Form::open(array("url"=>url('manubarcode/add'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
         <h2 class="text-center text-muted">Define new Manufacture Barcode</h2>
          <div class='form-group'>
              <div class='col-sm-10 col-sm-offset-1'>
                  Barcode <br>  {{ Form::text('barcode','',array('class'=>'form-control','placeholder'=>'Bar Code','required'=>'required')) }}
              </div>
          </div>
          <div class='form-group'>
              <div class='col-sm-6'>
                  Manufacturer<br>{{ Form::select('manufacture',Manufacturer::all()->lists('name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
              </div>
              <div class='col-sm-6'>
                  <input type="radio" name="sel" value="vaccine" checked>vaccine
                  <input type="radio" name="sel" value="diluent" class="sell">diluent<br />
                  <span class="vacc"> Vaccine<br>{{ Form::select('vaccine',Vaccine::all()->lists('vaccine_name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
                  <span class="dil"> Diluent<br>{{ Form::select('diluent',Diluent::all()->lists('diluent_name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
              </div>
          </div>
              <div class='form-group'>
                  <div class='col-sm-6'>
                      Manufacture Date <br>  {{ Form::text('manu','',array('class'=>'dat form-control','placeholder'=>'Manufacture Date','required'=>'required')) }}
                  </div>
                  <div class='col-sm-6'>
                      Expiry Date <br>  {{ Form::text('exp','',array('class'=>'dat form-control','placeholder'=>'Expiry Date','required'=>'required')) }}
                  </div>
              </div>
              <div class='form-group'>
                  <div class='col-sm-6'>
                        Quantity <br>  {{ Form::text('quantity','',array('class'=>'form-control','placeholder'=>'Quantity','required'=>'required')) }}
                  </div>
                  <div class='col-sm-6'>
                      Lot Number <br>  {{ Form::text('lot','',array('class'=>'form-control','placeholder'=>'Lot Number','required'=>'required')) }}
                  </div>
              </div>
              <div class='form-group'>
                  <div class='col-sm-6'>
                        Boxes Per package <br>  {{ Form::text('boxes','',array('class'=>'form-control','placeholder'=>'Boxes per package','required'=>'required')) }}
                  </div>
                  <div class='col-sm-6'>
                        Vials per box <br>  {{ Form::text('vials','',array('class'=>'form-control','placeholder'=>'Vials per Box','required'=>'required')) }}
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
                $("#listuser").load("<?php echo url("manufarbar/list") ?>")
            }
        });
    </script>
