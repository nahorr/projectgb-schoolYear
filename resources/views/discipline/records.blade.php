@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('layouts.includes.headdashboardtop')
                </div>

                    <div class="row">

                      <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Your Disciplinary Records</h4>
                                  <p class="category">Teacher: {{$student_teacher->first_name}} {{$student_teacher->last_name}}</p>
                                  <p class="category">Class: {{$student_group->name}} </p>
                              </div>
                              <div class="content">
                               
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                  <thead>
                                      <th><strong>#</strong></th>
                                      <th><strong>Date</strong></th>
                                      <th><strong>Term</strong></th>
                                      <th><strong>Description</strong></th>
                                      <th><strong>View File</strong></th>
                                      
                                  </thead>
                                  <tbody>
                                      @foreach ($drecords as $key=>$drecord)

                                      <tr>
                                          
                                          <td>{{ $key+1 }}</td>
                                          <td>{{ $drecord->drecord_date->toFormattedDateString() }}</td>
                                          <td>
                                            @foreach($terms as $term )
                                              @if($term->id == $drecord->term_id)
                                                {{ $term->term }}
                                              @endif
                                            @endforeach
                                          </td>
                                          <td>{{ $drecord->drecord_description }}</td>
                                          <td>
                                            <a href="{{ asset('disciplinary_records/'. $drecord->drecord_file) }}" target="_blank"><i class="fa fa-file fa-2x"></i></a>
                                          </td>
                                                                                  
                                      </tr>
                                   @endforeach
                                      
                                  </tbody>
                                  </table>
                                  <div class="pagination"> {{ $drecords->links() }} </div>
                                  </div>
                              </div>

                          </div>
                        </div>

              
                    </div>

           
                </div>
            </div>
        

@endsection
