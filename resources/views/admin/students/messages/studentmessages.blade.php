@extends('admin.dashboard')

@section('content')

        <div class="content">
          <div class="container-fluid">
            <div class="row">
                 @include('admin.includes.headdashboardtop')
            </div>
            @include('flash::message')
            <hr>

              <div class="col-md-8 col-md-offset-2">
                  <div class="card">
                      <div class="header">
                          <h4 class="title"><strong>Messages From {{$student_user->name}}</strong>
                            <div class="pull-right">
                              <a href="{{asset('/students/messages/allstudents/')}}"><button type="button" class="btn btn-info">BACK</button></a>
                          </div>
                          </h4>
                          <p class="category">Total # of Messages: <strong>{{$messages->where('user_id', '=', $student_user->id)->count()}}</strong> </p>
                      </div>
                      <div class="content">
                       
                        <div class="table-responsive">
                        <table class="table table-hover">
                          <thead class="thead-inverse">
                            
                              <th><strong>#</strong></th>
                              <th><strong>Subject</strong></th>
                              <th><strong>Date</strong></th>
                              <th><strong>View</strong></th>
                              <th><strong>Delete</strong></th>
                         </thead>
                          <tbody>
                            @foreach($messages->where('user_id', '=', $student_user->id) as $key=>$message)
                               @if($message->staffer_delete == 0 && $message->message_replied == null && $message->sent_staffer == null)

                                <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$message->subject}}</td>
                                <td>{{$message->created_at->toFormattedDatestring()}}</td>
                                <td>
                                  <a href="{{ asset('/students/messages/viewstudentmessage/'. $message->id) }}"><button type="button" class="btn btn-primary">VIEW MESSAGE</button></a>
                                </td>
                                <td>
                                 
                                  <form action="{{ url('students/messages/deletemessageforstaffer', [$message->id, $student_user->id]) }}" method="POST" >
                                    {{ csrf_field() }}
                                    <input type="hidden" name="staffer_delete" value="1" >
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                  </form>
                                  
                                </td>
                              </tr>
                              @endif
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