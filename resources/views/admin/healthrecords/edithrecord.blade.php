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
                                <h4 class="title">Editing Health Record</h4>
                                <p class="category">for {{$student->first_name}} {{$student->last_name}}</p>
                            </div>
                              <hr>
                            <div class="content">
                              <form class="form-group" action="{{ url('/healthrecords/posthrecordupdate', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]) }}" method="POST">
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
                                                  <label>Weight: in kg</label>
                                                  <input type="number" name="weight" class="form-control border-input" value="{{$hrecord->weight}}" required="required">
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Height: in centimeters</label>
                                                  <input type="number" name="height" class="form-control border-input" value="{{$hrecord->height}}" required="required" >
                                              </div>
                                          </div>


                                      </div>

                                   

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Nurse's Remark: 1 - 5 (max value is 5, min is 1) </label>
                                                  <input type="number" name="comment_nurse" class="form-control border-input" value="{{$hrecord->comment_nurse}}" required="required">
                                              </div>
                                          </div>

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Doctor's Remark: 1 - 5 (max value is 5, min is 1)</label>
                                                  <input type="number" name="comment_doctor" class="form-control border-input" value="{{$hrecord->comment_doctor}}" required="required" >
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
