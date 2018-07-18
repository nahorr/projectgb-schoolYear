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
                    <h5><strong>Registration Alert!</strong> If student's face does not display, It means that the student is yet to register. Please remind the student to register.</h5>
                  </div>
                  </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">You can Add/Edit/Delete Health Records here</h4>
                                <p class="category">Class: {{@\App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', $teacher->id)->first()->group->name}} </p>
                                <p class="category">Current Term: {{$current_term->term}} {{$current_school_year->school_year}} </p>
                            </div>
                            <div class="content">
                            <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>Faces</th>
                                <th>First Name</th>
                                <th>Last name</th>
                                <th>Weight</th>
                                <th>Height</th>
                                <th>Nurse's Remark</th>
                                <th>Doctor's Remark</th>
                                <th>Add HRecord</th>
                                <th>Edit HRecord</th>
                                <th>Delete HRecord</th>

                              </tr>
                            </thead>
                            <tbody>
                                   @foreach (@$join_students_regs->where('school_year_id', $schoolyear->id)->where('term_id', $term->id)->where('group_id', \App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', $teacher->id)->first()->group_id ) as $reg_student)

                                      

                                                                           
                                    <tr>
                                      
                                      <td>
                                      @foreach ($all_users as $st_user)

                                        @if ($st_user->registration_code == $reg_student->student->registration_code)
                                      <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                      
                                      @endif
                                     @endforeach
                                      </td>
                                      <td>{{$reg_student->student->first_name}}</td>
                                      <td>{{$reg_student->student->last_name}}</td>
                                     
                                      <td>
                                      @foreach($hrecords as $hrecord)

                                        @if($hrecord->student_id == $reg_student->student->id && $term->id == $hrecord->term_id)

                                           {{$hrecord->weight}}


                                        @endif

                                      @endforeach
                                     </td>

                                     <td>
                                      @foreach($hrecords as $hrecord)

                                        @if($hrecord->student_id == $reg_student->student->id && $term->id == $hrecord->term_id)

                                           {{$hrecord->height}}


                                        @endif

                                      @endforeach
                                     </td>

                                     <td>
                                      @foreach($hrecords as $hrecord)

                                        @if($hrecord->student_id == $reg_student->student->id && $term->id == $hrecord->term_id)

                                           {{$hrecord->comment_nurse}}


                                        @endif

                                      @endforeach
                                     </td>

                                     <td>
                                      @foreach($hrecords as $hrecord)

                                        @if($hrecord->student_id == $reg_student->student->id && $term->id == $hrecord->term_id)

                                           {{$hrecord->comment_doctor}}


                                        @endif

                                      @endforeach
                                     </td>
                                     
                                                                               
                                      <td>

                                      <strong><a href="{{asset('/healthrecords/addhrecord/'.$schoolyear->id) }}/{{$term->id}}/{{$reg_student->student->id}}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Add HRecord</a>
                                     
                                      </td>
                                      <td>

                                      <strong><a href="{{asset('/healthrecords/edithrecord/'.$schoolyear->id) }}/{{$term->id}}/{{$reg_student->student->id}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;edit HRecord</a></strong>
                                     
                                      </td>

                                      <td>
                                      @foreach($hrecords as $hrecord)
                                        @if($hrecord->student_id == $reg_student->student->id && $term->id == $hrecord->term_id)
                                          <strong>
                                          <a href="{{asset('/healthrecords/posthrecorddelete/'.Crypt::encrypt($hrecord->id)) }}" onclick="return confirm('Are you sure you want to Delete this record?')" >
                                          <i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;
                                          Delete HRecord
                                          </a>
                                          </strong>
                                        @endif
                                      @endforeach
                                      </td>
                                    </tr>

                                    
                                                                       
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
