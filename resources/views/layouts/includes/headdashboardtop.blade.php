                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-book"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                            
                                            <p>{{ @$student_group->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i> {{@$student_teacher->first_name}}&nbsp;{{@$student_teacher->last_name}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-ruler-pencil"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p class="pull-left">
                                                @foreach ($terms as $term)
                                                    @if (@$today->between(@$term->start_date, @$term->show_until ))
                                                        Current Term: {{ @$term->term }}
                                                    @endif
                                                    
                                                @endforeach
                                                
                                        
                                           
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i>
                                        @foreach ($terms as $term)
                                            @if (@$today->between(@$term->start_date, @$term->show_until )) 
                                                Ends:  {{@$term->end_date->toFormattedDateString()}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Age</p>
                                            {{ @$student->dob->diffInYears(@$today) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> {{ @$student->dob->addyear(@$student->dob->diffInYears(@$today))->diffForHumans() }} 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="fa fa-university"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>School Year: {{ @$school_year->school_year }}</p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-pin-alt"></i> 
                                        Ends: {{ @$school_year->end_date->toFormattedDateString() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>