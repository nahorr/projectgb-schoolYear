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
                          <h4 class="title">Please Select a type to continue</h4>
                          <p class="category">Class: {{$group_teacher->name}} </p>
                      </div>
                      <div class="content">
                        <div class="alert alert-success">
                          <a href="{{asset('/admin/stats/grades')}}"><strong><i class="fa fa-pie-chart fa-2x"></i> &nbsp;&nbsp;&nbsp;GRADES</strong></a>
                        </div>

                        <div class="alert alert-info">
                          <a href=""><strong><i class="fa fa-calendar-check-o fa-2x"></i> &nbsp;&nbsp;&nbsp;ATTENDANCE</strong></a>
                        </div>

                      <hr>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection