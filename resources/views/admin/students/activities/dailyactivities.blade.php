@extends('admin.dashboard')

@section('content')

        <div class="content">
          <div class="container-fluid">
            <div class="row">
                 @include('admin.includes.headdashboardtop')
            </div>
            @include('flash::message')
            <hr>

              <div class="col-md-12">
                  <div class="card">
                      <div class="header">
                          <h4 class="title">Daily Activities
                             <div class="pull-right"><a href="{{asset('/students/activities/adddailyactivity')}}"><button type="button" class="btn btn-success">ADD NEW ACTIVITY</button></a></div>
                          </h4>
                          <p class="category">Class: {{$group_teacher->name}} </p>
                      </div>
                      <div class="content">
                       
                        <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                              <th>#</th>
                              <th>Activity Name</th>
                              <th>Activity Description</th>
                              <th>Activity Day</th>
                              <th>Due Date</th>
                              <th>File</th>
                              <th>Edit</th>
                              <th>Delete</th>
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
                                  <td>
                                    <a href="{{asset('/students/activities/editdailyactivity/'.$daily_activity->id)}}">
                                      <button type="button" class="btn btn-info">EDIT</button>
                                    </a>
                                  </td>
                                  <td>
                                    <a href="{{asset('/students/activities/deleteactivity/'.$daily_activity->id)}}" onclick="return confirm('Are you sure you want to Delete this record?')">
                                      <button type="button" class="btn btn-danger">DELET</button>
                                    </a>
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