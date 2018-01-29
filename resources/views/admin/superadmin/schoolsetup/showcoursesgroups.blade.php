@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>
           {{$schoolyear->school_year}} {{$term->term}} Groups & Courses
           <hr>
            @include('flash::message')
                                            
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-sm-4">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Selct a group from the list below </h4>
                    <span class="widget-toolbar">
                        <strong><a href="{{ URL::previous() }}">
                            <i class="ace-icon fa fa-arrow-left fa-2x"></i>
                            Back
                        </a></strong>
                    </span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                	   <table class="table table-striped table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Group Name</th>
                                <th>Term</th>
                                <th># of Courses</th>
                                <th>Select</th>
                                
                                
                            </thead>
                            <tbody>
                            
                                @foreach ($groups as $key=>$group)
                                    @if($group->name != 'Admin')
                                <tr>
                                    <td>{{ $key}}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $term->term }}</td>
                                    <td>{{$group->courses()->where('term_id', '=', $term->id)->count()}}</td>                                                       
                                    <td><strong><a href="{{asset('/schoolsetup/showcourses/'.$schoolyear->id) }}/{{$term->id}}/{{$group->id}}"><i class="fa fa-check-square fa-2x" aria-hidden="true"></i></a></strong>
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
