@extends('admin.dashboard')

@section('content')

        <div class="content">
          <div class="container-fluid">
            <div class="row">
                 @include('admin.includes.headdashboardtop')
            </div>
            <div class="row">

              <div class="col-md-6 col-md-offset-3">
                  <div class="card">
                      <div class="header">
                          <h4 class="title">Please Select an activity type to continue</h4>
                          <p class="category">Class: {{$group_teacher->name}} </p>
                      </div>
                      <div class="content">
                        <div class="alert alert-success">
                          <a href="{{asset('/students/activities/dailyactivities')}}"><strong><i class="fa fa-cubes fa-2x"></i> &nbsp;&nbsp;&nbsp;&nbsp;DAILY ACTIVITIES</strong></a>
                        </div>

                        <div class="alert alert-info">
                          <a href="{{asset('/students/discipline/allstudents')}}"><strong><i class="fa fa-balance-scale fa-2x"></i> &nbsp;&nbsp;&nbsp;&nbsp;DISCIPLINARY RECORDS</strong></a>
                        </div>

                      <hr>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection