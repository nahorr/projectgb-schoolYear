@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>
           Bulk upload {{$schoolyear->school_year}} {{$term->term}} Courses - All Groups
            @include('flash::message')
                                            
        </h1>
         <br>
        <div class="row">
              <div class="col-md-12">
                <div class="alert alert-info">
                <h5 style="">
                  <strong>Downlod Staffers and Registration Codes: <br>

                  <a href="{{ URL::to('/schoolsetup/staffers/downloadExcelStaffers/xls') }}"><button class="btn btn-success">Download Staffers xls</button></a>
                  <a href="{{ URL::to('/schoolsetup/staffers/downloadExcelStaffers/xlsx') }}"><button class="btn btn-success">Download Staffers xlsx</button></a>
                  <a href="{{ URL::to('/schoolsetup/staffers/downloadExcelStaffers/csv') }}"><button class="btn btn-success">Download Staffers CSV</button></a>

                      
                </strong><br><br>
                <strong>Download Groups and Group Names: <br>
                  <a href="{{ URL::to('/schoolsetup/staffers/downloadExcelGroups/xls') }}"><button class="btn btn-danger">Download Groups xls</button></a>
                  <a href="{{ URL::to('/schoolsetup/staffers/downloadExcelGroups/xlsx') }}"><button class="btn btn-danger">Download Groups xlsx</button></a>
                  <a href="{{ URL::to('/schoolsetup/staffers/downloadExcelGroups/csv') }}"><button class="btn btn-danger">Download Groups CSV</button></a>
                   
                </strong>
              </h5>
                </div>
              </div>
          </div>
        <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('/schoolsetup/showcoursesgroups/bulkuploadcourses', [$schoolyear->id, $term->id] ) }}" class="form-horizontal" method="post" enctype="multipart/form-data">

             <input type="file" name="import_file" />
             {{ csrf_field() }}
             <br/>

             <button class="btn btn-primary">Bulk Upload {{$schoolyear->school_year}} {{$term->term}} Courses</button>

         </form>
         <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-info">
                  <h5 style=""><strong>Download sample file to use as template to Bulk Upload <strong style="color: #FF0000;"> Courses</strong>. </strong><a href="{{ URL::to( '/sample-files/sample-BULK_courses-upload.ods')  }}" target="_blank"><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><strong style="color: #FF0000">Sample Bulk Upload Courses File</strong></a></h5>
                  Please use <strong style="color: #FF0000;">open office</strong> for best result. Excel may throw some errors due to white spaces.
                </div>
              </div>
          </div>

    </div><!-- /.page-header -->

    <h1 class="display-1">OR</h1>

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
