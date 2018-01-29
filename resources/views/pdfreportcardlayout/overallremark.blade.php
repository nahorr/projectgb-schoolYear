				                      
                       
                         <table class="table table-bordered table-hover"> 
                                <tbody>
                        
	                              <tr>
	                                    
	                                    <td>
	                                    <ul class="list-group">
										  <li class="list-group-item justify-content-between">
										    <h4>OVERALL REMARK</h4>
										    
										  </li>
										  <li class="list-group-item justify-content-between">
										    <h5>PASSED
										    
										    @if( ( $course_grade->sum('total')/$course_grade->count() ) >= 50 )

										        <span class="label label-primary pull-right"> YES </span>
										    
										    @else
										    	
										    	<span class="label label-primary pull-right"> NO </span>
										    
										    @endif


										    </span>
										    </h5>
										  </li>
										  
										</ul>
										</td>
	                                    
	                                </tr>    
                          
                        		</tbody>
                         </table>
                       
               