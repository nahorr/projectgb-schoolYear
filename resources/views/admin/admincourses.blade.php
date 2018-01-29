@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="color: #68B3C8;"><i class="fa fa-edit"></i><strong>Enter Grades</strong></h4>
                                <h4 class="title">Please select a term to continue</h4>
                                <p class="category"> <i class="fa fa-circle text-info"></i><strong>School Year:</strong> {{ $schoolyear->school_year }}</p>
                                <p class="category"> <i class="fa fa-circle text-info"></i><strong>Group:</strong> {{ @$group_teacher->name }}</p>
                                
                            </div>

                            <div class="content">
                                    <table class="table table-bordered table-hover text-center">
                                        <thead>
                                            <th class="text-center info">#</th>
                                            <th class="text-center info"><strong>Terms</strong></th>
                                           

                                        </thead>
                                        <tbody>
                                            @foreach ($terms as $key => $term)

                                            <tr>
                                                <td>
                                                {{$key+1}}
                                                <br>
                                                @if($today->between($term->start_date, $term->show_until))
                                                <i class="fa fa-circle text-info"></i>Current
                                                @endif

                                                

                                                </td>
                                                <td>
                                                 <strong><a href="{{asset('/admincourses/'. Crypt::encrypt($term->id)) }}">{{ $term->term }}</a></strong> 
                                                </td>

                                            </tr>
                                         @endforeach
                                            
                                        </tbody>
                                    </table>

                                    <div class="footer">
                                    
                                       
                                        
                                        <hr>
                                        <!--
                                        <div class="stats">
                                            <i class="ti-timer"></i> Campaign sent 2 days ago
                                        </div>
                                        -->
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
               
                </div>
            </div>
       
@endsection
