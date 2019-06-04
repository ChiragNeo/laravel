<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- FOr jquery dropDown -->
<script src="path/to/jquery.js"></script> 
<script src="path/to/jquery.nice-select.js"></script>
<link rel="stylesheet" href="path/to/nice-select.css">
<!-- ENds here -->
<script>
//   $( function() {
//     $( "#datepicker" ).datepicker({
//         format: "dd/mm/yyyy",
//     });
//   } );
  </script>
  <style>
.error {color: red;}
</style>
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="myForm" method="POST" action="profile/update/{{ $user_data->id }}">
                        <!-- <input type="hidden" name="_method" value="PATCH"> -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" 
                                name="name" value="{{ $user_data->name }}" <?php echo ($user_type == 'Admin') ? '':  'readonly'; ?> autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $user_data->email }}" <?php echo ($user_type == 'Admin') ? '':  'readonly'; ?> autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('education') ? ' has-error' : '' }}">
                            <label for="education" class="col-md-4 control-label">Education</label>
                            
                            <div class="col-md-6">
                                <input id="education" type="text" class="form-control" name="education" value="{{ $user_data->education }}"  autofocus>

                                @if ($errors->has('education'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('education') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                            <label for="user_type" class="col-md-4 control-label">User Type</label>

                            <div class="col-md-6">
                                <input id="user_type" type="text" class="form-control" name="user_type" value="{{ $user_type }}"  disabled autofocus>
                                
                                @if ($errors->has('user_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <?php 
                        //   $newDate = date("d/m/Y",strtotime($user_data->dob));   
                                                
                        ?>
                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="dob" class="col-md-4 control-label">Date OF Birth</label>

                            <div class="col-md-6">
                                <input id="datepicker" type="date" class="form-control" name="dob" value= "{{ $user_data->dob}}"  autofocus>
                               
                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
  $('select').niceSelect();
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.12.0/jquery.validate.min.js"></script>
<script>
$('#myForm').validate({
  rules:{
      name: {
          required: true
      },
      email:{
          required:true,
          email:true
      },
      password: {            
            minlength: 6,
            maxlength: 8,
        },
        password_confirm: {
            required: true,
            minlength: 5,
            equalTo: "#password-confirm"
        },
  },
  message:{
      name:'This field is requred',

  }
});
</script>
@endsection
