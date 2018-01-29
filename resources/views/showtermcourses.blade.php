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
                                <h4 class="title"><strong>{{Auth::User()->name}}'s Course</strong>
                                <span class="text-right pull-right"><strong><a href="{{ url('/home') }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>Terms</a></strong></span></h4>
                                <p class="category"> {{ $term->term }} Courses</p>
                            </div>
                            <div class="content">
                                
                                <ul style="list-style-type:none">
                                    
                                    @foreach ($term_courses as $course)

                                        

                                            
                                    <li><strong><i class="fa fa-circle text-info"></i>&nbsp;<a href="{{asset('/courses/'.Crypt::encrypt($course->id))}}" >{{ $course->course_code}}&nbsp;&nbsp;{{ $course->name }}</a></strong></li></br >
                                           
                                   
                                    

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
                                <h4 class="title"><strong>Term Statistics</strong></h4>
                                <p class="category">
                                    @foreach ($terms as $term)
                                        @if ($today->between($term->start_date, $term->show_until ))
                                            Current Term: {{ $term->term }} 
                                        @endif
                                        
                                    @endforeach 
                                </p>
                            </div>
                            <div class="content">

                            {!! $class_student_term_chart->render() !!}
                                
                                



                                <div class="footer">
                                   <div class="chart-legend">
                                        <i class="fa fa-circle text-primary"></i> Your Term Min: {{@$student_term_min}}
                                        <i class="fa fa-circle text-primary"></i> Your Term Max: {{@student_term_max}}
                                        <i class="fa fa-circle text-primary"></i>Your Term Ave: {{number_format(@$student_term_avg, 1)}}
                                        
                                    </div> 
                                    <hr>
                                   <div class="stats">
                                        <i class="ti-reload"></i>Above bar charts show your grades and your class grades statistics this term side by side. It gives an indication on how you are doing this term compared to you class. The graph is dynamic - it will change from time to time- when new grades are entered or deleted.
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
