				 <div class="panel-body">  
				 <div class="col-md-4 ">

                    
                    <ul class="list-group">
						  <li class="list-group-item justify-content-between">
						    Name:&nbsp;&nbsp;
						    <span>{{Auth::user()->name}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Age
						    <span class="badge badge-default badge-pill">{{ $student->dob->diffInYears($today) }}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Admission #: 
						    <span class="badge badge-default badge-pill">{{ $student->registration_code }}</span>
						  </li>
					</ul>
					

                  </div>{{-- biodata-1 --}}
                  <div class="col-md-4 ">
                       
                       	<ul class="list-group">
						  <li class="list-group-item justify-content-between">
						    Sex:
						    <span class="badge badge-default badge-pill">{{ $student->gender}}</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    # of students in class:
						    <span class="badge badge-default badge-pill">2</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Admission Date: 
						    <span class="badge badge-default badge-pill">{{ $student->date_enrolled }}</span>
						  </li>
					</ul>

                  </div>{{-- biodata-2 --}}
                  <div class="col-md-4 ">
                       
                       	<ul class="list-group">
						  <li class="list-group-item justify-content-between">
						    Teacher:&nbsp;&nbsp;
						    <span >Nnamdi Okeke</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Class:
						    <span class="badge badge-default badge-pill">2</span>
						  </li>
						  <li class="list-group-item justify-content-between">
						    Overall &#37;: 
						    <span class="badge badge-default badge-pill">1</span>
						  </li>

                  </div>{{-- biodata-2 --}}
                  </div>