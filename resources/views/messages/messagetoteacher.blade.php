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
                                  <h4 class="title">My Messages
                                    <div class="pull-right">
                              <a href="{{asset('/messages/sendmessagetoteacher/'.$student_teacher->id)}}"><button type="button" class="btn btn-success">Send Message To Your Teacher</button></a>
                              
                            </div>
                                  </h4>
                                  <p class="category">Total Messages: 1 , Read: 1, Unread: 0 </p>
                              </div>
                              <div class="content">
                               
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                  <thead>
                                      <th><strong>#</strong></th>
                                      <th><strong>Subject</strong></th>
                                      <th><strong>From</strong></th>
                                      <th><strong>File</strong></th>
                                      <th><strong>View</strong></th>
                                      <th><strong>Delete</strong></th>
                                  </thead>
                                  
                                </table>

                                </div>
                              </div>

                          </div>
                        </div>

              
                    </div>

           
                </div>
            </div>
        

@endsection
