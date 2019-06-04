@extends('layouts.admin')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8" style='margin-bottom:9px'>
                        <h3 class="box-title"><b>Rejected User</b></h3>
                    </div>
                    <div class="col-sm-12">                     
                        <table id="request" class="table table-hover table-condensed" style="width:100%">
                            <thead>
                                <tr>                                    
                                    <th>Name</th>                                                                         
                                    <th>Email</th>
                                    <th>Date of Birth</th>                                                                         
                                    <th>User Type</th>
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
    oTable = $('#request').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('user.getpost') }}",
        "columns": [
            
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'dob', name: 'dob'},
            {data: 'user_type', name: 'user_type'},
            {data: 'education', name: 'education'}
                      
                      
        ]
    });

    $(document).on("click",".ActivateButton",function() {
            
            console.log('ew');
        var id = $(this).attr('id');
        var value = $(this).attr('value');
        
    $.ajax({
        method: 'POST', // Type of response and matches what we said in the route
        url: '/user/approve', // This is the url we gave in the route
        data: {'_token': '{{csrf_token()}}','value':value,'id':id}, // a JSON object to send back
        success: function(response){ // What to do if we succeed
            $('#request').DataTable().ajax.reload();


        },        
    });
    });    
});
</script>
@endsection