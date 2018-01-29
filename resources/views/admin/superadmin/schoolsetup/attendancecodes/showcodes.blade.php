@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Step 7: Add/Edit Attendance Code
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing Attendance Codes for {{ $schoolyear->school_year}} school year </h4>
                                        <span class="widget-toolbar">
                                            <strong><a href="{{asset('/schoolsetup/attendancecodes/addcode')}}">
                                                <i class="ace-icon fa fa-pencil-square-o fa-2x"></i>
                                                Add Attendance Code
                                            </a></strong>
                                        </span>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                           <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>Attendance Code</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($codes as $code)

                                                    <tr>
                                                        <td>{{ $code->code_name}}</td>
                                                        <td><strong><a href="{{asset('/schoolsetup/attendancecodes/editcode/'.$code->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
                                                        </td>
                                                        <td><strong><a href="{{asset('/schoolsetup/attendancecodes/postcodedelete/'.$code->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="danger fa fa-trash-o fa-2x" aria-hidden="true" style="color:red"></i></a></strong>
                                                        </td>
                                                       
                                                    </tr>
                                                 @endforeach
                                                    
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                <div class="hr hr-18 dotted hr-double"></div>
                <br>

                <div class="alert-danger">
                    
                        <ul>
                            @foreach($errors->all() as $error)

                                <li> {{ $error }}</li>

                            @endforeach

                        </ul>

                </div>


@endsection
