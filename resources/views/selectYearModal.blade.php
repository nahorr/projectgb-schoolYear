<!-- Modal -->
<div class="modal fade" id="yearSelectionModal" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please select a School Year</h4>
      </div>
      <div class="modal-body">

        
            <div class="content">

                <div class="row">

               
                    @foreach($school_years as $schoolyear)
                        @if(\App\StudentRegistration::where('school_year_id', $schoolyear->id)->where('student_id', \App\Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->count() > 0)
                            <div class="col-lg-6 col-sm-6">
                              <a href="{{ url('/home/'.$schoolyear->id)}}">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-4">
                                              @if( $schoolyear->id == $current_school_year->id)
                                                <div class="icon-big icon-success text-center">
                                                    <i class="fa fa-university" aria-hidden="true"></i>
                                                </div>
                                                @else
                                                <div class="icon-big icon-warning text-center">
                                                    <i class="fa fa-university" aria-hidden="true"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="numbers">
                                                  @if( $schoolyear->id == $current_school_year->id)
                                                    <p class="text-success"><small>Current School Year</small></p>
                                                    <p class="text-success">{{$schoolyear->school_year}}</p>
                                                    @else
                                                    <p>School Year</p>
                                                    <p>{{$schoolyear->school_year}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr />
                                            <div class="stats">
                                              @if( $schoolyear->id == $current_school_year->id)
                                                
                                                <span class="text-success"> <i class="ti-calendar icon-success"></i> Start Date: {{$schoolyear->start_date->toFormatteddateString()}} <i class="ti-calendar icon-success"></i> End Date: {{$schoolyear->end_date->toFormatteddateString()}}</span>
                                              @else
                                              <span> <i class="ti-calendar icon-warning"></i> Start Date: {{$schoolyear->start_date->toFormatteddateString()}} <i class="ti-calendar icon-warning"></i> End Date: {{$schoolyear->end_date->toFormatteddateString()}}</span>
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </a>
                            </div>
                        @endif
                    @endforeach 

                </div>
            </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
