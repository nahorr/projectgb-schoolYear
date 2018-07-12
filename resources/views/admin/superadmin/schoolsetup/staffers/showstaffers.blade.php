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

                <hr>

                <div class="row">
                   <div class="col-md-12">
                   <div class="alert alert-info">
                     <h5 style=""><strong>Download sample file to use as template to upload <strong style="color: #FF0000;"> Teachers and other Staff</strong> members. </strong><a href="{{ URL::to( '/sample-files/sample-staffers-upload.ods')  }}" target="_blank"><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><strong style="color: #FF0000">Sample Staffers/Teachers File</strong></a></h5>
                     Please use <strong style="color: #FF0000;">open office</strong> for best result. Excel may throw some errors due to white spaces.
                   </div>
                   </div>
                 </div>

            </form>
            <br/>
          
           <h1>
           <strong><a href="{{asset('/schoolsetup/staffers/addstaffer')}}">
             <i class="ace-icon fa fa-plus-circle fa-2x"></i>
                Add Teacher(Staffer)
            </a></strong>
            </h1>
            <br/>
          
           <h1>
           <strong><a href="{{asset('/schoolsetup/staffers/registerstaffers')}}">
             <i class="ace-icon fa fa-user-plus fa-2x" style="color: darkred"></i>
                <span style="color: darkred">Register Teachers(Staffers)</span>
            </a></strong>
            </h1>
           <hr>

           
          </div>
   

    <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Showing all Teachers(Staffers)  </h4>
                    <span class="widget-toolbar">
                        <a href="">
                            <i class="ace-icon fa fa-users"></i>
                            of Teachers(Staffers): {{$staffers->count()}}
                        </a>

                    </span>
                                
                    
                </div>

                

                <div class="widget-body">
                    <div class="widget-main">
                    <div class="table-responsive">

                	   <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <th>#</th>
                                <th>Registration Code</th>
                                <th>Title</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Status</th>
                                <th>Current Registration Status</th>
                                
                                <th>Staffer Details</th>
                                <th>Make/Remove Super Admin</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              
                                
                            </thead>
                            <tbody>
                                @foreach ($staffers as $key=> $staffer)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><a href="{{asset('/schoolsetup/staffers/stafferdetails/'.$staffer->id) }}">{{ $staffer->registration_code }}</a></td>
                                    <td>{{ $staffer->title }}</td>
                                    <td>{{ $staffer->first_name }}</td>
                                    <td>{{ $staffer->last_name }}</td>
                                    <td>{{ $staffer->employment_status }}</td>                                   
                                    
                                    <td>
                                      @foreach($current_staffers_registrations->where('staffer_id', $staffer->id) as $current_staffer_registration)
                                        <button type="button" class="btn btn-secondary" disabled="">Assigned to: {{$current_staffer_registration->group->name}}</button>
                                      @endforeach
                                    </td>
                                    
                                    <td>
                                      <a href="{{asset('/schoolsetup/staffers/stafferdetails/'.$staffer->id) }}" class="btn btn-warning btn-md" role="button" aria-pressed="true">View</a>
                                    </td>
                                    <td>
                                      @foreach ($admin_users as $admin_user)
                                        @if($staffer->registration_code == $admin_user->registration_code && $admin_user->is_super_admin == 1 && $admin_user->id ==1)
                                            <span style="color: red">GLOBAL SUPER ADMIN - CANNOT BE REMOVED</span>
                                        @elseif($staffer->registration_code == $admin_user->registration_code && $admin_user->is_super_admin == 0)
                                          <form class="form-group" action="{{ url('/schoolsetup/staffers/postremovesuperadmin', [$admin_user->id] )}}" method="POST">
                                          {{ csrf_field() }}
                                          <input id="is_super_admin" name="is_super_admin" type="hidden" value="1">
                                          
                                          <button type="submit" class="btn btn-success">Make {{$admin_user->name}} Super Admin</button>
                                          </form>
                                        @elseif($staffer->registration_code == $admin_user->registration_code && $admin_user->is_super_admin == 1)
                                          <form class="form-group" action="{{ url('/schoolsetup/staffers/postmakesuperadmin', [$admin_user->id] )}}" method="POST">
                                          {{ csrf_field() }}
                                          <input id="is_super_admin" name="is_super_admin" type="hidden" value="0">
                                          
                                          <button type="submit" class="btn btn-danger">Remove {{$admin_user->name}} from Super Admin</button>
                                          </form>
                                      @endif
                                    @endforeach
                                    </td>
                                    <td>
                                      <strong>
                                        <a href="{{asset('/schoolsetup/staffers/editstaffer/'.$staffer->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
                                      </strong>
                                    </td>
                                    <td>
                                      <strong>
                                        <a href="{{asset('/schoolsetup/staffers/poststafferdelete/'.$staffer->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                                      </strong>
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
