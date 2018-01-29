@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>
                <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-info">
                    <h5><strong>Please note!</strong> You can only add a group even for the current term.</h5>
                                       
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-warning">
                    <h5><strong>Add, Edit, or Delete your class/group events!</strong><br> You can add, edit, or delete events for your class here. <br><strong>These events are only seen by students in your class.</strong></h5>
                  </div>
                  </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                             
                           
                                <h4 class="title"><strong>
                                @foreach($terms as $term)

                                  @if($today->between($term->start_date, $term->show_until))
                               
                                      <a href="{{asset('/groupevents/addgroupevent/'.Crypt::encrypt(@$teacher->group_id)) }}/{{Crypt::encrypt(@$term->id)}}">
                                       <i class="fa fa-plus fa-2x" aria-hidden="true"></i>&nbsp; Add  New Event</a></h4>
                                 
                               
                           
                                <p class="category">You have {{ @$groupevent_current_term->count() }} events this term.</p>

                               

                                      <p class="category">Term: {{$term->term}}</p>
                                  
                                  @endif
                                @endforeach
                            </div>
                            <div class="content">
                            <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>#</th>
                                <th>Event Type</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Edit/Delete</th>
                                

                              </tr>
                            </thead>
                            <tbody>
                            
                                @foreach ($groupevent_current_term as $key => $event)

                                    @foreach($terms as $term)

                                        @if($today->between($term->start_date, $term->show_until))                 

                                      <tr>

                                        <td>{{@$key+1}}</td>
                                        <td>{{@$event->type}}</td>
                                        <td>{{@$event->description}}</td>
                                        <td>{{@$event->start_date->toFormattedDateString()}}</td>
                                        <td>{{@$event->end_date->toFormattedDateString()}}</td>
                                        <td>
                                          @if($today->between(@$event->start_date, @$event->end_date))
                                          Active
                                          @elseif($today->lt(@$event->start_date))
                                          Up Comming
                                          @elseif($today->gt(@$event->end_date))
                                          Expired
                                          @endif

                                        </td>

                                      

                                      <td>
                                      
                                                                            
                                      <a href="{{asset('/groupevents/editgroupevent/'.Crypt::encrypt(@$event->id)) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>&nbsp;
                                      <a href="{{asset('/groupevents/postgroupeventdelete/'.Crypt::encrypt(@$event->id)) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>&nbsp;
                                              
                                      </td>

                                     </tr> 
                                      @endif      
                                    @endforeach  
                                @endforeach
                           
                            </tbody>
                          </table>
                        </div>
                                
                                
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                </div>
            </div>
        </div>

@endsection
