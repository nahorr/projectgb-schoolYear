				 <div class="panel-body">  
				 <div class="col-md-4 ">

                    
                    <ul class="list-group">
						  <li class="list-group-item justify-content-between list-group-item-success">
						    <h4>Attendance Record</h4>
						    
						  </li>
						  <li class="list-group-item justify-content-between">
						    Times School Opened:
						    <span class="label label-primary pull-right">{{@$attendance}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Times Present:
						    <span class="label label-primary pull-right">{{@$attendance_present}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Times absent:
						    <span class="label label-primary pull-right">{{@$attendance_absent}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Times Late:
						    <span class="label label-primary pull-right">{{@$attendance_late}}</span>
						  </li>
					</ul>
					

                  </div>{{-- biodata-1 --}}
                  
                  <div class="col-md-4">
                       
                       	<ul class="list-group">
						  <li class="list-group-item justify-content-between list-group-item-success">
						    <h4>Health Record</h4>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Student's Weight in kilograms:
						    <span class="label label-primary pull-right">{{ @$health_record->weight }}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Students Height in Meters: 
						    <span class="label label-primary pull-right">{{ @$health_record->height }}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Nurses's Comment: 
						    <span class="label label-primary pull-right">{{@$health_record->comment_nurse}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Doctor's Comment: 
						    <span class="label label-primary pull-right">{{@$health_record->comment_doctor}}</span>
						  </li>

                  </div>{{-- biodata-2 --}}



                  <div class="col-md-4">
                  		<ul class="list-group">
							<li class="list-group-item justify-content-between">
							<h4>OVERALL REMARK</h4>
										    
							</li>
							<li class="list-group-item justify-content-between">
							    <h5>PASSED
											    
									@if( @$course_grade->count() > 0 && ( @$course_grade->sum('total')/@$course_grade->count() ) >= 50 )

									<span class="label label-primary pull-right"> YES </span>
											    
								    @else
											    	
									<span class="label label-primary pull-right"> NO </span>
											    
									@endif


									</span>
								</h5>
							</li>
							
							<li class="list-group-item justify-content-between">
							    <h5>NEXT CLASS
											    
									@if(@$course_grade->count() > 0 &&( @$course_grade->sum('total')/@$course_grade->count() && $term_id == 3 ) >= 50 )

									<span class="label label-primary pull-right"> {{ @$next_group->name}} </span>
											    
								    @else
											    	
									<span class="label label-primary pull-right"> Year not ended </span>
											    
									@endif


									</span>
								</h5>
							</li>
										  
						</ul>
					</div>

                  </div>