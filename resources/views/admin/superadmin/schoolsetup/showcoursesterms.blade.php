@extends('admin.superadmin.dashboard')

@section('content')


            <div class="page-header">
                <h1>
                   Step 4: Add/Edit Courses
                   <hr>
                   <strong>
                        <i class="ace-icon fa fa-university fa-2x"></i>
                        School Year: {{$schoolyear->school_year}}
                    </strong>
                    @include('flash::message')
                                                    
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Select a term from the list below </h4>
                            <span class="widget-toolbar">
                                <strong>
                                    <a href="{{ URL::previous() }}">
                                        <i class="ace-icon fa fa-arrow-left fa-2x"></i>
                                        Back
                                    </a>
                                </strong>
                            </span>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">

                        	   <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>Term</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Show Until</th>
                                        <th>Select Term</th>
                                        

                                    </thead>
                                    <tbody>
                                        @foreach ($terms_schoolyear as $term)

                                        <tr>
                                            <td>{{ $term->term }}</td>
                                            <td>{{ $term->start_date->toFormattedDateString() }}</td>
                                            <td>{{ $term->end_date->toFormattedDateString() }}</td>
                                            <td>{{ $term->show_until->toFormattedDateString() }}</td>
                                            <td><strong><a href="{{asset('/schoolsetup/showcoursesgroups/'.$schoolyear->id) }}/{{$term->id}}"><i class="fa fa-check-square fa-2x" aria-hidden="true"></i> select</a></strong>
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
