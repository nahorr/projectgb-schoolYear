@extends('admin.dashboard')

@section('content')

        <div class="content">
          <div class="container-fluid">
            <div class="row">
                 @include('admin.includes.headdashboardtop')
            </div>
            @include('flash::message')
            <hr>

              <div class="col-md-12">
                  <div class="card">
                      <div class="header">
                          <h4 class="title"><strong>Disciplinary Records for Students in your class</strong></h4>
                          <p class="category">Class: {{$group_teacher->name}} </p>
                      </div>
                      <div class="content">
                       
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                              <th><strong>#</strong></th>
                              <th><strong>Face</strong></th>
                              <th><strong>Student Name</strong></th>
                              <th class="text-center"><strong># of Disciplinary records</strong></th>
                              <th><strong>View/Add Disciplinary Record</strong></th>
                         </thead>
                          <tbody>
                            @foreach ($students_in_group as $key=>$student)
                               
                              
                              <tr>
                                  
                                  <td>{{ $key+1 }}</td>
                                  <td>
                                   
                                    @foreach ($all_user as $user)

                                      @if ($user->registration_code == $student->registration_code)
                                        <img class="avatar border-white" src="{{asset('assets/img/students/'.$user->avatar) }}" alt="..."/>
                                      
                                      @endif
                                     @endforeach 
                                    
                                  </td>
                                  <td>{{$student->first_name}} {{$student-> last_name}}</td>
                                  <td class="text-center">{{$drecords->where('student_id', '=', $student->id)->count()}}</td>
                                 
                                  <td>
                                    <a href="{{ asset('/students/discipline/studentdrecords/'. $student->id) }}"><button type="button" class="btn btn-info">VIEW/ADD RECORD</button></a>
                                  </td>
                                                                   
                              </tr>
                              
                             
                           @endforeach
                              
                          </tbody>
                          </table>
                          <div class="pagination">  </div>
                          </div>
                      </div>
   
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection