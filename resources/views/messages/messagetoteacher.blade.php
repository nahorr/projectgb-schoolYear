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
                                        @foreach ($receivedMessages as $key => $receivedMessage)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $receivedMessage->staffer->first_name}} {{ $receivedMessage->staffer->last_name}}</td>
                                            <td>{{ $receivedMessage->subject }}</td> 
                                            <td>{{ $receivedMessage->created_at->toFormattedDateString() }}</td>
                                            <td>
                                              <a href="{{asset('/messages/readmessage/'.$receivedMessage->id)}}"><button type="button" class="btn btn-info">View Message</button>
                                              </a>
                                            </td>
                                            <td>
                                              <a href="{{asset('/messages/readmessage/'.$receivedMessage->id)}}"><button type="button" class="btn btn-info">Delete Message</button>
                                              </a>
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
