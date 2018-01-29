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
                                <h4 class="title">Editing Learning And Accademic</h4>
                                <p class="category">for {{$student->first_name}} {{$student->last_name}}</p>
                            </div>
                              <hr>
                            <div class="content">
                              <form class="form-group" action="{{ url('/learningandaccademics/postlearningandaccademicupdate', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]) }}" method="POST">
                              {{ csrf_field() }}
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>Student: {{$student->first_name}} {{$student->last_name}} </strong></label>
                                                  <input type="hidden" class="form-control border-input" name="student_id" value="{{$student->id}}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
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
                                                  <input type="number" name="class_work" class="form-control border-input" value="{{$learningandaccademic->class_work}}" required="required">
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Home Work: 1 - 5 (max value is 5, min is 1)</label>
                                                  <input type="number" name="home_work" class="form-control border-input" value="{{$learningandaccademic->home_work}}" required="required" >
                                              </div>
                                          </div>


                                      </div>

                                   

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Project: 1 - 5 (max value is 5, min is 1) </label>
                                                  <input type="number" name="project" class="form-control border-input" value="{{$learningandaccademic->project}}" required="required">
                                              </div>
                                          </div>

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Note Taking: 1 - 5 (max value is 5, min is 1)</label>
                                                  <input type="number" name="note_taking" class="form-control border-input" value="{{$learningandaccademic->note_taking}}" required="required" >
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
