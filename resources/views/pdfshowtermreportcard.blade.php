<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Eginny Technologies- {{ Auth::user()->name }}'s {{ $term->term }} Report Card</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="{{asset('assets/css/custom-pdf.css')}}" rel="stylesheet" type="text/css" media="print"/>



</head>
<body>

<div class="wrapper">

  <div class="content">

    <div class="container">
            
      <div class="row">

        <div class="col-md-12 ">

          <div class="panel panel-primary">
                        
              <div class="panel-heading">
                <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4"><h4>{{ Auth::user()->name }}'s REPORT CARD</h4></div>
                  <div class="col-md-4"><h4><a href="{{ url('/reportcards') }}" class="pull-right hidden-print" style="color: white">BACK TO HOME</a></h4></div>
                  <div class="col-md-4"><h4><a href="javascript:window.print()" class="pull-right hidden-print" style="color: white">PRINT</a></h4></div>

                </div> 
                </div>
              </div>
               

              <div class="pagebreak">

                <div class="row">
                                  
                  @include('pdfreportcardlayout.head')

                </div>{{-- row-head --}}
                                
                <div class="row">

                  @include('pdfreportcardlayout.biodata')

                </div>{{-- row-bio-data --}}
                              
                <div class="row">

                  @include('pdfreportcardlayout.atthealth')

                </div>{{-- row-ATT RECORED CLASS AGV HEALTH RECORD --}}

              </div>

              <div class="pagebreak">            

                <div class="row">

                  <div class="col-md-12">

                    <div class="panel-body"> 

                      @include('pdfreportcardlayout.academicreport')

                      @include('pdfreportcardlayout.comments')

                    </div>

                  </div>

                </div>

              </div>

              <div class="pagebreak">

                <div class="row"> 

                  <div class="col-md-12">

                    <div class="panel-body">
                                   
                        <div class="col-md-4">
                                    
                          @include('pdfreportcardlayout.psychomotor')
                                                    
                        </div>
                                    
                        <div class="col-md-4">
                                    
                          @include('pdfreportcardlayout.effectiveareas')

                        </div>
                                     
                        <div class="col-md-4">
                                    
                           @include('pdfreportcardlayout.learningaccademicactivities')
                                                   
                        </div>

                      </div>

                    </div> 
                 
                      <div class="col-md-12">

                        <div class="panel-body">
                                   
                          <div class="col-md-4">
                                    
                            @include('pdfreportcardlayout.ratingkey')
                                                    
                          </div>
                                    
                          <div class="col-md-8">
                                    
                            @include('pdfreportcardlayout.gradekey')

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

                        @include('pdfreportcardlayout.footer')

                      </div>
          
                    </div>

                  </div>
          </div>

      </div>

    </div>

  </div>

</div>


</body>

</html>