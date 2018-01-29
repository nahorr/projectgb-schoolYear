@extends('layouts.reportcarddashboard')
<link href="{{asset('assets/css/custom-pdf.css')}}" rel="stylesheet" type="text/css" media="print"/>

@section('content')

  <div class="content">

    <div class="container">
            
      <div class="row">

        <div class="col-md-12 ">

          <div class="panel panel-info">
                        
              <div class="panel-heading"><h4>{{ Auth::user()->name }} {{$term->term}} Report card<a href="{{ url('/reportcards') }}" class="pull-right" >Back</a></h4></div>

              <div class="pagebreak">

                <div class="row">
                                  
                  @include('reportcardlayout.head')

                </div>{{-- row-head --}}
                                
                <div class="row">

                  @include('reportcardlayout.biodata')

                </div>{{-- row-bio-data --}}
                              
                <div class="row">

                  @include('reportcardlayout.atthealth')

                </div>{{-- row-ATT RECORED CLASS AGV HEALTH RECORD --}}

              </div>

              <div class="pagebreak">            

                <div class="row">

                  <div class="col-md-12">

                    <div class="panel-body"> 

                      @include('reportcardlayout.academicreport')

                      @include('reportcardlayout.comments')

                    </div>

                  </div>

                </div>

              </div>

              <div class="pagebreak">

                <div class="row"> 

                  <div class="col-md-12">

                    <div class="panel-body">
                                   
                        <div class="col-md-4">
                                    
                          @include('reportcardlayout.psychomotor')
                                                    
                        </div>
                                    
                        <div class="col-md-4">
                                    
                          @include('reportcardlayout.effectiveareas')

                        </div>
                                     
                        <div class="col-md-4">
                                    
                           @include('reportcardlayout.learningaccademicactivities')
                                                   
                        </div>

                      </div>

                    </div> 
                 
                      <div class="col-md-12">

                        <div class="panel-body">
                                   
                          <div class="col-md-4">
                                    
                            @include('reportcardlayout.ratingkey')
                                                    
                          </div>
                                    
                          <div class="col-md-8">
                                    
                            @include('reportcardlayout.gradekey')

                            @if($comment_all === null)


                            <div class="well">

                              <strong>REPORT CARD APPROVED BY:</strong> <span> <i>_______________________________</i></span>

                              <hr>

                              <p> <strong>DATE:</strong><i><u>Not yet approved</u></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>SIGNATURE:</strong>_______________________________ </p>

                            </div>

                            @else

                            <div class="well">

                              <strong>REPORT CARD APPROVED BY:</strong> <span> <i>_______________________________</i></span>

                              <hr>

                              <p> <strong>DATE:</strong><i><u>{{ $comment_all->created_at->toFormattedDateString() }}</u></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>SIGNATURE:</strong>_______________________________ </p>

                            </div>

                            @endif

                          </div>
                          
                        </div>

                      </div>
                                                
                      <div class="col-md-12">

                        @include('reportcardlayout.footer')

                      </div>
          
                    </div>

                  </div>
          </div>

      </div>

    </div>

  </div>

</div>

@endsection
