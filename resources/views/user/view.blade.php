
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
            <div class="row">
                <div class='col-md-6'>
                    <h4 style="float:right">User Details</h4>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled >
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" disabled >

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="dob" class="col-md-4 control-label">Date OF Birth</label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="dob" value="{{ $formatedDate }}"  disabled>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('education') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Education</label>

                            <div class="col-md-6">
                                <input id="education" type="text" class="form-control" name="education" value="{{ $user->education }}" disabled >

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                            <label for="user_type" class="col-md-4 control-label">User Role</label>

                            <div class="col-md-6">
                                <input id="user_type" type="text" class="form-control" name="user_type" value="{{ $user->user_type }}" disabled >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            <button type="button" name="button" data-dismiss="modal" class="btn btn-primary"> Close</button>
                            </div>
                        </div>
            </form>
<div class='row'>    </div>
<script>
 $(document).ready(function() {
    $('#closebutton').trigger('click.dismiss.bs.modal')
});
</script>