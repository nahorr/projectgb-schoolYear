@extends('admin.superadmin.dashboard')

@section('content')
    <div class="page-header">
        <h1>
           Step 4: Add/Edit Courses
           <hr>
            @include('flash::message')
                                            
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-sm-6">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">School Years - Courses</h4>
                    
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                	   <table class="table table-striped table-bordered">
                            <thead>
                                <th>#</th>
                                <th>School Year</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Add/Edit</th>
                               
                            </thead>
                            <tbody>

                                @foreach ($schoolyears as $key=>$schoolyear)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if ($today->between($schoolyear->start_date, $schoolyear->show_until ))
                                            <span style="color: green; font-weight: bold;">Current Year:</span> {{ $schoolyear->school_year }}
                                        @else
                                            {{ $schoolyear->school_year }}
                                        @endif
                                    </td>
                                    <td>{{ $schoolyear->start_date->toFormattedDateString() }}</td>
                                    <td>{{ $schoolyear->end_date->toFormattedDateString() }}</td>
                                     <td><strong><a href="{{asset('/schoolsetup/showcoursesterms/'.$schoolyear->id) }}"><button type="button" class="btn btn-primary">Add/Edit Courses</button></a></strong>
                                    </td>
                                </tr>

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
