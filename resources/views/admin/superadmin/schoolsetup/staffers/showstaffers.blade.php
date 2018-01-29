@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>Add/Edit/Upload Teacher(Staffer)</h1>
                             @include('flash::message')
                           <hr>
                               
                                <h2> <i class="ace-icon fa fa-cloud-upload fa-2x"></i>
                                 Upload Staffers
                                </h2>
                               <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('/schoolsetup/staffers/importstaffers') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

                                    <input type="file" name="import_file" />
                                    {{ csrf_field() }}
                                    <br/>

                                    <button class="btn btn-primary">Upload Teachers/Staffers</button>

                                </form>
                                <br/>
                              
                               <h1>
                               <strong><a href="{{asset('/schoolsetup/staffers/addstaffer')}}">
                                 <i class="ace-icon fa fa-plus-circle fa-2x"></i>
                                    Add Teacher(Staffer)
                                </a></strong>
                                </h1>
                               <hr>

                               <div class="row">
                                  <div class="col-md-12">
                                  <div class="alert alert-info">
                                    <h5 style=""><strong>Download sample file to use as template to upload <strong style="color: #FF0000;"> Teachers and other Staff</strong> members. </strong><a href="{{ URL::to( '/sample-files/sample-staffers-upload.ods')  }}" target="_blank"><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><strong style="color: #FF0000">Sample Staffers/Teachers File</strong></a></h5>
                                    Please use <strong style="color: #FF0000;">open office</strong> for best result. Excel may throw some errors due to white spaces.
                                  </div>
                                  </div>
                                </div>
                               
                                                                
                           
                        </div><!-- /.page-header -->
                         <div class="row">
                          <div class="col-md-12">
                          <div class="alert alert-info">
                            <h5><strong>Teacher Uploaod info!</strong> You will need to add group_id for each teacher. Group id can be found here: <strong><a href="{{asset('schoolsetup/showgroups')}}"><i class="ace-icon fa fa-hand-o-right fa-2x"></i>View Group</a></strong></h5>
                          
                          </div>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing all Teachers(Staffers)  </h4>
                                        <span class="widget-toolbar">
                                            <a href="">
                                                <i class="ace-icon fa fa-users"></i>
                                                of Teachers(Staffers): {{$staffers_count}}
                                            </a>

                                        </span>
                                                    
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                        <div class="table-responsive">

                                    	   <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>Registration Code</th>
                                                    <th>Title</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Gender</th>
                                                    <th>Status</th>
                                                    <th>Nationality</th>
                                                    <th>ID Card #</th>
                                                    <th>Passport # </th>
                                                    <th>Phone</th>
                                                    <th>State</th>
                                                    <th>Address</th>
                                                    <th>Date Employed</th>
                                                    <th>Group</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>

                                                   
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($staffers_groups as $staffer)

                                                    <tr>
                                                        <td>{{ $staffer->registration_code }}</td>
                                                        <td>{{ $staffer->title }}</td>
                                                        <td>{{ $staffer->first_name }}</td>
                                                        <td>{{ $staffer->last_name }}</td>
                                                        <td>{{ $staffer->gender }}</td>
                                                        <td>{{ $staffer->employment_status }}</td>
                                                        <td>{{ $staffer->nationality }}</td>
                                                        <td>{{ $staffer->national_card_number }}</td>
                                                        <td>{{ $staffer->passport_number }}</td>
                                                        <td>{{ $staffer->phone }}</td>
                                                        <td>{{ $staffer->state }}</td>
                                                        <td>{{ $staffer->current_address }}</td>
                                                        <td>{{ $staffer->date_of_employment }}</td>
                                                        <td>{{ $staffer->name }}</td>

                                                        <td><strong><a href="{{asset('/schoolsetup/staffers/editstaffer/'.$staffer->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true">                                                           
                                                        </i></a></strong>
                                                        </td>
                                                        <td><strong><a href="{{asset('/schoolsetup/staffers/poststafferdelete/'.$staffer->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="fa fa-trash fa-2x" aria-hidden="true">                                                           
                                                        </i></a></strong>
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
