@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>
                <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-info">
                    <h5><strong>Registration Alert!</strong> You can only send Messages to registered students. If student's face does not display, It means that the student is yet to register. Please remind the student to register.</h5>
                  </div>
                  </div>
                </div>

                 
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Students in Your class
                                  <div class="pull-right"><a href="{{asset('/students/messages/allstudents/'.$schoolyear->id)}}/{{$term->id}}"><button type="button" class="btn btn-info">Back</button></a></div>
                                </h4>
                                <p class="category">You have 

                             
                               {{ @\App\StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('group_id', \App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->first()->group_id)->count() }}
                             
                                students in your class this term</p>
                            </div>
                            <div class="content">
                            <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>#</th>
                                <th>Faces</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Send Message</th>                     
                                
                              </tr>
                            </thead>
                            <tbody> 
                                                          
                                @foreach (@$join_students_regs->where('term_id', $term->id)->where('group_id', \App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', '=', $teacher->id)->first()->group_id ) as $key => $reg_student)


                                                                             
                                    <tr>

                                      <td>{{$number_init++}}</td>
                                      
                                      <td>
          
                                     
                                      @foreach ($all_users as $st_user)

                                      

                                          @if($st_user->registration_code == $reg_student->registration_code)

                                          <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                      
                                          @endif
                                      
                                      @endforeach

                                       </td>
                                      <td>{{$reg_student->student->first_name}}</td>
                                      <td>{{$reg_student->student->last_name}}</td>
                                      <td>
                                        @foreach ($all_users as $st_user)

                                          @if($st_user->registration_code == $reg_student->registration_code)

                                              <a href="{{asset('/students/messages/sendmessagetostudent/'.$schoolyear->id)}}/{{$term->id}}/{{$st_user->id}}"><button type="button" class="btn btn-success">Send Message To {{$st_user->name}}</button></a>

                                          @endif
                                        
                                        @endforeach
                                      </td>                                     
                                    
                        
                            @endforeach
                          
                            
                            </tbody>
                          </table>
                        </div>
                                
                                
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                </div>
            </div>
        </div>

@endsection
