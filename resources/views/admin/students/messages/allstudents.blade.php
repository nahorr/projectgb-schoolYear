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
                          <h4 class="title"><strong>Message Board</strong></h4>
                          <p class="category">Your Class: {{$group_teacher->name}} </p>
                      </div>
                      <div class="content">
                       
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                              <th><strong>#</strong></th>
                              <th><strong>Face</strong></th>
                              <th><strong>Student Name</strong></th>
                              <th class="text-center"><strong># of Messages</strong></th>
                              <th><strong>View Messages</strong></th>
                              <th><strong>Send Message</strong></th>
                         </thead>
                          <tbody>

                            @foreach ($all_user as $key=>$user)
                              
                               

                              <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img class="avatar border-white" src="{{asset('assets/img/students/'.$user->avatar) }}" alt="..."/></td>
                                <td>{{$user->name}}</td>
                                <td class="text-center">{{$messages->where('user_id', '=', $user->id)->where('sent_staffer', '=', null)->count()}}</td>
                                <td>
                                  <a href="{{ asset('/students/messages/studentmessages/'. $user->id) }}"><button type="button" class="btn btn-info">VIEW MESSAGES</button></a>
                                </td>
                                <td>
                                  <a href="{{ asset('/students/messages/sendmessagetostudent/'. $user->id) }}"><button type="button" class="btn btn-primary">SEND MESSAGES</button></a>
                                </td>
                              </tr>
                                
                            @endforeach
                          </tbody>
                          </table>
                          <div class="pagination">  </div>
                          </div>
                      </div>
   
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection