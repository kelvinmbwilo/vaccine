
    <div class="panel panel-default">
      <div class="panel-body">
         {{ Form::open(array("url"=>route('adduser1'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
         <h2 class="text-center text-muted">Add new User</h2>
          <div class='form-group'>

                <div class='col-sm-6'>
                    First Name <br>  {{ Form::text('firstname','',array('class'=>'form-control','placeholder'=>'First Name','required'=>'required')) }}
                </div>
                 <div class='col-sm-6'>
                     Middle Name<br> {{ Form::text('middlename','',array('class'=>'form-control','placeholder'=>'Middle Name')) }}
                 </div>
            </div>
             
              <div class='form-group'>
                    <div class='col-sm-6'>
                        Last Name <br> {{ Form::text('lastname','',array('class'=>'form-control','placeholder'=>'Last Name','required'=>'required')) }}
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
                        Level<br>{{ Form::select('role',array("admin"=>"Administrator","National"=>"National","Region"=>"Region","District"=>"District"),'',array('class'=>'form-control','required'=>'requiered')) }}
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
            alert("mama")

        });
    </script>
