@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('layouts.includes.headdashboardtop')
                </div>
                @if($grade === null || $chart_ca === null || $class_highest === null || $class_lowest === null || $class_average === null)

                    No grades tp view yet

                @endif
                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>{{ @$course->name }}</strong></h4>
                                <p class="category">
                                    @foreach($terms as $term)

                                        @if($today->between($term->start_date, $term->show_until))

                                            {{$term->term}}

                                        @endif

                                    @endforeach
                                </p>
                            </div>
                            <div class="content">
                                
                                <ul class="list-group">
                                  <li class="list-group-item justify-content-between">
                                    1st CA
                                    <span class="label label-primary pull-right">{{ @@$grade->first_ca }}&#32;&#47;&#32;10</span>
                                  </li>
                                  <li class="list-group-item justify-content-between">
                                    2nd CA
                                    <span class="label label-primary pull-right">{{ @@$grade->second_ca }}&#32;&#47;&#32;10</span>
                                  </li>
                                  <li class="list-group-item justify-content-between">
                                    3rd CA
                                    <span class="label label-primary pull-right">{{ @@$grade->third_ca }}&#32;&#47;&#32;10</span>
                                  </li>
                                  <li class="list-group-item justify-content-between">
                                    4th CA
                                    <span class="label label-primary pull-right">{{ @@$grade->fourth_ca }}&#32;&#47;&#32;10</span>
                                  </li>
                                  <li class="list-group-item justify-content-between">
                                    Final
                                    <span class="label label-primary pull-right">{{ @@$grade->exam }}&#32;&#47;&#32;60</span>
                                  </li>
                                  <li class="list-group-item justify-content-between">
                                    <strong>Total</strong>
                                    <span class="label label-success pull-right">{{ @@$grade->total}}&#32;&#47;&#32;100</span>
                                  </li>
                                </ul>
                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-circle text-primary"></i> <strong>
                                        @if (@@$grade->total >= 50) 
                                        You did a very good Job. Please keep it up!
                                        @else
                                        Please see Your teacher
                                        @endif</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>{{ $course->name }}</strong></h4>
                                <p class="category">
                                    @foreach($terms as $term)

                                        @if($today->between($term->start_date, $term->show_until))

                                            {{$term->term}}

                                        @endif
                                        
                                    @endforeach
                                </p>
                            </div>
                            <div class="content">
                         
                                 {!! $chart_ca->render() !!}
                                
                            

                                <div class="footer">
                                    <!-- <div class="chart-legend">
                                        
                                        <i class="fa fa-circle text-warning"></i> Class Average: {{number_format($class_average, 1)}}
                                        <i class="fa fa-circle text-primary"></i> Class Highest {{ $class_highest}}
                                        <i class="fa fa-circle text-danger"></i> Class Lowest: {{ $class_lowest }}
                                                                                
                                    </div> -->
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-circle text-info"></i><strong> Your Total Score: {{ @@$grade->total}} </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>{{ $course->name }}</strong>
                                <a class="category pull-right"><strong>Your Position: 
                                    @if (array_search(@$grade->student_id, $positions) + 1 == 1)

                                            {{ array_search(@$grade->student_id, $positions) + 1 }}st

                                        @elseif( array_search(@$grade->student_id, $positions) + 1 == 2 )

                                            {{ array_search(@$grade->student_id, $positions) + 1 }}nd

                                        @elseif( array_search(@$grade->student_id, $positions) + 1 == 3 )

                                            {{ array_search(@$grade->student_id, $positions) + 1 }}rd
                                        @elseif( array_search(@$grade->student_id, $positions) + 1 == 21 )

                                            {{ array_search(@$grade->student_id, $positions) + 1 }}st

                                        @elseif( array_search(@$grade->student_id, $positions) + 1 == 22 )

                                            {{ array_search(@$grade->student_id, $positions) + 1 }}nd

                                        @elseif( array_search(@$grade->student_id, $positions) + 1 == 23 )

                                            {{ array_search(@$grade->student_id, $positions) + 1 }}rd

                                        @else

                                            {{ array_search(@$grade->student_id, $positions) + 1 }}th

                                        @endif</strong>

                                </a></h4>
                                <p class="category">
                                    @foreach($terms as $term)

                                        @if($today->between($term->start_date, $term->show_until))

                                            {{$term->term}}

                                        @endif
                                        
                                    @endforeach
                                </p>
                            </div>
                            <div class="content">

                             {!! $chart_total_score->render() !!}
                                
                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-circle text-primary"></i> <strong>Your Total Score: {{ @$grade->total}}</strong>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{ $course->name }}</h4>
                                <p class="category">
                                    @foreach($terms as $term)

                                        @if($today->between($term->start_date, $term->show_until))

                                            {{$term->term}}

                                        @endif
                                        
                                    @endforeach
                                </p>
                            </div>
                            <div class="content">
                         
                                 {!! $chart_class_stats->render() !!}
                                
                            

                                <div class="footer">
                                    <div class="chart-legend">
                                        
                                        <i class="fa fa-circle text-primary"></i> Class Average: {{number_format($class_average, 1)}}
                                        <i class="fa fa-circle text-danger"></i> Class Highest {{ $class_highest}}
                                        <i class="fa fa-circle text-warning"></i> Class Lowest: {{ $class_lowest }}
                                                                                
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-circle text-info"></i> <strong>Total number of students in your class: {{ $class_members->count()}} </strong>
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
