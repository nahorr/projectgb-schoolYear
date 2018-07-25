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
                          <p class="category">Your Current Class Class: {{ @\App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', '=', $teacher->id)->first()->group->name}} </p>
                      </div>
                      <div class="content">
                       
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                              <th><strong>#</strong></th>
                              <th><strong>Face</strong></th>
                              <th><strong>From</strong></th>
                              <th><strong>Subject</strong></th>
                              <th class="text-center"><strong>Date Received</strong></th>
                              <th class="text-center"><strong>View Message</strong></th>
                              <th class="text-center"><strong>Delete Message</strong></th>
                         </thead>
                          <tbody>

                            @foreach ($messages->where('sent_to_staffer', $teacher->id)->where('staffer_delete', 0)->where('sent_to_student', null) as $key=> $message)
                            
                              <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img class="avatar border-white" src="{{asset('assets/img/students/'.$message->user->avatar) }}" alt="..."/></td>
                                
                                <td>{{$message->user->name}}</td>
                                <td>{{str_limit($message->subject, 30)}}</td>
                                <td class="text-center">{{$message->created_at->toFormattedDateString()}}</td>
                                <td class="text-center">
                                  <a href="{{ asset('/students/messages/viewstudentmessage/'. $schoolyear->id ) }}/{{$term->id}}/{{$message->id}}"><button type="button" class="btn btn-info">VIEW MESSAGE</button></a>
                                </td>
                                <td class="text-center">
                                  <form  action="{{ url('students/messages/deletemessageforstaffer', [$schoolyear->id, $term->id, $message->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="staffer_delete" value="1" >
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this record?')">DELETE MESSAGE</button>
                                  </form>
                              
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