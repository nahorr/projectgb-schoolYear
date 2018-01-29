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

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Adding Learning And Accademics</h4>
                                                      
                            </div>
                              <hr>
                            <div class="content">
                              <form class="form-group" action="{{ url('/learningandaccademics/postlearningandaccademic', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]) }}" method="POST">
                              {{ csrf_field() }}
                                      <div class="row">
                                          <div class="col-md-8">
                                              <div class="form-group">
                                                  <label>
                                                    @foreach ($all_user as $st_user)

                                                      @if ($st_user->registration_code == $student->registration_code)

                                                        
                                                          <strong>
                                                          <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                                          {{$student->first_name}} {{$student->last_name}} 
                                                          </strong>
                                                      @endif
                                                    @endforeach
                                                  </label>
                                                  <input type="hidden" class="form-control border-input" name="student_id" value="{{$student->id}}">
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label><strong>Term: {{$term->term}}</strong></label>
                                                  <input type="hidden" class="form-control border-input" name="term_id" value="{{$term->id}}" >
                                              </div>
                                          </div>
                                      </div> 
                                      
                                        <hr>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Class Work: 1 - 5 (max value is 5, min is 1)</label>
                                                  <input type="number" name="class_work" class="form-control border-input" required="required">
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Home Work: 1 - 5 (max value is 5, min is 1)</label>
                                                  <input type="number" name="home_work" class="form-control border-input" required="required" >
                                              </div>
                                          </div>


                                      </div>

                                   

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Project: 1 - 5 (max value is 5, min is 1) </label>
                                                  <input type="number" name="project" class="form-control border-input" required="required">
                                              </div>
                                          </div>

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Note Taking: 1 - 5 (max value is 5, min is 1)</label>
                                                  <input type="number" name="note_taking" class="form-control border-input" required="required" >
                                              </div>
                                          </div>
                                          
                                      </div>

                                                                     
                                      <div class="text-center">
                                          <input type="submit" value="Submit">
                                      </div>
                                      <div class="clearfix"></div>
                                  </form>
                                  
                                  <hr>

                                   <br>

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
