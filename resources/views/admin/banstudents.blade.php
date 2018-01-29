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
                                <h4 class="title">Registered Students in Your class</h4>
                                <p class="category">Teacher Name: <strong>{{@$teacher->first_name}}  {{@$teacher->last_name}}</strong></p>
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
                            
                                @foreach ($students_in_group as $key => $student)
                                  @foreach ($all_user as $st_user)
                                   @if ($st_user->registration_code == $student->registration_code) 
                               
                                      <tr>

                                        <td>{{$key+1}}</td>
                                        
                                        <td>                                    
                                        <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                        </td>

                                        <td>{{$student->first_name}}</td>
                                        <td>{{$student->last_name}}</td>
                                        <td>{{$st_user->email}}</td>
                                                                                
                                      <td>
                                      @if($st_user->status == 1)
                                      <form class="form-group" action="{{ url('/admin/posteditban', [Crypt::encrypt($st_user->id)] )}}" method="POST">
                                      {{ csrf_field() }}
                                      <input id="status" name="status" type="hidden" value="0">
                                      <input type="submit" value="Ban {{$st_user->name}}" style="color: red">
                                      </form>

                                      @else
                                      <form class="form-group" action="{{ url('/admin/posteditunban', [Crypt::encrypt($st_user->id)] )}}" method="POST">
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
