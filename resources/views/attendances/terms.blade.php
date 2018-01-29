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
                                <table class="table table-striped">
                                    <thead>
                                        <th>TERM</th>
                                        <th>START DATE</th>
                                        <th>END DATE</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($terms as $term)

                                        <tr>
                                            <td><strong><a href="{{asset('/attendances/days/' .Crypt::encrypt($term->id)) }}" >{{ $term->term }}</a></strong></td>
                                            <td>{{ $term->start_date->toFormattedDateString() }}</td>
                                            <td>{{ $term->end_date->toFormattedDateString() }}</td>
                                           
                                        </tr>
                                     @endforeach
                                        
                                    </tbody>
                                </table>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> <strong>Click on a term above to view attendance record</strong>
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
