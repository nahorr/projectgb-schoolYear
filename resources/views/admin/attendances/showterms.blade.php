@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Please Select a Term to conitue</h4>
                                <p class="category">Class: {{$group_teacher->name}} </p>
                            </div>
                            <div class="content">
                            <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>Terms</th>
                                <th>Select a term</th>
                              </tr>
                            </thead>
                            <tbody>
                                    @foreach($terms as $term)

                                    <tr>
                                      
                                      <td>{{$term->term}}</td>
                                                                               
                                      <td>

                                      <strong><a href="{{asset('/attendances/showstudents/'. $term->id) }}"><i class="fa fa-check fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Select Term</a>
                                     
                                      </td>
                                    </tr>
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
