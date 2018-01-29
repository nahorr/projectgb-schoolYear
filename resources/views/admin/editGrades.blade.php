

@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
            <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-danger">
                    <h5 style="color: #FFF;"><strong>Tip! </strong>Make sure all grades are entered. Please Enter '0' for grades that are not available yet. You can edit the grades later when they become available.</h5>
                  </div>
                  </div>
                </div>

            	<div class="row">
		        <div class="col-md-6">
		            <div class="card">
		                <div class="header">
		                    <h4 class="title"><strong>Editting Grades for {{ $student_grades->first_name }} {{ $student_grades->last_name }}</strong> <a class="pull-right"> {{ $course->name }}&nbsp;&nbsp;{{ $group->name }} </a></h4>
		                    <p class="category"> {{ $term->term }} </p>
		                </div>
		                <hr style="border-color: #fff;">

            	           <div class="content">
							<form action="{{ url('/postGradeUpdate', [Crypt::encrypt($student_grades->student_id), Crypt::encrypt($course->id)] )}}" method="POST">
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
                                                  <label><strong>Course: {{$course->name}}</strong></label>
                                                  <input type="hidden" class="form-control border-input" name="course_id" value="{{$course->id}}" >
                                              </div>
                                          </div>
                                        </div> 
                                      
                                        <hr>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>1st CA: (max is 10, min is 0)</strong></label>
                                                  <input type="number" name="first_ca" class="form-control border-input" value="{{ $student_grades->first_ca }}">
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>2nd CA: (max is 10, min is 0)</strong></label>
                                                  <input type="number" name="second_ca" class="form-control border-input" value="{{ $student_grades->second_ca }}" >
                                              </div>
                                          </div>


                                      </div>

                                   

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>3rd CA: (max is 10, min is 0)</strong> </label>
                                                  <input type="number" name="third_ca" class="form-control border-input" value="{{ $student_grades->third_ca }}">
                                              </div>
                                          </div>

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>4th CA: (max is 10, min is 0)</strong></label>
                                                  <input type="number" name="fourth_ca" class="form-control border-input" value="{{ $student_grades->fourth_ca }}" >
                                              </div>
                                          </div>
                                          
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>Final Exam: (max is 60, min is 0)</strong> </label>
                                                  <input type="number" name="exam" class="form-control border-input" value="{{ $student_grades->exam }}">
                                              </div>
                                          </div>

                                          
                                      </div>

                                      <div class="text-center">
                                          <input type="submit" value="Submit">
                                      </div>
                                      <div class="clearfix"></div>

                                    </form>
                                    </div>
					</div>
					</div>
					</div>
				<div class="alert-danger">
					
						<ul>
							@foreach($errors->all() as $error)

								<li> {{ $error }}</li>

							@endforeach

						</ul>

				</div>
                
               
                </div>
            </div>
       
@endsection
