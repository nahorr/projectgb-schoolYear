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
                                  <h4 class="title">Daily Activities</h4>
                                  <p class="category">Teacher: {{$student_teacher->first_name}} {{$student_teacher->last_name}}</p>
                                  <p class="category">Class: {{$student_group->name}} </p>
                              </div>
                              <div class="content">
                               
                                <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                      <th><strong>#</strong></th>
                                      <th><strong>Activity Name</strong></th>
                                      <th><strong>Activity Description</strong></th>
                                      <th><strong>Activity Day</strong></th>
                                      <th><strong>Due Date</strong></th>
                                      <th><strong>View File</strong></th>
                                      
                                  </thead>
                                  <tbody>
                                      @foreach ($daily_activities as $key=>$daily_activity)

                                      <tr>
                                          
                                          <td>{{ $key+1 }}</td>
                                          <td>{{ $daily_activity->activity_name }}</td>
                                          <td>{{ $daily_activity->activity_description }}</td>
                                          <td>{{$daily_activity->activity_date->toFormattedDateString()}}</td>
                                          <td>{{$daily_activity->due_date->toFormattedDateString()}}</td>
                                          <td>
                                            <a href="{{ asset('daily_activities/'. $daily_activity->activity_file) }}" target="_blank"><i class="fa fa-file fa-2x"></i></a>
                                          </td>
                                                                                  
                                      </tr>
                                   @endforeach
                                      
                                  </tbody>
                                  </table>
                                  <div class="pagination"> {{ $daily_activities->links() }} </div>
                                  </div>
                              </div>

                          </div>
                        </div>

              
                    </div>

           
                </div>
            </div>
        

@endsection
