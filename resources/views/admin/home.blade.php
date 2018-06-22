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
                    <h5><strong>Add, Edit, or Delete {{@$current_term->term}} comments here!</strong><br> You can add, edit, or delete current term's comment for students in your <strong>class</strong>. <br>Just click on Add or Edit or Delete icon beside the student you wish to add, edit, or delete comments for.<br> <strong>These commenets will appear on students' <strong>{{@$current_term->term}}<strong> report card.</strong></h5>
                  </div>
                  </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Students in Your class</h4>
                                <p class="category">You have 
                              @if( $current_registration_teacher)

                                  {{ $registrations_students->where('school_year_id', '=', $current_school_year->id)->where('group_id', '=', $current_registration_teacher->group_id)->count() }}
                                     
                              @else
                                0
                              @endif 

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
                                <th>Teacher's Comment - {{ @$current_term->term }}</th>
                                <th>Add/Edit/Delete</th>
                                <th>Reg Code <a href="{{asset('/admin/printallregcode/')}}" target="_blank" ><br><i class="fa fa-print" aria-hidden="true"></i>Print All</a> </th>
                               
                                

                              </tr>
                            </thead>
                            <tbody> 
                                                          
                                @foreach ($registrations_students as $key => $reg_student)

                                  @if( $current_registration_teacher)

                                  @if($reg_student->school_year_id == $current_school_year->id && $reg_student->group_id == $current_registration_teacher->group_id)                             
                                                                             
                                    <tr>

                                      <td>{{$number_init++}}</td>
                                      
                                      <td>
          
                                     
                                      @foreach ($all_users as $st_user)
                                        @if($st_user->registration_code == $reg_student->student->registration_code)

                                          <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                      
                                        @endif
                                      @endforeach

                                       </td>
                                      <td>{{$reg_student->student->first_name}}</td>
                                      <td>{{$reg_student->student->last_name}}</td>
                                      <td>
                                        @foreach ($comments as $comment) 
                                          @if ($comment->student_id == $reg_student->student->id && $comment->term_id == $current_term->id) 
                                                  
                                                  {{$comment->comment_teacher}}
                                          @endif
                                        @endforeach 
                                           
                                      </td>
                                                                              
                                    <td>
                                    
                                    <strong>
                                      <a href="{{asset('/addComment/'.Crypt::encrypt($reg_student->student->id)) }}/{{Crypt::encrypt($current_term->id)}}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i>{{$current_term->id}}</a>&nbsp;

                                      
                                      @foreach ($comments as $comment)                                       
                                           
                                        @if ($comment->student_id == $reg_student->student->id && $comment->term_id == $current_term->id)

                                          <a href="{{asset('/editComment/'.Crypt::encrypt($comment->id))}}/{{Crypt::encrypt($comment->student_id)}}">
                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                          </a>&nbsp;

                                          <a href="{{asset('/postcommentdelete/'.Crypt::encrypt($comment->id)) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                          </a>&nbsp;
                                          @endif
                                      @endforeach

                                    </strong>
                                    </td>
                                    <td>{{@$reg_student->student->registration_code}} <a href="{{asset('/admin/printregcode/'.$reg_student->student->id)}}" target="_blank" ><i class="fa fa-print" aria-hidden="true"></i>print</a>
                                    </td>   
                                
                                 @endif
                              @endif   
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
