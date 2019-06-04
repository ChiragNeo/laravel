@extends('layouts.admin')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8" style='margin-bottom:9px'>
                        <h3 class="box-title"><b>User Request</b></h3>
                    </div>
                    <div class='col-md-4'>
                        <a href='/request/create' class='btn btn-primary' style='float: right; margin-bottom: 10px'>Add Request</a>
                    </div>
                    <div class="col-sm-12">                     
                        <table id="request" class="table table-hover table-condensed" style="width:100%">
                            <thead>
                                <tr>
                                    
                                    <th>User</th>                                                                         
                                    <th>Status</th>
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
        "ajax": "{{ route('request.getposts') }}",
        "columns": [            
            {data: 'name', name: 'user_id'},
            {data: 'status', name: 'status'},
            {data: 'fields', name: 'fields'},
        ]
    });
});
</script>
@endsection