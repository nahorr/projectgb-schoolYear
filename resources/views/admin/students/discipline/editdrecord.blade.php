@extends('admin.dashboard')

@section('content')

        <div class="content">
          <div class="container-fluid">
            <div class="row">
                 @include('admin.includes.headdashboardtop')
            </div>
            <div class="row">

              <div class="col-md-8 col-md-offset-2">
                  <div class="card">
                      <div class="header">
                          <h4 class="title"><strong><p class="text-danger">Editing disciplinary record for {{$student->first_name}} {{$student->last_name}}</p></strong>
                             <div class="pull-right"><a href="{{asset('/students/discipline/studentdrecords/'.$student->id)}}"><button type="button" class="btn btn-primary">Back {{$student->first_name}} {{$student->last_name}} Records </button></a></div>
                          </h4>
                          <p class="category">Class: {{$group_teacher->name}} </p>
                      </div>
                      <div class="content">
                        <form class="form-group" action="{{ url('/students/discipline/posteditdrecord', [$drecord->id,$student->id]) }}" method="POST"  enctype="multipart/form-data">
                              {{ csrf_field() }}
                                      <input type="hidden" class="form-control border-input" name="student_id" value="{{$student->id}}" >
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
                                                  <label><strong>Date it happened (YYYY-MM-DD) </strong></label>
                                                  <input type="date" class="form-control border-input" name="drecord_date" value="{{$drecord->drecord_date->format('Y-m-d')}}" required="required">
                                              </div>
                                          </div>
                                         
                                        </div> 
                                      
                                      <hr>

                                      <div class="row">
                                      <div class="col-md-12">
                                      <div class="well">
                                        <h5>Current Disciplinary Record </h5>
                                        {{$drecord->drecord_description}}
                                      </div>
                                      </div>
                                    </div>

                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label><strong>New Record of Disciplinary Event</strong> </label>
                                                  <div class="form-group">
                                                    <textarea class="form-control" name="drecord_description" id="drecord_description" rows="3"></textarea>
                                                  </div>
                                              </div>
                                          </div>
                                          
                                      </div>
                           

                                      <div class="form-group">
                                        <label><strong>Upload File or picture</strong> </label>
                                        <input type="file" name="drecord_file" id="exampleInputFile">
                                        <p class="help-block">Please upload a file or picture if any(jpg,png,doc,pdf only).</p>
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