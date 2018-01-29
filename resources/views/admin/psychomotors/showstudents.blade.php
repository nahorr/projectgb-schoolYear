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
                            <h4 class="title">Psychomotors</h4>
                                <h4 class="title">You can Add/Edit/Delete Psychomotors here</h4>
                                <p class="category">Class: {{$group_teacher->name}} </p>
                                <p class="category">Term: {{$term->term}} </p>
                            </div>
                            <div class="content">
                            <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>First Name</th>
                                <th>Last name</th>
                                <th>Hand Writting</th>
                                <th>Vabal Fluency</th>
                                <th>Games/Sports</th>
                                <th>Handling of Tools</th>
                                <th>Add</th>
                                <th>Edit</th>
                                <th>Delete</th>

                              </tr>
                            </thead>
                            <tbody>
                                    @foreach($students_in_group as $student)

                                      @foreach ($all_user as $st_user)

                                        @if ($st_user->registration_code == $student->registration_code)

                                                                           
                                    <tr>
                                      
                                      <td>
                                      <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                      {{$student->first_name}}
                                      </td>
                                      <td>{{$student->last_name}}</td>
                                     
                                      <td>
                                      @foreach($psychomotors as $psychomotor)

                                        @if($psychomotor->student_id == $student->id && $term->id == $psychomotor->term_id)

                                           {{$psychomotor->hand_writting}}


                                        @endif

                                      @endforeach
                                     </td>

                                     <td>
                                      @foreach($psychomotors as $psychomotor)

                                        @if($psychomotor->student_id == $student->id && $term->id == $psychomotor->term_id)

                                           {{$psychomotor->vabal_fluency}}


                                        @endif

                                      @endforeach
                                     </td>

                                     <td>
                                      @foreach($psychomotors as $psychomotor)

                                        @if($psychomotor->student_id == $student->id && $term->id == $psychomotor->term_id)

                                           {{$psychomotor->games_sport}}


                                        @endif

                                      @endforeach
                                     </td>


                                     <td>
                                      @foreach($psychomotors as $psychomotor)

                                        @if($psychomotor->student_id == $student->id && $term->id == $psychomotor->term_id)

                                           {{$psychomotor->handling_of_tools}}


                                        @endif

                                      @endforeach
                                     </td>
                                     
                                                                               
                                      <td>

                                      <strong><a href="{{asset('/psychomotors/addpsychomotor/'. Crypt::encrypt($term->id)) }}/{{Crypt::encrypt($student->id)}}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Add</a>
                                     
                                      </td>
                                      <td>

                                      <strong><a href="{{asset('/psychomotors/editpsychomotor/'. Crypt::encrypt($term->id)) }}/{{Crypt::encrypt($student->id)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;edit</a></strong>
                                     
                                      </td>

                                      <td>
                                      @foreach($psychomotors as $psychomotor)
                                        @if($psychomotor->student_id == $student->id && $term->id == $psychomotor->term_id)
                                          <strong>
                                          <a href="{{asset('/psychomotors/postpsychomotordelete/'. Crypt::encrypt($psychomotor->id)) }}" onclick="return confirm('Are you sure you want to Delete this record?')">
                                          <i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;
                                          Delete
                                          </a>
                                          </strong>
                                        @endif
                                      @endforeach
                                      </td>
                                    </tr>
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
