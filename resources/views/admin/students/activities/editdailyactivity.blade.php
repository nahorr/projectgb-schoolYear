@extends('admin.dashboard')

@section('content')

        <div class="content">
          <div class="container-fluid">
            <div class="row">
                 @include('admin.includes.headdashboardtop')
            </div>
            <div class="row">

              <div class="col-md-6 col-md-offset-3">
                  <div class="card">
                      <div class="header">
                          <h4 class="title">Adding Daily Activty
                             <div class="pull-right"><a href="{{asset('/students/activities/dailyactivities')}}"><button type="button" class="btn btn-primary">Back to Daily Activities </button></a></div>
                          </h4>
                          <p class="category">Class: {{$group_teacher->name}} </p>
                      </div>
                      <div class="content">
                        <form class="form-group" action="{{ url('/students/activities/posteditdailyactivity', [$daily_activity->id]) }}" method="POST">
                              {{ csrf_field() }}
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                @foreach($terms as $term)
                                                  @if ($today->between($term->start_date, $term->show_until ))
                                                  <label><strong>TERM: {{strtoupper($term->term)}} </strong></label>
                                                  <input type="hidden" class="form-control border-input" name="term_id" value="{{$term->id}}">
                                                   @endif
                                                @endforeach
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="pull-right"><strong>CLASS: {{strtoupper($group_teacher->name)}}</strong></label>
                                                  <input type="hidden" class="form-control border-input" name="group_id" value="{{$group_teacher->id}}" >
                                              </div>
                                          </div>
                                        </div> 
                                      
                                        <hr>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label ><strong>Activity Name</strong></label>
                                                  <input type="text" name="activity_name" class="form-control border-input" value="{{$daily_activity->activity_name}}" required="required">
                                              </div>
                                          </div>

                                      </div>

                                    <div class="row">
                                      <div class="col-md-12">
                                      <div class="well">
                                        <h5>Current Activity Description </h5>
                                        {{$daily_activity->activity_description}}
                                      </div>
                                      </div>
                                    </div>

                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label><strong>New Activity Description</strong> </label>
                                                  <div class="form-group">
                                                    <textarea class="form-control" name="activity_description" id="activity_description" rows="3"></textarea>
                                                  </div>
                                              </div>
                                          </div>
                                          
                                      </div>

                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>Activity Date (YYYY-MM-DD) </strong></label>
                                                  <input type="date" class="form-control border-input" name="activity_date" value="{{$daily_activity->activity_date->format('Y-m-d')}}" required="required">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label><strong>due Date (YYYY-MM-DD) </strong></label>
                                                  <input type="date" class="form-control border-input" name="due_date" value="{{$daily_activity->due_date->format('Y-m-d')}}" required="required">
                                              </div>
                                          </div>
                                        </div> 

                                                                     
                                      <div class="">
                                          <input type="submit" class="btn btn-success" value="Submit">
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

@endsection