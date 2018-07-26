@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
               

                    <div class="row">

                      <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Recieved Messages
                                    <div class="pull-right">
                                    <a href="{{asset('/messages/viewsentmessages/'.$schoolyear->id)}}"><button type="button" class="btn btn-info">View Sent Messages</button></a>&nbsp;&nbsp;
                              <a href="{{asset('/messages/sendmessagetoteacher/'.$schoolyear->id)}}/{{$students_teacher_current->id}}"><button type="button" class="btn btn-success">Send Message To Your Teacher</button></a>
                              
                            </div>
                                  </h4>
                                  <p class="category">Total Messages: {{$receivedMessages->count()}}</p>
                              </div>
                              <div class="content">
                               
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                  <thead>
                                      <th><strong>#</strong></th>
                                      <th><strong>From</strong></th>
                                      <th><strong>Subject</strong></th> 
                                      <th><strong>Date Received</strong></th>
                                      <th><strong>View Message</strong></th>
                                      <th><strong>Delete Message</strong></th>
                                  </thead>

                                  <tbody>
                                        @foreach ($receivedMessages->where('user_delete', 0) as $key => $receivedMessage)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $receivedMessage->staffer->first_name}} {{ $receivedMessage->staffer->last_name}}</td>
                                            <td>{{ $receivedMessage->subject }}</td> 
                                            <td>{{ $receivedMessage->created_at->toFormattedDateString() }}</td>
                                            <td>
                                              <a href="{{asset('/messages/readstaffermessage/'.$schoolyear->id)}}/{{$receivedMessage->id}}"><button type="button" class="btn btn-info">View Message</button>
                                              </a>
                                            </td>
                                            <td>

                                              <form action="{{ url('messages/deleteMessageForStudent', [$receivedMessage->id]) }}" method="POST">
                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="user_delete" value="1" >
                                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this record?')">DELETE MESSAGE</button>
                                              </form>
                                              
                                            </td>
                                        </tr>
                                     @endforeach
                                        
                                    </tbody>
                                  
                                </table>

                                </div>
                              </div>

                          </div>
                        </div>

              
                    </div>

           
                </div>
            </div>
        

@endsection
