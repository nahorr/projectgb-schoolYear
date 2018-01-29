				 <div class="panel-body">  
				 <div class="col-md-4 ">

                    
                    <ul class="list-group">
						  <li class="list-group-item justify-content-between">
						    Name:&nbsp;&nbsp;
						    <span class="label label-primary pull-right">{{Auth::user()->name}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Age
						    <span class="label label-primary pull-right">{{ $student->dob->diffInYears($today) }}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Admission #: 
						    <span class="label label-primary pull-right">{{ $student->registration_code }}</span>
						  </li>
					</ul>
					

                  </div>{{-- biodata-1 --}}
                  <div class="col-md-4 ">
                       
                       	<ul class="list-group">
						  <li class="list-group-item justify-content-between">
						    Sex:
						    <span class="label label-primary pull-right">{{ $student->gender}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    # of students in class:
						    <span class="label label-primary pull-right">{{$students_all->count()}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Admission Date: 
						    <span class="label label-primary pull-right">{{ $student->date_enrolled }}</span>
						  </li>
					</ul>

                  </div>{{-- biodata-2 --}}
                  <div class="col-md-4 ">
                       
                       	<ul class="list-group">
						  <li class="list-group-item justify-content-between">
						    Teacher:&nbsp;&nbsp;
						    <span class="label label-primary pull-right">{{ $student_teacher->first_name }}&nbsp;&nbsp;{{ $student_teacher->last_name }}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Class:
						    <span class="label label-primary pull-right">{{ $student_group->name }}</span>
						  </li>
						  @if($course_grade->count() != null)
						  <li class="list-group-item justify-content-between">
						    Overall &#37;: 
						    <span class="label label-primary pull-right">{{$course_grade->sum('total')/$course_grade->count()}} &#37;</span>
						  </li>
						  @else
						  <li class="list-group-item justify-content-between">
						    Overall &#37;: 
						    <span class="label label-primary pull-right"> 0 &#37;</span>
						  </li>

						  @endif

                  </div>{{-- biodata-2 --}}
                  </div>