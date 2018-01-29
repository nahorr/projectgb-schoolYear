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
                                <h3 class="header smaller lighter blue">Viewing <strong>{{@$loginActivities->count()}}</strong> activities
                                    <div class="pull-right">
                                    <form>
                                        <button type="submit" class="btn btn-primary">Clear Log</button>
                                    </form>
                                    </div>
                                </h3>

                                
                                <!-- div.table-responsive -->

                                <!-- div.dataTables_borderWrap -->
                                <div class="table-responsive">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size: 11px;">

                                            <th>#</th>
                                            <th>Student</th>
                                            <th>User Agent</th>
                                            <th>ip</th>
                                            <th>City</th>
                                            <th>Region</th>
                                            <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($loginActivities as $key=>$loginActivity)

                                                @foreach($users->where('id', '=', $loginActivity->user_id) as $user)
                                                    

                                                        <tr>
                                                           <td>{{$key+1}}</td> 
                                                           <td>{{$user->name}} </td>
                                                           <td>{{$loginActivity->user_agent}}</td>
                                                           <td> {{$loginActivity->ip_address}} </td>
                                                           <td> {{$loginActivity->ip_city}} </td>
                                                           <td> {{$loginActivity->ip_region}} </td>
                                                           <td>{{$loginActivity->created_at}}</td>
                                                        <tr>
                                                    
                                                @endforeach

                                            @endforeach

                                            
                                    
                                        </tbody>
 
                                </table>
                                <div class="pagination"> {{ $loginActivities->links() }} </div>
                            </div>
                        </div>


                       
                     
            </div><!-- /.page-content -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div>

@endsection
