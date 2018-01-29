				 <div class="panel-body">
					 <div class="col-md-4">
	                       
	                       <div class="well"><strong>Next Term Begins:</strong>
	                       @foreach($terms as $term)

	                    
		                       	

		                       	@if( $term->id == $term_id+1 )

		                       		<i><u>{{ $term->start_date->toFormattedDateString() }}</u></i>

		                       	
		                       	@endif

	                       
	                       @endforeach

	                        
	                       </div>



	                  </div>{{-- footer-1 --}}

	                  <div class="col-md-4">
	                       
	                      <div class="well"><strong>Report Card reviewed by:</strong>

	                      <i><u>{{$student_teacher->first_name }}&nbsp;&nbsp;{{ $student_teacher->last_name }}</u></i>

	                      </div>

	                  </div>{{-- footer-2 --}}


	                  <div class="col-md-4">
	                       
	                      <div class="well"><strong>Date of Submission:</strong>

	                      <i><u>{{ $today->toFormattedDateString() }}</u></i>

	                      </div>

	                  </div>{{-- footer-3 --}}
	             </div>