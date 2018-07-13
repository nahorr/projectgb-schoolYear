@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>
           Step 5:Add New Students or Register Students for {{$current_school_year->school_year}} School Year
           <div class="pull-right"><a href="{{asset('/schoolsetup/students/addnewstudents') }}"><button type="button" class="btn btn-warning btn-lg"><i class="fa fa-plus"></i>  ADD NEW STUDENTS</button></a></div> 
           <hr>
           <div class="pull-right"><a href="{{asset('/schoolsetup/students/viewallstudents') }}"><button type="button" class="btn btn-info btn-lg"><i class="fa fa-eye"></i>  VIEW ALL STUDENTS</button></a></div> 
            @include('flash::message')
                                            
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-sm-8">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Select a Group to Register Students for {{$current_term->term}} {{ $current_school_year->school_year}} school year.</h4>
                    
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                	   <table class="table table-striped table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Group Name</th>
                                <th># of Registered Students</th>
                                <th>Select a Group</th>
                               
                                
                            </thead>
                            <tbody>
                                @foreach($groups as $key=>$group)
                                   @if($group->name != 'Admin') 
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$group->name}}</td>
                                    <td>{{ $current_students_registrations->where('group_id', '=', $group->id)->count() }}</td>
                                    <td><strong><a href="{{asset('/schoolsetup/students/showregisteredstudents/'.$group->id) }}"><i class="fa fa-check-square fa-2x" aria-hidden="true">
                                        
                                    </i> Select </a></strong>
                                    </td>
                                </tr>
                                @endif      
                             @endforeach
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="hr hr-18 dotted hr-double"></div>
    <br>

	<div class="alert-danger">
		
			<ul>
				@foreach($errors->all() as $error)

					<li> {{ $error }}</li>

				@endforeach

			</ul>

	</div>


@endsection
