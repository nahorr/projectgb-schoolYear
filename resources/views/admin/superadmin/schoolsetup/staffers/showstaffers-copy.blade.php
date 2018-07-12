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
        <h5><strong>List of all Teachers in your school.</strong> You can add or upload teachers here.<strong><a href="{{asset('schoolsetup/showgroups')}}"><i class="ace-icon fa fa-hand-o-right fa-2x"></i>View Group</a></strong></h5>
      
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
                                    
                                    
                                        @foreach($current_staffers_registrations as $current_staffer_registration)

                                            @if($current_staffer_registration->staffer_id == $staffer->id)


                                                <button type="button" class="btn btn-secondary" disabled="">Assigned to: {{$current_staffer_registration->group->name}}</button>
                                                <button type="button" class="btn btn-info">Edit Registration</button>
                                       
                                                

                                                @elseif(!$current_staffer_registration->staffer_id == $staffer->id)

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="open">Register {{$staffer->first_name}} {{$staffer->last_name}} This Term</button>
                                            

                                   

                                  
                                          <form class="form-group" method="POST" action="{{ url('/schoolsetup/staffers/postregisterstaffer', [$staffer->id] ) }}" id="form">
                                                {{ csrf_field() }}
                                              <!-- Modal -->
                                              <div class="modal" tabindex="-1" role="dialog" id="myModal">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="alert alert-danger" style="display:none"></div>

                                                  <div class="modal-header">
                                                    
                                                    <h5 class="modal-title">Register {{$staffer->first_name}} {{$staffer->last_name}} for {{$current_term->term}} - {{$current_school_year->school_year}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>

                                                  <div class="modal-body">

                                                    <div class="row">
                                                        <div class="form-group col-md-4" style="display: none;">
                                                          <label for="Name">Staffer ID:</label>
                                                          <input type="hidden" class="form-control" name="staffer_id" id="staffer_id" value="{{$staffer->id}}">
                                                        </div>
                                                    </div>
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
                                                         <div class="form-group col-md-12">
                                                            <label for="Group">Select a Class(group):</label>
                                                            <br>                                                     
                                                            <select name="group_id" class="chosen-select form-control" id="group_id" data-placeholder="Select an Class(Group)..." >
                                                                <option selected disabled> Please select one Class</option>
                                                                    

                                                                      @foreach($groups as $group)

                                                                       

                                                                        <option value="{{ $group->id }}">
                                                                          @if($group->id == $current_staffer_registration->group_id)
                                                                            Assigned to {{$current_staffer_registration->staffer->first_name}} {{$current_staffer_registration->staffer->last_name}}
                                                                          @else
                                                                          {{$group->name}}
                                                                          @endif
                                                                        </option>
                                                                      @endforeach      
                                                                    
                                                            </select>
                                                          </div>
                                                      </div>
                                                      
                                                  </div>

                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button  class="btn btn-success" id="ajaxSubmit">Submit Registration</button>
                                                  </div>

                                                </div>
                                              </div>
                                            </div>
                                        </form>

                                     
                                     @endif
                                  @endforeach
                                    </td>
                                    <td><a href="{{asset('/schoolsetup/staffers/stafferdetails/'.$staffer->id) }}" class="btn btn-warning btn-md" role="button" aria-pressed="true">View</a></td>
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

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
    </script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script>
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/schoolsetup/staffers/postregisterstaffer', [$staffer->id] ) }}",
                  method: 'post',
                  data: {
                     staffer_id: jQuery('#staffer_id').val(),
                     school_year_id: jQuery('#school_year_id').val(),
                     term_id: jQuery('#term_id').val(),
                     group_id: jQuery('#group_id').val(),
                  },
                  success: function(result){
                    if(result.errors)
                    {
                        jQuery('.alert-danger').html('');

                        jQuery.each(result.errors, function(key, value){
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append('<li>'+value+'</li>');
                        });
                    }
                    else
                    {
                        jQuery('.alert-danger').hide();
                        $('#open').hide();
                        $('#myModal').modal('hide');
                    }
                  }});
               });
            });
      </script>



@endsection
