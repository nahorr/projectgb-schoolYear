@extends('admin.dashboard')

@section('content')

        <div class="content">
          <div class="container-fluid">
            <div class="row">
                 @include('admin.includes.headdashboardtop')
            </div>
            @include('flash::message')
            <hr>

              <div class="col-md-12">
                  <div class="card">
                      <div class="header">
                          <h4 class="title">{{$student->first_name}} {{$student->last_name}} : Disciplinary Records
                             <div class="pull-right">
                              <a href="{{asset('/students/discipline/adddrecord/'.$student->id)}}"><button type="button" class="btn btn-success">ADD NEW Record</button></a>
                              <a href="{{asset('/students/discipline/allstudents')}}"><button type="button" class="btn btn-info">BACK</button></a>
                            </div>
                             <div class="pull-c"></div>
                          </h4>
                          <p class="category">Class: {{$group_teacher->name}} </p>
                      </div>
                      <div class="content">
                       
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                              <th>#</th>
                              <th>Date</th>
                              <th>Term</th>
                              <th>Description</th>
                              <th>File</th>
                              <th>Edit</th>
                              <th>Delete</th>
                          </thead>
                          <tbody>
                              @foreach($drecords as $key=>$drecord)

                              <tr>
                                  
                                  <td>{{ $key+1 }}</td>
                                  <td>{{ $drecord->drecord_date }}</td>
                                  <td>
                                    @foreach($terms as $term )
                                      @if($term->id == $drecord->term_id)
                                        {{ $term->term }}
                                      @endif
                                    @endforeach
                                  </td>
                                  <td>{{$drecord->drecord_description}}</td>
                                  <td>
                                    @if($drecord->drecord_file != null)
                                      <a href="{{ asset('disciplinary_records/'. $drecord->drecord_file) }}" target="_blank"><i class="fa fa-file fa-2x"></i></a>
                                    @endif
                                  </td>
                                  <td>
                                    <a href="{{asset('/students/discipline/editdrecord/'.$drecord->id)}}/{{$student->id}}">
                                      <button type="button" class="btn btn-info">EDIT</button>
                                    </a>
                                  </td>
                                  <td>
                                    <a href="{{asset('/students/discipline/deletedrecord/'.$drecord->id)}}" onclick="return confirm('Are you sure you want to Delete this record?')">
                                      <button type="button" class="btn btn-danger">DELET</button>
                                    </a>
                                  </td>
                                 
                              </tr>
                           @endforeach
                              
                          </tbody>
                          </table>
                         
                          </div>
                      </div>
   
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection