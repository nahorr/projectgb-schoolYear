@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>
                <div class="row">

                  @include('flash::message')
                  <hr>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Adding Attendance</h4>
                                <p class="category"><strong>for {{$student->first_name}} {{$student->last_name}}</strong></p>
                            </div>
                              <hr>
                            <div class="content">
                              <form class="form-group" action="{{ url('/attendances/postattendance', [Crypt::encrypt($student->id)]) }}" method="POST">
                              {{ csrf_field() }}
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>
                                                    @foreach ($all_user as $st_user)

                                                      @if ($st_user->registration_code == $student->registration_code)

                                                        
                                                          <strong>
                                                          <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                                         
                                                          </strong>
                                                      @endif
                                                    @endforeach
                                                  </label>
                                                  <input type="hidden" class="form-control border-input" name="student_id" value="{{$student->id}}">
                                              </div>
                                          </div>
                                          @foreach ($terms as $term)

                                            @if($today->between($term->start_date, $term->show_until))
                                          <div class="col-md-3">
                                              <div class="form-group">
                                                  <label><strong>{{$term->term}}</strong></label>
                                                  <input type="hidden" class="form-control border-input" name="term_id" value="{{$term->id}}" >
                                              </div>
                                          </div>
                                              @endif
                                          @endforeach
                                          <div class="col-md-3">
                                              <div class="form-group">
                                                  <label><strong>{{$today->toFormattedDateString()}}</strong></label>
                                                  <input type="hidden" name="day" class="form-control border-input" value="{{$today}}">
                                              </div>
                                          </div>
                                        </div> 
                                      
                                        <hr>
                                                                 
                                      
                                      <div class="text-center">
                                      <label class="">Select Present, Absent, or Late</label>
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  
                                                  <select name="attendance_code_id" id="attendance_code_id">
                                                      <option selected disabled>Please select one option</option>
                                                            @foreach($attendancecodes as $key => $attendancecode)

                                                                <option value="{{ $key }}" >
                                                                    {{ $attendancecode }}
                                                                </option>

                                                            @endforeach
                                                    </select>
                                              </div>
                                          </div>

                                          <div class="form-group">
                                          <label for="exampleTextarea">Enter Attendance for {{ $student->first_name }} {{ $student->last_name }}</label>
                                          <textarea class="form-control" name="teacher_comment" id="teacher_comment" rows="3"></textarea>
                                      </div>
                                                                                    
                                      </div>
                                      
                                     
                                     <div class="clearfix"></div>
                                                                     
                                      <div class="text-center">
                                          <input type="submit" value="Submit">
                                      </div>
                                      <div class="clearfix"></div>
                                  </form>
                                  
                                  <hr>

                                  

                                  <div class="alert-danger">
                            
                                      <ul>
                                        @foreach($errors->all() as $error)

                                          <li> {{ $error }}</li>

                                        @endforeach

                                      </ul>

                                  </div>
                                    
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                </div>
            </div>
        </div>

@endsection
