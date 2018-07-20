@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('layouts.includes.headdashboardtop')
                </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"><strong>Report Cards</strong></h4>
                                    <p class="category">School Year: {{ $schoolyear->school_year}}</p>
                                </div>
                                <div class="content">
                                    <table class="table table-bordered table-hover text-center">
                                        <thead>
                                            <th class="text-center"><strong>Terms</strong></th>
                                            <th class="text-center"><strong>Start Date</strong></th>
                                            <th class="text-center"><strong>End Date</strong></th>
                                            <th class="text-center"><strong>First Name</strong></th>
                                            <th class="text-center"><strong>Last Name</strong></th>
                                            <th class="text-center"><strong>Class</strong></th>
                                            <th class="text-center"><strong>Report Card</strong></th>

                                        </thead>
                                        <tbody>
                                            @foreach ($terms->where('school_year_id', $schoolyear->id) as $term)

                                            <tr>
                                                <td>{{ $term->term }}</td>
                                                <td>{{ $term->start_date->toFormattedDateString() }}</td>
                                                <td>{{ $term->end_date->toFormattedDateString() }}</td>
                                                <td>{{ $student->first_name }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>
                                                    @foreach($student_registered_groups as $student_group)
                                                        @if($student_group->term_id == $term->id)
                                                         {{ $student_group->group->name }}
                                                        @else
                                                            <span class="bg-danger"><strike>Not Registered</strike></span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($student_registered_groups as $student_group)
                                                        @if($student_group->term_id == $term->id)
                                                            <a href="{{asset('/showtermreportcard/'.$schoolyear->id) }}/{{Crypt::encrypt($term->id)}}" style="font-size: 16px; font-weight: bold;">VIEW&nbsp;<i class="fa fa-check-square-o fa-2x"></i></a>
                                                        @else
                                                            <span class="bg-danger"><strike>Not Registered</strike></span>
                                                        @endif
                                                    @endforeach
                                                {{-- <a href="{{asset('/pdfreportcard/'.Crypt::encrypt($term->id)) }}">Print&nbsp;<i class="fa fa-print" aria-hidden="true"></i></a> --}}
                                                </td>
                                               
                                            </tr>
                                         @endforeach
                                            
                                        </tbody>
                                    </table>

                                    <div class="footer">
                                    
                                        <div class="chart-legend">
                                            <a href="{{asset('/showtermreportcard/'.$schoolyear->id) }}/{{Crypt::encrypt($current_term->id)}}"> <i class="fa fa-circle text-info"></i> <strong>
                                                        Current term is {{ $current_term->term }} 
                                                    </strong></a>
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
        

@endsection
