@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('layouts.includes.headdashboardtop')
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>Attendance by term</strong></h4>
                                <p class="category"> School Year: &nbsp;&nbsp;{{ $school_year->school_year}}</p>
                            </div>
                            <div class="content">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>DATE: YYYY-MM-DD</th>
                                        <th>Present/Absent/Late</th>
                                        <th> Teacher's Comments</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($att_attCode as $key => $attend)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $attend->day }}</td>
                                            <td>{{ $attend->code_name }}</td>
                                            <td>{{ $attend->teacher_comment }}</td>
                                           
                                        </tr>
                                     @endforeach
                                        
                                    </tbody>
                                </table>

                                <div class="pagination"> {{ $att_attCode->links() }} </div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> Above shows your attendance record for <strong>{{$term->term}}</strong>
                                    </div>
                                    <hr>
                                    <!--
                                    <div class="stats">
                                        <i class="ti-timer"></i> Campaign sent 2 days ago
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    </div>

                    

                </div>
            </div>
        </div>

@endsection
