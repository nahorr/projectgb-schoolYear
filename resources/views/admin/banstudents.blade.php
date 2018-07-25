@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>
                 @include('flash::message')
                <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-info">
                    <h5><strong>Banning Students!</strong> Only registerd students can be Banned from using the platform! Please remind all students in your class to register as soon as possible.</h5>
                  </div>
                  </div>
                </div>

                 
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Students in your class who have registered: </h4>
                                <p class="category">Teacher Name: <strong>{{@$teacher->first_name}}  {{@$teacher->last_name}}</strong></p>
                                <p class="category">Class: {{@\App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', $teacher->id)->first()->group->name}} </p>
                                <p class="category">Current Term: {{$current_term->term}} {{$current_school_year->school_year}} </p>
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
                                <th>Email</th>
                                <th>Ban/unBan Students</th>
                               
                               
                                

                              </tr>
                            </thead>
                            <tbody>
                            
                                 @foreach (@$join_students_regs->where('school_year_id', $schoolyear->id)->where('term_id', $term->id)->where('group_id', \App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', $teacher->id)->first()->group_id ) as $key=>$reg_student)

                                  @foreach ($all_users as $st_user)
                                   @if ($st_user->registration_code == $reg_student->student->registration_code) 
                               
                                      <tr>

                                        <td>{{$key+1}}</td>
                                        
                                        <td>                                    
                                        <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                        </td>

                                        <td>{{$reg_student->student->first_name}}</td>
                                        <td>{{$reg_student->student->last_name}}</td>
                                        <td>{{$st_user->email}}</td>
                                                                                
                                      <td>
                                      @if($st_user->status == 1)
                                      <form class="form-group" action="{{ url('/admin/posteditban', [$schoolyear->id, $term->id, Crypt::encrypt($st_user->id)] )}}" method="POST">
                                      {{ csrf_field() }}
                                      <input id="status" name="status" type="hidden" value="0">
                                      <input type="submit" value="Ban {{$st_user->name}}" style="color: red">
                                      </form>

                                      @else
                                      <form class="form-group" action="{{ url('/admin/posteditunban', [$schoolyear->id, $term->id, Crypt::encrypt($st_user->id)] )}}" method="POST">
                                      {{ csrf_field() }}
                                      <input id="status" name="status" type="hidden" value="1">
                                      <input type="submit" value="unBan {{$st_user->name}}" style="color: green">
                                      </form>
                                      @endif
                                      </td>

                                          @endif    
                                  @endforeach     
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
