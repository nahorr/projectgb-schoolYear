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
                                <h4 class="title"><strong>{{Auth::User()->name}}'s Course</strong></h4>
                                <p class="category"> @foreach ($terms as $term)
                                                    @if ($today->between($term->start_date, $term->show_until ))
                                                        {{ $term->term }} Courses
                                                    @endif
                                                    
                                                @endforeach </p>
                            </div>
                            <div class="content">
                                
                                <ul style="list-style-type:none">
                                    
                                    @foreach ($current_courses as $course)

                                        

                                            
                                    <li><strong><i class="fa fa-circle text-info"></i>&nbsp;<a href="{{asset('/courses/'.Crypt::encrypt($course->id)) }}" >{{ $course->course_code}}&nbsp;&nbsp;{{ $course->name }}</a></strong></li></br >
                                           
                                   
                                    

                                    @endforeach

                                </ul>
                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-reload"></i> Total # of courses this term : {{ $count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>School Statistics</strong></h4>
                                <p class="category">
                                    {{@$school_year->school_year}} School Year
                                </p>
                            </div>
                            <div class="content">

                            {!! $chart_student_average->render() !!}
                                
                                



                                <div class="footer">
                                   <div class="chart-legend">
                                        <i class="fa fa-circle text-primary"></i> Minimum: {{@$school_min}}
                                        <i class="fa fa-circle text-danger"></i> Maximum: {{@$school_max}}
                                        <i class="fa fa-circle text-warning"></i> Average: {{number_format(@$school_avg, 1)}}
                                        
                                    </div> 
                                    <hr>
                                   <div class="stats">
                                        <i class="ti-reload"></i> 
                                        @foreach ($terms as $term)
                                        @if ($today->between($term->start_date, $term->show_until ))
                                            Current Term: {{ $term->term }} 
                                        @endif
                                        
                                    @endforeach 
                                    <p>Above bar charts show the school grades statistics so far for the {{@$school_year->school_year}} School Year. It give an indication on how your schol it doing as a whole. The graph is dynamic - it will change from time to time- when new grades are entered or deleted.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
                </div>
            </div>
        </div>

@endsection
