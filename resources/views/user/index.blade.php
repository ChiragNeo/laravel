<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
@extends('layouts.admin')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8" style='margin-bottom:9px'>
                        <h3 class="box-title"><b>User Management</b></h3>
                    </div>
                    <div class="col-sm-12">                     
                        <table id="users" class="table table-hover table-condensed" style="width:100%">
                            <thead>
                                <tr>                                    
                                    <th>UserName</th>
                                    <th>Email</th>                                      
                                    <th>Action</th>          
                                </tr>
                            </thead>
                        </table>
                    </div>    
                </div>    
            </div>
        </div>
    </section>
@endsection
@section('footer-assets')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$(document).ready(function() { 
    oTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('user.getposts') }}",
        "columns": [
            
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'user_type', name: 'user_type'},  
                      
        ]
    });
   

});
</script>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" id='loginmodal'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" name="button" class="close"></button>
            </div>
            <h4 class="model-title">User Details</h4>
            <div class="modal-body">
            
            </div>
            <div class=modal-footer>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
 $(document).ready(function() {
        
});
</script>