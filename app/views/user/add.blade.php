
    <div class="panel panel-default">
      <div class="panel-body">
         {{ Form::open(array("url"=>route('adduser1'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
         <h2 class="text-center text-muted">Add new User</h2>
          <div class='form-group'>

                <div class='col-sm-6'>
                    First Name <br>  {{ Form::text('firstname','',array('class'=>'form-control','placeholder'=>'First Name','required'=>'required')) }}
                </div>
                <div class='col-sm-6'>
                  Last Name <br> {{ Form::text('lastname','',array('class'=>'form-control','placeholder'=>'Last Name','required'=>'required')) }}
                </div>

            </div>

              <div class='form-group'>
                    <div class='col-sm-6'>
                        Username <br> {{ Form::text('username','',array('class'=>'form-control','placeholder'=>'Username','required'=>'required')) }}
                    </div>
                  <div class='col-sm-6'>
                      Email <br> {{ Form::email('email','',array('class'=>'form-control','placeholder'=>'Email','required'=>'required')) }}
                  </div>
            </div>

            <div class='form-group'>

                    <div class='col-sm-6'>
                        Phone Number<br>{{ Form::text('phone','',array('class'=>'form-control','placeholder'=>'Phone Number','required'=>'required')) }}
                    </div>
                    <div class='col-sm-6'>
                        Role <br>{{ Form::select('role',array("admin"=>"Administrator","National IVD"=>"National IVD","National"=>"National Store","Region"=>"Region Store","District"=>"District Store"),'',array('class'=>'form-control','required'=>'requiered')) }}
                    </div>

                </div>
          <div class='form-group' id="area">

              <div class='col-sm-6' id="regarea">
                  Region<br>{{ Form::select('region',Region::all()->lists('region','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
              </div>
              <div class='col-sm-6' id="disarea">
                  District<br><span id="district-area">{{ Form::select('district',array('all'=>'all')+District::lists('district','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
              </div>

          </div>
             <div class='form-group'>
                 <div class='col-sm-6'>
                     Password<br>{{ Form::password('password',array('class'=>'form-control','placeholder'=>'Password','required'=>'required')) }}
                 </div>
                 <div class='col-sm-6'>
                     Re-Password <br> {{ Form::password('repassword',array('class'=>'form-control','placeholder'=>'Re-Password','required'=>'required')) }}
                 </div>
             </div>
          <div id="output"></div>
       <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Add User',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
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

            var area = $("#area").html();
            var dis = $("#disarea").html();
            var reg = $("#regarea").html();
            $("#disarea,#regarea").html("");
            $("select[name=role]").change(function(){
                if($(this).val() == "Region"){
                    $("#regarea").html(reg);
                    $("#disarea").html("");
                }else if($(this).val() == "District"){
                    $("#disarea").html(dis);
                    $("#regarea").html("");
                }else{
                    $("#disarea,#regarea").html("");
                }
            })

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
                }, 3000);
                $("#listuser").load("<?php echo url("user/list") ?>")
            }
        });
    </script>
