
@extends('admin.dashboard')

@section('content')

	<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="header">
              <h4 class="title"><strong>Add Comment for {{ $student->first_name }} {{ $student->last_name }}</strong> <a class="pull-right"> {{ $group->name }}- {{$term->term}} </a></h4> 
            </div>
            <hr style="border-color: #fff;">

          			<form class="form-group" action="{{ url('postComment')}}" method="POST">
          					{{ csrf_field() }}
          				<table class="table text-center table-responsive">
                    <thead>
                        <th class="text-center"><strong>Student Name</strong></th>
                        <th class="text-center"><strong>{{$term->term}} Comment</strong></th>
                    </thead>
                    <tbody>
                      <tr>
                      	<td>
                          	<label>
                              @foreach ($all_user as $st_user)

                                @if ($st_user->registration_code == $student->registration_code)

                                  
                                    <strong>
                                    <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                    {{$student->first_name}} {{$student->last_name}} 
                                    </strong>
                                @endif
                              @endforeach
                            </label>
                          	<input id="student_id" name="student_id" type="hidden" value="{{$student->id}}">
                          </td>
                          <td style="display: none">
                          	<input id="term_id" name="term_id" type="hidden" value="{{$term->id}}">
                          </td>
                          <td>

                          <div class="form-group">
												    <label for="exampleTextarea">Enter Comment for {{ $student->first_name }} {{ $student->last_name }}</label>
												    <textarea class="form-control" name="comment_teacher" id="comment_teacher" rows="3"></textarea>
											    </div>

                          </td>
                          
                          <td><input type="submit" value="Submit"></td>
                      </tr>
                    </tbody>
                  </table>
          			</form>

                <br>

        				<div class="alert-danger">
        					
        						<ul>
        							@foreach($errors->all() as $error)

        								<li> {{ $error }}</li>

        							@endforeach

        						</ul>

        				</div>
          </div>
        </div>
      </div>
    </div>
  </div>    
    
@endsection
