@extends('admin.superadmin.dashboard')

@section('content')



    <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title" style="color: darkred"><strong>Edit Currrent Registration for {{$registration->staffer->first_name}} {{$registration->staffer->last_name}} </strong></h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                    	<form class="form-group" method="POST" action="{{ url('/schoolsetup/staffers/posteditregisterstaffer',[$registration->id] ) }}">
                                {{ csrf_field() }}
                         

                          	<div class="row">
                                <div class="form-group col-md-4" style="display: none;">
                                  <label for="Name">School Year ID:</label>
                                  <input type="hidden" class="form-control" name="school_year_id" id="school_year_id" value="{{ $registration->school_year_id}}">
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-4" style="display: none;">
                                <label for="Club">Term ID:</label>
                                <input type="hidden" class="form-control" name="term_id" id="term_id" value="{{$registration->term_id}}">
                              </div>
                            </div>

                           <div class="row">
                              <div class="form-group col-md-4" style="display: none;">
                                <label for="Club">Staffer ID:</label>
                                <input type="hidden" class="form-control" name="staffer_id" id="staffer_id" value="{{$registration->staffer_id}}">
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
                                          @foreach($current_staffers_registrations as $current_staffer_registration)
	                                           @if($group->id == $current_staffer_registration->group_id)
                                                - Assigned to {{$current_staffer_registration->staffer->first_name}} {{$current_staffer_registration->staffer->last_name}}
                                    
                                              
                                              @endif
	                                        @endforeach

                                          

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
                                        <a href="{{asset('/schoolsetup/staffers/editregisterstaffer/'.$registration->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
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
