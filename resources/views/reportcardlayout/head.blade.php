				 
				 <div class="row">
				 <div class="col-md-3 ">
                       
                      <div class="header text-center">
                       		
						     <img src="{{asset('/assets/img/logo/logo.jpg')}}" style="width: 150px; height: 150px; border-radius: 50%; margin-right: 25px;"> 
						    						   
					  </div>

                  </div>{{-- head-1 --}}
                  <div class="col-md-6 ">
                       
                       	<div class="header text-center">
                       		
						    <h1>Socidy International School</h1> 
						    <p>55 Westlynn Spur, Claresholm, Alberta T0L 0T0</p> 
						    <p>Phone:&nbsp; +1-403-402-2387 &nbsp; Email:&nbsp; nnamdi@socidy.com</p> 
						    <p>END OF TERM REPORT</p> 
						    <p>{{ $school_year->school_year}} &nbsp; SESSION</p>
						    <p>{{ $term->term }}</p> 
						   
					   	</div>

                  </div>{{-- head-2 --}}
                  <div class="col-md-3 ">
                       
                       	<div class="header text-center">
                       		
						    <img src="{{asset('/assets/img/students/'.Auth::user()->avatar )}}" style="width: 150px; height: 150px; border-radius: 50%; margin-right: 25px;">
						  
						   						   
					   	</div>

                  </div>{{-- head-2 --}}
                 </div>