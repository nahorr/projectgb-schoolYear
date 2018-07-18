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
                    <h5><strong>Registration Alert!</strong> If student's face does not display, It means that the student is yet to register. Please remind the student to register.</h5>
                  </div>
                  </div>
                </div>
                @if($term->id == $current_term->id)
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Observable Trait</h4>
                                <p class="category">Please select an observable trait to continue.</p>
                            </div>
                            <div class="content">
                            <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>#</th>
                                <th>Observed Traits</th>
                                <th>Description</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>
                                    <a href="{{ url('/effectiveareas/showstudents/'.$schoolyear->id) }}/{{$term->id}}">
                                        <i class="ti-check-box"></i>
                                        Effective Areas
                                    </a>
                                  </td>
                                  <td>
                                    Punctuality, Creativity, Reliability, Neatness.
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>
                                    <a href="{{ url('/psychomotors/showstudents/'.$schoolyear->id) }}/{{$term->id}}">
                                        <i class="ti-check-box"></i>
                                        Psychomotors
                                    </a>
                                  </td>
                                  <td>
                                    Hand Writing, Vabal fluency, Games/Sport, Handling of Tools.
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>
                                    <a href="{{ url('/learningandaccademics/showstudents/'.$schoolyear->id) }}/{{$term->id}}">
                                        <i class="ti-check-box"></i>
                                        Learning and Accademics
                                    </a>
                                  </td>
                                  <td>
                                    Class Work, Home Work, Project, Note Taking.
                                  </td>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                                
                                
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
          <div class="col-md-12">
          <div class="alert alert-warning">
            <h5><strong>Term Has Ended!</strong> please go to <a href="{{ url('/admin/observationsonconduct/' .$current_school_year->id) }}/{{$current_term->id}}">current term</a> </h5>
          </div>
          </div>
        </div>
        @endif
                </div>
              
                </div>
            </div>
        </div>

@endsection
