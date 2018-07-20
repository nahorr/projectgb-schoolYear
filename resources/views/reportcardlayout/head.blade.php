				 
				 <div class="row">
				 <div class="col-md-3 ">
                       
                      <div class="header text-center">
                       		
						     <img src="{{asset('/assets/img/logo/logo.jpg')}}" style="width: 150px; height: 150px; border-radius: 50%; margin-right: 25px;"> 
						    						   
					  </div>

                  </div>{{-- head-1 --}}
                  <div class="col-md-6 ">
                       
                       	<div class="header text-center">
                       		
						    <h1>{{$school->name}}</h1> 
						    <p>{{$school->address}}, {{$school->city}}, {{$school->state}} {{$school->postal_code}}</p> 
						    <p>Phone:&nbsp; {{$school->phone}} &nbsp; Email:&nbsp; {{$school->email}}</p> 
						    <p>END OF TERM REPORT</p> 
						    <p>{{ $schoolyear->school_year}} &nbsp; SESSION</p>
						    <p>{{ $term->term }}</p> 
						   
					   	</div>

                  </div>{{-- head-2 --}}
                  <div class="col-md-3 ">
                       
                       	<div class="header text-center">
                       		
						    <img src="{{asset('/assets/img/students/'.Auth::user()->avatar )}}" style="width: 150px; height: 150px; border-radius: 50%; margin-right: 25px;">
						  
						   						   
					   	</div>

                  </div>{{-- head-2 --}}
                 </div>