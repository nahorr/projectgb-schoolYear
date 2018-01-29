@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>
           Step 3: Add/Edit Groups
           <hr>
            @include('flash::message')
                                            
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-sm-4">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Showing All Groups </h4>
                    <span class="widget-toolbar">
                        <strong><a href="{{asset('/schoolsetup/addgroup')}}">
                            <i class="ace-icon fa fa-pencil-square-o fa-2x"></i>
                            Add Group
                        </a></strong>
                    </span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                	   <table class="table table-striped table-bordered">
                            <thead>
                                <th>Group Name</th>
                                <th>Group ID</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)

                                <tr>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->id }}</td>
                                    <td><strong><a href="{{asset('/schoolsetup/editgroup/'.$group->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
                                    </td>
                                    <td><strong><a href="{{asset('/schoolsetup/postgroupdelete/'.$group->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="danger fa fa-trash-o fa-2x" aria-hidden="true" style="color:red"></i></a></strong>
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
