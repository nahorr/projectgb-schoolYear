				
					 	    @if($comment_all === null )           
	                 		
							<div class="well well-lg">
	                      		
	                      		<strong>CLASS TEACHEAR'S COMMENT:</strong> <span> <i></i></span>
	                      		
	                      		<hr>

	                      		<p> <strong>DATE:</strong> <i><u></u></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>SIGNATURE:</strong>__________________ </p>


	                       </div>

	                       @else            
	                 
	                       
	                      <div class="well well-lg">
	                      		
	                      		<strong>CLASS TEACHEAR'S COMMENT:</strong> <span> <i>{{ $comment_all->comment_teacher }}</i></span>
	                      		
	                      		<hr>

	                      		<p> <strong>DATE:</strong> <i><u>{{ $comment_all->created_at->toFormattedDateString() }}</u></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>SIGNATURE:</strong>__________________ </p>


	                      </div>

	                 	@endif
	                  
	                  