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
                            <h4 class="title">Effective Areas</h4>
                                <h4 class="title">You can Add/Edit/Delete Effective Areas here</h4>
                                <p class="category">Class: {{$group_teacher->name}} </p>
                            </div>
                            <div class="content">
                            <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>First Name</th>
                                <th>Last name</th>
                                <th>Punctuality</th>
                                <th>Creativity</th>
                                <th>Reliability</th>
                                <th>Neatness</th>
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
                                      @foreach($effectiveareas as $effectivearea)

                                        @if($effectivearea->student_id == $student->id && $term->id == $effectivearea->term_id)

                                           {{$effectivearea->punctuality}}


                                        @endif

                                      @endforeach
                                     </td>

                                     <td>
                                      @foreach($effectiveareas as $effectivearea)

                                        @if($effectivearea->student_id == $student->id && $term->id == $effectivearea->term_id)

                                           {{$effectivearea->creativity}}


                                        @endif

                                      @endforeach
                                     </td>

                                     <td>
                                      @foreach($effectiveareas as $effectivearea)

                                        @if($effectivearea->student_id == $student->id && $term->id == $effectivearea->term_id)

                                           {{$effectivearea->reliability}}


                                        @endif

                                      @endforeach
                                     </td>


                                     <td>
                                      @foreach($effectiveareas as $effectivearea)

                                        @if($effectivearea->student_id == $student->id && $term->id == $effectivearea->term_id)

                                           {{$effectivearea->neatness}}


                                        @endif

                                      @endforeach
                                     </td>
                                     
                                                                               
                                      <td>

                                      <strong><a href="{{asset('/effectiveareas/addeffectivearea/'.Crypt::encrypt($term->id)) }}/{{Crypt::encrypt($student->id)}}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Add</a>
                                     
                                      </td>
                                      <td>

                                      <strong><a href="{{asset('/effectiveareas/editeffectivearea/'. Crypt::encrypt($term->id)) }}/{{Crypt::encrypt($student->id)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;edit</a></strong>
                                     
                                      </td>

                                      <td>
                                      @foreach($effectiveareas as $effectivearea)
                                        @if($effectivearea->student_id == $student->id && $term->id == $effectivearea->term_id)
                                          <strong>
                                          <a href="{{asset('/effectiveareas/posteffectiveareadelete/'. Crypt::encrypt($effectivearea->id)) }}" onclick="return confirm('Are you sure you want to Delete this record?')">
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
