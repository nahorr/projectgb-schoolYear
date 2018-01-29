@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Step 2: Add/Edit Terms
                               <hr>
                               <strong>School Year: <span>{{$schoolyear->school_year}}</span></strong>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing {{ $schoolyear->school_year}} Terms </h4>
                                        <span class="widget-toolbar">
                                            <strong><a href="{{asset('/schoolsetup/addterm/'.$schoolyear->id)}}">
                                                <i class="ace-icon fa fa-pencil-square-o fa-2x"></i>
                                                Add Term
                                            </a></strong>
                                        </span>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                    	   <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>Term</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Show Until</th>
                                                    <th>Edit Term</th>
                                                    <th>Delete Term</th>

                                                </thead>
                                                <tbody>
                                                    @foreach ($schoolyear_terms as $term)

                                                    <tr>
                                                        <td>{{ $term->term }}</td>
                                                        <td>{{ $term->start_date->toFormattedDateString() }}</td>
                                                        <td>{{ $term->end_date->toFormattedDateString() }}</td>
                                                        <td>{{ $term->show_until->toFormattedDateString() }}</td>
                                                        <td><strong><a href="{{asset('/schoolsetup/editterm/'.$schoolyear->id) }}/{{$term->id}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
                                                        </td>
                                                        <td><strong><a href="{{asset('/schoolsetup/posttermdelete/'.$term->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="danger fa fa-trash-o fa-2x" aria-hidden="true" style="color:red"></i></a></strong>
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


                <div class="hr hr-18 dotted hr-double"></div>
                <br>

				<div class="alert-danger">
					
						<ul>
							@foreach($errors->all() as $error)

								<li> {{ $error }}</li>

							@endforeach

						</ul>

				</div>


@endsection
