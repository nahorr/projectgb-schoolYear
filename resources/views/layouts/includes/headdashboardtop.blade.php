                    @if($schoolyear->id == $current_school_year->id)

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
                                                                               
                                            <p>Current Class:
                                                <strong style="color: red;">{{ @\App\StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('student_id', '=', $student->id)->first()->group->name }}</strong>
                                            </p>
                                        
                                       
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>Your Teacher this term:
                                        
                                            <strong style="color: red;">{{ @$students_teacher_current->staffer->first_name }} {{ @$students_teacher_current->staffer->last_name }}</strong>

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
                                        
                                            <p class="pull-left">Current Term: <strong style="color: red;">{{ @$current_term->term }}</strong></p>

                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i>
                                        
                                            Current Term Ends:  {{ $current_term ? @$current_term->end_date->toFormattedDateString(): '-' }}

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
                                            {{ $student->dob->diffInYears(@$today) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> {{ $student->dob->addyear($student->dob->diffInYears(@$today))->diffForHumans() }} 
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
                                           
                                                <p>Current School Year: <strong style="color: red;">{{ @$schoolyear->school_year }}</strong></p>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-pin-alt"></i>
                                       
                                            Current School Year Ends: {{ @$schoolyear->end_date->toFormattedDateString() }}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else

                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-user"></i><p>{{ $student->first_name }} {{ $student->last_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Age</p>
                                            {{ $student->dob->diffInYears(@$today) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> Your Birth Day: {{ $student->dob->addyear($student->dob->diffInYears(@$today))->diffForHumans() }} 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="fa fa-university"></i><p>School Year Ended</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                           
                                                <p>School Year: {{ @$schoolyear->school_year }}</p>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-pin-alt"></i>
                                       
                                            This School Year Ended: {{ @$schoolyear->end_date->toFormattedDateString() }}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif
