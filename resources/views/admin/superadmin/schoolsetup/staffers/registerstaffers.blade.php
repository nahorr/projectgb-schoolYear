@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>Register/Bulk Register Teacher(Staffer)</h1>
         @include('flash::message')
       	<hr>
           
        <h2> <i class="ace-icon fa fa-cloud-upload fa-2x" style="color: darkred"></i>
         <span style="color: darkred">Bulk Register Staffers</span>
        </h2>
       	<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('/schoolsetup/staffers/bulkregisterstaffers') }}" class="form-horizontal" method="post" 	enctype="multipart/form-data">

            <input type="file" name="import_file" />
            {{ csrf_field() }}
            <br/>

            <button class="btn btn-primary">Bulk Register Teachers/Staffers for {{strtoupper($current_term->term)}} {{$current_school_year->school_year}}</button>
           	<hr>
          	<div class="row">
              <div class="col-md-12">
	              <div class="alert alert-info">
	                <h5 style=""><strong>Download sample file to use as template to Bulk Register <strong style="color: #FF0000;"> Teachers</strong>. </strong><a href="{{ URL::to( '/sample-files/sample-stafferrsregistration-upload.ods')  }}" target="_blank"><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><strong style="color: #FF0000">Sample Staffers/Teachers File</strong></a></h5>
	                Please use <strong style="color: #FF0000;">open office</strong> for best result. Excel may throw some errors due to white spaces.
	              </div>
              </div>
        	</div>
        	<div class="row">
              <div class="col-md-12">
	              <div class="alert alert-info">
	                <h5 style=""><strong>Please note:<br>
	                	<strong style="color: #FF0000;"> school_year_id <span style="color: black;">must be equal to</span> {{$current_school_year->id}}</strong>. </strong><br>
	                	<strong style="color: #FF0000;"> term_id <span style="color: black;">must be equal to</span> {{$current_term->id}}</strong>. </strong><br>
	                </h5>
	                <h5 style="">
	                	<strong>Get Staffers ID: <br>
	                		<span style="color: #FF0000;">
	                		@foreach($staffers as $staffer)

	                			{{$staffer->first_name}} {{$staffer->last_name}}: staffer_id is {{$staffer->id}}<br>
	                			
	                		@endforeach
	                		</span>
	                	</strong><br>
	                	<strong>Get Groups ID: <strong style="color: #FF0000;"> Click Here to get list of groups and their ids</strong>. </strong>
	                </h5>
	              </div>
              </div>
        	</div>

        </form>
        <br/>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title" style="color: darkred"><strong>Register a Teacher </strong></h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                    	<form class="form-group" method="POST" action="{{ url('/schoolsetup/staffers/postregisterstaffer' ) }}">
                                {{ csrf_field() }}
                         

                          	<div class="row">
                                <div class="form-group col-md-4" style="display: none;">
                                  <label for="Name">School Year ID:</label>
                                  <input type="hidden" class="form-control" name="school_year_id" id="school_year_id" value="{{ $current_school_year->id}}">
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-4" style="display: none;">
                                <label for="Club">Term ID:</label>
                                <input type="hidden" class="form-control" name="term_id" id="term_id" value="{{$current_term->id}}">
                              </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                  <label for="Name">Staffer ID:</label>
                                 	<select name="staffer_id" class="chosen-select form-control" id="staffer_id" data-placeholder="Select an Teacher..." >
                                        <option selected disabled> Please select one Class</option>
                                            

                                              @foreach($staffers as $staffer)

                                                <option value="{{ $staffer->id }}">

                                                  
                                                  {{$staffer->first_name}} {{$staffer->last_name}}
                                                 
                                                </option>

                                              @endforeach      
                                            
                                    </select>
                                </div>
                            </div>
                                    
	                         <div class="row">
	                             <div class="form-group col-md-5">
	                                <label for="Group">Select a Class(group):</label>
	                                <br>                                                     
	                                <select name="group_id" class="chosen-select form-control" id="group_id" data-placeholder="Select an Class(Group)..." >
	                                    <option selected disabled> Please select one Class</option>
	                                    @foreach($groups as $group)
	                                    	
	                                      <option value="{{ $group->id }}">
	                                        
	                                        {{$group->name}} 

	                                        
	                                    </option>
	                                    	 
	                                    @endforeach
	                                </select>
	                              </div>
	                         </div>
	                                      

	                      
	                     
	                        <button  class="btn btn-success" id="submit">Submit Registration</button>
	                     
	                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

   <hr>

    <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title"><strong>Showing all Teachers(Staffers) Registrations for the current term - {{strtoupper($current_term->term)}} {{$current_school_year->school_year}} </strong></h4>
                    <span class="widget-toolbar">
                        <a href="">
                            <i class="ace-icon fa fa-users"></i>
                            Total # of Registration: {{$current_staffers_registrations->count()}}
                        </a>

                    </span>
                                
                    
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                    <div class="table-responsive">

                	   <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <th>#</th>
                                <th>Title</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Assigned To</th>
                                <th>Edit Registration</th>
                                <th>Delete Registration</th>
                              
                                
                            </thead>
                            <tbody>
                                @foreach ($current_staffers_registrations as $key=> $registration)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $registration->staffer->title }}</td>
                                    <td>{{ $registration->staffer->first_name }}</td>
                                    <td>{{ $registration->staffer->last_name }}</td>
                                    <td>{{ $registration->group->name }}</td>                                   
                              
                                    <td>
                                      <strong>
                                        <a href="{{asset('/schoolsetup/staffers/editstafferregistration/'.$registration->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
                                      </strong>
                                    </td>
                                    <td>
                                      <strong>
                                        <a href="{{asset('/schoolsetup/staffers/postunregisterstaffer/'.$registration->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
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
