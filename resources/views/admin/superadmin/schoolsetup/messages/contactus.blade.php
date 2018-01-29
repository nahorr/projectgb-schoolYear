@extends('admin.superadmin.dashboard')

@section('content')
    <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home fa-3x"></i>
                                <a href="#"><h3>{{@$school->name}}</h3></a>
                            </li>

                        </ul><!-- /.breadcrumb -->

                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                    <i class="ace-icon fa fa-calendar fa-3x"></i>&nbsp;
                                    <a href="#"><h3>{{$today->toFormattedDateString()}}</h3></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="page-content">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3 class="header smaller lighter blue">All Contact Us Messages: {{@$contact_us->count()}}</h3>

                                        
                                        <!-- div.table-responsive -->

                                        <!-- div.dataTables_borderWrap -->
                                        <div class="table-responsive">
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr style="font-size: 11px;">

                                                    <th>ID</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Message</th>
                                                    <th>Date Recieved</th>
                                                    <th>Actions</th>

                                                    </tr>
                                                </thead>

                                                
                                            </table>

                                            <script src="https://datatables.yajrabox.com/js/jquery.min.js"></script>
                                            <!--<script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>-->
                                            <script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
                                            <script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>  
                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#dynamic-table').DataTable({
                                                        processing: true,
                                                        serverSide: true,
                                                        ajax: '{{url('/schoolsetup/messages/getcontactusdata')}}',
                                                        columns: [
                                                            
                                                            {data: 'id', name: 'contactus.id'},
                                                            {data: 'first_name', name: 'contactus.first_name'},
                                                            {data: 'last_name', name: 'contactus.last_name'},
                                                            {data: 'phone', name: 'contactus.phone'},
                                                            {data: 'email', name: 'contactus.email'},
                                                            {data: 'message', name: 'contactus.message'},
                                                            {data: 'created_at', name: 'contactus.created_at'},
                                                            {data: 'action', name: 'action', orderable: false, searchable: false}

                                                            

                                                        ]
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>


                       
                     
            </div><!-- /.page-content -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->

@endsection
