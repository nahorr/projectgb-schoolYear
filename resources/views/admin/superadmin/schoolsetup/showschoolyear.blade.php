@extends('admin.superadmin.dashboard')

@section('content')
    
    <div class="page-header">
        <h1>
           Step 1: Edit School Years
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-sm-6">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">School Years
                    <span class="widget-toolbar">
                        <strong><a href="{{asset('/schoolsetup/addschoolyear')}}">
                            <i class="ace-icon fa fa-pencil-square-o fa-2x"></i>
                            Add School Year
                        </a></strong>
                    </span> 
                    </h4>
                    
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                	    <table class="table table-striped table-bordered">
                            <thead>
                                <th>#</th>
                                <th>School Year</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Show Until</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </thead>
                            <tbody>

                                @foreach($schoolyears as $key=>$schoolyear )
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
                                    <td>{{ $schoolyear->show_until->toFormattedDateString() }}</td>
                                    <td><strong><a href="{{asset('/schoolsetup/editschoolyear/'.$schoolyear->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
                                    </td>
                                    <td><strong><a href="{{asset('/schoolsetup/deleteschoolyear/'.$schoolyear->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><button type="button" class="btn btn-danger">Delete</button></a></strong>
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
