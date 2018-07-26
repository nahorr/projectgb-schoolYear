@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                
                    <div class="row">

                      <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Messages you sent
                                    <div class="pull-right">
                                    
                                        <a href="{{asset('/messages/sendmessagetoteacher/'.$schoolyear->id)}}/{{$students_teacher_current->id}}"><button type="button" class="btn btn-success">Send Message To Your Teacher</button>
                                        </a>
                              
                            </div>
                                  </h4>
                                  <p class="category">Total Messages Sent so far: {{$sentMessages->count()}} , Read: 0, Unread: 0 </p>
                              </div>
                              <div class="content">
                               
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                  <thead>
                                      <th><strong>#</strong></th>
                                      <th><strong>Subject</strong></th>
                                      <th><strong>Sent To</strong></th>
                                      <th><strong>Message</strong></th>
                                      <th><strong>File</strong></th>
                                      <th><strong>Date Sent</strong></th>
                                      <th><strong>Action</strong></th>
                                  </thead>

                                    <tbody>
                                        @foreach ($sentMessages->where('sent_to_staffer', !null) as $key => $sentMessage)
                                          @if($sentMessage->user_delete == 0)
                                        <tr>
                                            <td>{{ $number_init++ }}</td>
                                            <td>{{ $sentMessage->subject }}</td>
                                            <td>
                                              @foreach($staffers as $staffer)
                                                @if($staffer->id == $sentMessage->sent_to_staffer)
                                                  {{ $staffer->first_name}} {{ $staffer->last_name}}
                                                @endif
                                              @endforeach
                                            </td>
                                            <td>{{ str_limit($sentMessage->body, 50) }}</td>
                                            <td>
                                              @if(!empty($sentMessage->message_file))
                                              <a href="{{asset('/messages/'.$sentMessage->message_file)}}" target="_blank" ><i class="fa fa-print" aria-hidden="true"></i>View File</a>
                                              @endif
                                              </td>
                                            <td>{{ $sentMessage->created_at->toFormattedDateString() }}</td>
                                            <td>

                                              <a href="{{asset('/messages/readmessage/'.$schoolyear->id)}}/{{$sentMessage->id}}"><button type="button" class="btn btn-info">VIEW MESSAGE</button>
                                              </a>
                                              <hr>
                                              
                                              <form action="{{ url('messages/deleteMessageForStudent', [ $schoolyear->id, $sentMessage->id]) }}" method="POST">
                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="user_delete" value="1" >
                                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this record?')">DELETE MESSAGE</button>
                                              </form>
                                              
                                            
                                            </td>
                                        </tr>
                                        @endif
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
