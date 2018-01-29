@extends('admin.dashboard')

@section('content')

                                   
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>
                <div class="row">

                  @include('flash::message')
                  <hr>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Adding Event</h4>
                                <p class="category">Group Name: {{@$group->name}}</p>
                                <p class="category">Term: {{@$term->term}}</p>
                            </div>
                              <hr>
                            <div class="bootstrap-iso">
                            <div class="content">
                              <form class="form-group" action="{{ url('/groupevents/postgroupevent', [Crypt::encrypt($group->id), Crypt::encrypt($term->id)]) }}" method="POST">
                              {{ csrf_field() }}
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>Group: {{@$group->name}} </strong></label>
                                                  <input type="hidden" class="form-control border-input" name="group_id" value="{{@$group->id}}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>Term: {{@$term->term}}</strong></label>
                                                  <input type="hidden" class="form-control border-input" name="term_id" value="{{@$term->id}}" >
                                              </div>
                                          </div>
                                        </div> 
                                      
                                        <hr>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label>Event Type</label>
                                                  <input type="text" name="type" class="form-control border-input" required="required" placeholder="eg. Exam, Sport, Excursion">
                                              </div>
                                          </div>


                                      </div>
                                      <div class="row">
                                          

                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label>Event Description</label>
                                                  <textarea class="form-control" id="exampleTextarea" name="description" rows="3"></textarea>
                                              </div>
                                          </div>


                                      </div>

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>Start Date (YYYY-MM-DD) </strong></label>
                                                  <input type="date" class="form-control border-input" name="start_date" placeholder="eg 2017-07-25">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>End Date (YYYY-MM-DD) </strong></label>
                                                  <input type="date" class="form-control border-input" name="end_date" placeholder="eg 2017-07-25">
                                              </div>
                                          </div>
                                        </div> 

                                      
                                        
                                            

                                                                     
                                      <div class="text-center">
                                          <input type="submit" value="Submit">
                                      </div>
                                      <div class="clearfix"></div>
                                  </form>
                                  
                                  <hr>

                                   <br>

                                  <div class="alert-danger">
                            
                                      <ul>
                                        @foreach($errors->all() as $error)

                                          <li> {{ $error }}</li>

                                        @endforeach

                                      </ul>

                                  </div>
                                    
                              </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                </div>
            </div>
        </div>


@endsection
