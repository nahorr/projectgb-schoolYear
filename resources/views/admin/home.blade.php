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
                  <div class="alert alert-warning">
                    <h5><strong>Add, Edit, or Delete {{@$current_term}} comments here!</strong><br> You can add, edit, or delete current term's comment for students in your <strong>class</strong>. <br>Just click on Add or Edit or Delete icon beside the student you wish to add, edit, or delete comments for.<br> <strong>These commenets will appear on students' <strong>{{@$current_term}}<strong> report card.</strong></h5>
                  </div>
                  </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Students in Your class</h4>
                                <p class="category">You have {{ $students_in_teacher_current_group->count() }} students in your class</p>
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
                                <th>Teacher's Comment - {{ @$current_term }}</th>
                                <th>Add/Edit/Delete</th>
                                <th>Reg Code <a href="{{asset('/admin/printallregcode/')}}"><br><i class="fa fa-print" aria-hidden="true"></i>Print All</a> </th>
                               
                                

                              </tr>
                            </thead>
                            <tbody>
                            
                                @foreach ($students_in_teacher_current_group as $key => $student)

                                  @foreach ($terms as $term)

                                    @if($today->between($term->start_date, $term->show_until))

                                    <tr>

                                        <td>{{$key+1}}</td>
                                        
                                        <td>
                                        
                                        @foreach ($all_users as $st_user)

                                         @if ($st_user->registration_code == $student->registration_code)
                                           <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                        
                                          @endif
                                        @endforeach 

                                         </td>
                                        <td>{{$student->first_name}}</td>
                                        <td>{{$student->last_name}}</td>
                                        <td>
                                        @foreach ($comment_current_term as $comments)

                                              @if ($comments->student_id == $student->id)
                                                  {{$comments->comment_teacher}}
                                              @endif
                                          @endforeach
                                        </td>
                                                                                
                                      <td>
                                      
                                      <strong><a href="{{asset('/addComment/'.Crypt::encrypt($student->id)) }}/{{Crypt::encrypt($term->id)}}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i>{{$term->id}}</a>&nbsp;
                                      @foreach ($comment_current_term as $comments)

                                              @if ($comments->student_id == $student->id)
                                      <a href="{{asset('/editComment/'.Crypt::encrypt($student->id)) }}/{{Crypt::encrypt($term->id)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>&nbsp;
                                      <a href="{{asset('/postcommentdelete/'.Crypt::encrypt($comments->id)) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>&nbsp;
                                              @endif
                                      @endforeach
                                      </td>
                                      <td>{{@$student->registration_code}} <a href="{{asset('/admin/printregcode/'.$student->id)}}"><i class="fa fa-print" aria-hidden="true"></i>print</a>
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
