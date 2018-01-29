

@extends('admin.dashboard')

@section('content')

		<div class="content">
            <div class="container-fluid">

                <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-danger">
                    <h5 style="color: #FFF;"><strong>Tip! </strong>If you have only say, 1st CA grade, at the begining of the term. Please Enter '0' for all other grades to be able to proceed. You can edit the grades later when they become available</h5>
                  </div>
                  </div>
                </div>

			<div class="row">
		        <div class="col-md-6">
		            <div class="card">
		                <div class="header">
		                    <h4 class="title"><strong>Add Grades for {{ $course->name }}-{{ $group->name }}</strong> <a class="pull-right"> {{ $term->term }} </a></h4>
		                    <p class="category"> {{ $term->term }} </p>
		                </div>
		                <hr style="border-color: #fff;">
            <div class="content">
        			<form class="form-group" action="{{ url('/postGrades',[Crypt::encrypt($student->id),Crypt::encrypt($course->id)] )}}" method="POST">
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
                                                  <input type="number" name="first_ca" class="form-control border-input" required="required">
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>2nd CA: (max is 10, min is 0)</strong></label>
                                                  <input type="number" name="second_ca" class="form-control border-input" required="required" >
                                              </div>
                                          </div>


                                      </div>

                                   

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>3rd CA: (max is 10, min is 0)</strong> </label>
                                                  <input type="number" name="third_ca" class="form-control border-input" required="required">
                                              </div>
                                          </div>

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>4th CA: (max is 10, min is 0)</strong></label>
                                                  <input type="number" name="fourth_ca" class="form-control border-input" required="required" >
                                              </div>
                                          </div>
                                          
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>Final Exam: (max is 60, min is 0)</strong> </label>
                                                  <input type="number" name="exam" class="form-control border-input" required="required">
                                              </div>
                                          </div>

                                          
                                      </div>

                                                                     
                                      <div class="text-center">
                                          <input type="submit" value="Submit">
                                      </div>
                                      <div class="clearfix"></div>
                                </form>
                              </div>
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


       
@endsection
