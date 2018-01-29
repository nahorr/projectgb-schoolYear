@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
             @include('flash::message')
             <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-info">
                    <h5><strong>Registration Alert!</strong> If student's face does not display, It means that the student is yet to register. Please remind the student to register.</h5>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-warning">
                    <h5><strong>Add, Edit, or Delete Grades!</strong><br> You can add, edit, or delete grades for students in your <strong>{{$course->name}}</strong> class here. Just click on Add or Edit or Delete beside the student you wish to add, edit, or delete grades for.<br> <strong>Please enter zero for grades that are not available now. You can edit them later when the grades become available</strong></h5>
                  </div>
                  </div>
                </div>
                
                <div class="row">

                	<div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                 <h4 class="title"> 
                                 
                                 <a><i class="fa fa-book fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Course:&nbsp; {{ $course->course_code }}: {{ $course->name }} </a> <div class="pull-right"><a href="{{asset('/admincourses/'. Crypt::encrypt($term->id)) }}"><button type="button" class="btn btn-primary">Back To {{@$term->term}} Courses</button></a></div>
                                 
                                 </h4>
                                <p class="category"><strong>{{strtoupper($group->name)}} - {{ strtoupper($term->term) }}</strong></p>
                                
                            </div>
                            
                        <div class="content">
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                                <tr>
                                <th colspan="1" class="text-center">Table</th>
                                <th colspan="1" class="text-center">Student</th>
                                <th colspan="1" class="text-center">Last</th>
                                <th colspan="4" class="text-center">Continuous Assessments 10% each</th>
                                <th colspan="1" class="text-center">60%</th>
                                <th colspan="1" class="text-center">100%</th>
                                <th colspan="3" class="text-center">Class Statistics</th>
                                <th colspan="1" class="text-center">Student</th>
                                <th colspan="1" class="text-center">Letter</th>
                                <th colspan="3" class="text-center">Action</th>
                                
                              </tr>
                              <tr class="info">
                                <th class="text-center">#</th>
                                <th class="text-center">Face</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Ist</th>
                                <th class="text-center">2nd</th>
                                <th class="text-center">3rd</th>
                                <th class="text-center">4th</th>
                                <th class="text-center">Exam</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Highest</th>
                                <th class="text-center">Lowest</th>
                                <th class="text-center">Average</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Grade</th>
                                <th class="text-center">Add</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>

                              </tr>
                            </thead>
                            <tbody>

                            
                                     @foreach ($students as $key => $student)

                                        
                                  

                                      <tr>
                                        <td class="text-center">{{$key+1}}</td>

                                        <td class="text-center"> 
                                        @foreach ($all_user as $st_user)

                                            @if ($st_user->registration_code == $student->registration_code)                         

                                        <img class="avatar border-white" src="{{asset('/assets/img/students/'.$st_user->avatar) }}" alt="..."/>

                                           @endif
                                            
                                        @endforeach
                                        </td>

                                        <td class="text-center">{{$student->last_name}}</td>

                                        <td class="text-center">
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code) 
                                          {{$grade->first_ca}}
                                          @endif
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code) 
                                          {{$grade->second_ca}}
                                          @endif
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code) 
                                          {{$grade->third_ca}}
                                          @endif
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach ($grades as $grade)
                                         @if ($grade->registration_code == $student->registration_code) 
                                          {{$grade->fourth_ca}}
                                          @endif
                                         @endforeach
                                        </td>
                                        <td>
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code) 
                                          {{$grade->exam}}
                                          @endif
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code) 
                                          {{$grade->total}}
                                          @endif
                                        @endforeach
                                        </td>
                                        
                                        <td class="text-center">{{$class_highest}}</td>
                                        <td class="text-center">{{$class_lowest}}</td>
                                        <td class="text-center">{{number_format($class_average, 1)}}</td>
                                        <td class="text-center">
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code)

                                        @if (array_search($grade->student_id, $positions) + 1 == 1)

                                            {{ array_search($grade->student_id, $positions) + 1 }}st

                                        @elseif( array_search($grade->student_id, $positions) + 1 == 2 )

                                            {{ array_search($grade->student_id, $positions) + 1 }}nd

                                        @elseif( array_search($grade->student_id, $positions) + 1 == 3 )

                                            {{ array_search($grade->student_id, $positions) + 1 }}rd
                                        @elseif( array_search($grade->student_id, $positions) + 1 == 21 )

                                            {{ array_search($grade->student_id, $positions) + 1 }}st

                                        @elseif( array_search($grade->student_id, $positions) + 1 == 22 )

                                            {{ array_search($grade->student_id, $positions) + 1 }}nd

                                        @elseif( array_search($grade->student_id, $positions) + 1 == 23 )

                                            {{ array_search($grade->student_id, $positions) + 1 }}rd

                                        @else

                                            {{ array_search($grade->student_id, $positions) + 1 }}th

                                        @endif 
                                        @endif
                                        @endforeach

                                        </td>
                                        <td class="text-center">
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code)
                                            

                                            @if ($grade->total < 65)
                                            F
                                            @elseif ($grade->total<= 66 && $grade->total >=65)
                                            D
                                            @elseif ($grade->total<= 69 && $grade->total >=67)
                                            D+
                                            @elseif ($grade->total<= 73 && $grade->total >=70)
                                            C-
                                            @elseif ($grade->total<= 76 && $grade->total >=74)
                                            C
                                            @elseif ($grade->total<= 79 && $grade->total >=77)
                                            C+
                                            @elseif ($grade->total<= 83 && $grade->total >=80)
                                            B-
                                            @elseif ($grade->total<= 86 && $grade->total >=84)
                                            B
                                            @elseif ($grade->total<= 89 && $grade->total >=87)
                                            B+
                                            @elseif ($grade->total<= 93 && $grade->total >=90)
                                            A-
                                            @elseif ($grade->total<= 96 && $grade->total >=94)
                                            A
                                            @elseif ($grade->total>= 97)
                                            A+
                                            @endif

                                            @endif
                                        @endforeach
                                           
                                        </td>
                                        <td class="text-center">
                                       
                                        <a href="{{ url('/addGrades', [Crypt::encrypt($student->id), Crypt::encrypt($course->id)] ) }}"> <i class="fa fa-plus fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Add 
                                        </a>
                                        
                                        </td>

                                        <td class="text-center">
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code)
                                        <a href="{{ url('/editGrades', [Crypt::encrypt($grade->student_id), Crypt::encrypt($course->id)] ) }}"> <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Edit 
                                        </a>
                                        @endif
                                        @endforeach
                                        </td>
                                        <td class="text-center">
                                        @foreach ($grades as $grade)
                                            @if ($grade->registration_code == $student->registration_code)                                        
                                        <a href="{{ url('/deletegrade/'.Crypt::encrypt($grade->id) ) }}" onclick="return confirm('Are you sure you want to Delete this record?')"> <i class="fa fa-trash fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Delete
                                        </a>
                                        @endif
                                        @endforeach
                                        </td>
                                      
                                      </tr>
                                      
                                @endforeach
                           
                            </tbody>
                          </table>
                        </div>


                               
                                <div class="footer">
                                    <!-- <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Click
                                        <i class="fa fa-circle text-warning"></i> Click Second Time
                                    </div> -->
                                    <hr>
                                    <!-- <div class="stats">
                                        <i class="ti-reload"></i> Updated 3 minutes ago
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
               
                </div>
        </div>
       
@endsection
