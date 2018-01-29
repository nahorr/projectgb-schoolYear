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
                    <h5><strong>Registration Alert!</strong> If student's face does not display, It means that the student is yet to register. Please remind the student to register.</h5>
                  </div>
                  </div>
                </div>

                 
                <div class="row">

                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Registered and UnRegistered Students in Your class</h4>
                                <p class="category">Teacher Name: <strong>{{@$teacher->first_name}}  {{@$teacher->last_name}}</strong></p>
                                <p class="category">Term: <strong>{{@$term->term}} </strong></p>
                            </div>
                          <div class="content col-xs-12">
                          <div class="table-responsive">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr class="info">
                                <th>#</th>
                                <th>Faces</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Report Card <a href="{{asset('/admin/reportcards/printall/'.$term->id)}}"><br><i class="fa fa-print" aria-hidden="true"></i><strong>Print All</strong></a></th>
                               
                               
                                

                              </tr>
                            </thead>
                            <tbody>
                            
                                @foreach ($students_in_group as $key => $student)
                                   
                               
                                      <tr>

                                        <td>{{$key+1}}</td>
                                        
                                        <td>
                                        @foreach ($all_user as $st_user)
                                            @if ($st_user->registration_code == $student->registration_code)                                    
                                        <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                        @endif    
                                        @endforeach
                                        </td>

                                        <td>{{$student->first_name}}</td>
                                        <td>{{$student->last_name}}</td>
                                        <td>
                                        @foreach ($all_user as $st_user)
                                            @if ($st_user->registration_code == $student->registration_code)
                                            {{$st_user->email}}
                                         @endif    
                                        @endforeach
                                        </td>
                                                                                
                                      <td>
                                      <strong>
                                      <a href="{{asset('/admin/reportcards/print/'.$student->id)}}/{{$term->id}}">
                                      <i class="fa fa-print fa-3x" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;
                                      PRINT{{$student->id}}
                                      </a>
                                      </strong>
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
