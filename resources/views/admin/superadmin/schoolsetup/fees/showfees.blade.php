@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Step 8: Add/Edit Fee
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing Fees for {{ $schoolyear->school_year}} school year </h4>
                                        <span class="widget-toolbar">
                                            <strong><a href="{{asset('/schoolsetup/fees/addfee')}}">
                                                <i class="ace-icon fa fa-pencil-square-o fa-2x"></i>
                                                Add Fee
                                            </a></strong>
                                        </span>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                           <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Group</th>
                                                    <th>Term</th>
                                                    <th>Due Date</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($fees_join as $key=>$fee)

                                                    <tr>
                                                        
                                                        <td>{{ $fee->fee_type}}</td>
                                                        <td>{{ $fee->amount}}</td>
                                                        <td>{{ $fee->name}}</td>
                                                        <td>{{ $fee->term}}</td>
                                                        <td>{{ $fee->due_date->toFormattedDateString()}}</td>
                                                        <td><strong><a href="{{asset('/schoolsetup/fees/editfee/'.$fee->id) }}/{{$fee->group_id}}/{{$fee->term_id}}/{{$fee->feetype_id}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
                                                        </td>
                                                        <td><strong><a href="{{asset('/schoolsetup/fees/postfeedelete/'.$fee->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="danger fa fa-trash-o fa-2x" aria-hidden="true" style="color:red"></i></a></strong>
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
