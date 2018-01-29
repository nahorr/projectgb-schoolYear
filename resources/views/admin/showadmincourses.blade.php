@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>

                <div class="row">

                    <div class="col-md-5">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>{{ strtoupper($term->term) }} COURSES</strong></h4>
                                <p class="category"> <i class="fa fa-circle text-danger"></i> <strong>My Class:</strong> {{ $group_teacher->name }}</p>
                            </div>

                                <div class="content">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <th class="text-center"><strong>Course Code</strong></th>
                                            <th class="text-center danger"><strong>Course Name</strong></th>
                                            <th class="text-center"><strong>Add/Edit Grades</strong></th>

                                        </thead>
                                        <tbody>
                                            @foreach ($term_courses as $course)

                                            <tr>
                                                
                                                <td>{{ $course->course_code }}</td>
                                                <td class="danger">{{ $course->name }}</td>
                                                
                                                <td>
                                                    <strong>
                                                        <a href="{{asset('/showstudentcoursesgrades/'.Crypt::encrypt($course->id)) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Add/Edit Grades</a>
                                                    </strong>
                                                </td>
                                               
                                            </tr>
                                         @endforeach
                                            
                                        </tbody>
                                    </table>

                                    <div class="footer">
                                       
                                        <hr>
                                        
                                        <div class="stats">
                                            <i class="ti-timer"></i> These course are for the class you are responsible for this term. You can add/edit or delect students grades.
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong> {{ strtoupper($term->term) }} COURSE</strong></h4>
                                <p class="category"> <i class="fa fa-circle text-success"></i> <strong>Course am teaching this term.</strong></p>
                            </div>

                                <div class="content">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <th class="text-center"><strong>Course Code</strong></th>
                                            <th class="text-center success"><strong>Course Name</strong></th>
                                            <th class="text-center success"><strong>Class Name</strong></th>
                                            <th class="text-center"><strong>Add/Edit Grades</strong></th>

                                        </thead>
                                        <tbody>
                                            @foreach ($assigned_term_courses as $course)

                                            <tr>
                                                
                                                <td>{{ $course->course_code }}</td>
                                                <td class="success">{{ $course->name }}</td>
                                                <td class="success">
                                                    @foreach($groups as $group)
                                                        @if($course->group_id == $group->id)
                                                            {{ $group->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <strong>
                                                        <a href="{{asset('/showstudentcoursesgrades/'.Crypt::encrypt($course->id)) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Add/Edit Grades</a>
                                                    </strong>
                                                </td>
                                               
                                            </tr>
                                         @endforeach
                                            
                                        </tbody>
                                    </table>

                                    <div class="footer">
                                       
                                        <hr>
                                        
                                        <div class="stats">
                                            <i class="ti-timer"></i> Above are courses you are assigned to teach this term. You can add students grades after each exam or test.
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

       
@endsection
