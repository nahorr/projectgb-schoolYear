@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
            <!--
                <div class="row">
                    @include('layouts.includes.headdashboardtop')
                    
                </div>
                -->
                <div class="row">
                	<div class="col-md-12 ">
            <div class="panel panel-info">
                <div class="panel-heading"><h4>{{ Auth::user()->name }}'s REPORT CARD</h4></div>

                <div class="row">
                  
                  @include('currentreportcardlayout.head')

                </div>{{-- row-head --}}
                <hr>

                <div class="row">

                  @include('currentreportcardlayout.biodata')

                </div>{{-- row-bio-data --}}
                <hr>

                <div class="row">

                 @include('currentreportcardlayout.atthealth')

                </div>{{-- row-ATT RECORED CLASS AGV HEALTH RECORD --}}
                <hr>

               

                <div class="row"> 
                    <div class="col-md-4">
                        <div class="panel-body">
                       
                                
                              @include('currentreportcardlayout.observations')

                                               
                        </div>
                    </div>
                    <div class="col-md-8">

                      <div class="panel-body">
                     
                              
                            @include('currentreportcardlayout.academicreport')
                            @include('currentreportcardlayout.comments')
                                             
                      </div>
                    </div>

                </div>{{-- row-academicreport --}}
                <hr>

                <div class="row">

                  @include('currentreportcardlayout.footer')

                </div>{{-- row --}}
               

                             

            </div>


        </div>

                </div>
            </div>
        </div>


@endsection
