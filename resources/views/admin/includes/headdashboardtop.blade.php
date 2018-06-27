                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Class size</p>

                                            @if( $reg_teacher )


                                                    {{ @$registrations_students->where('school_year_id', '=', $schoolyear->id)->where('group_id', '=', $reg_teacher->group_id)->count() }}
                                                
                                             @else
                                                0
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i>
                                           @if( $reg_teacher )


                                                    {{ @$registrations_students->where('school_year_id', '=', $schoolyear->id)->where('group_id', '=', $reg_teacher->group_id)->count() }}
                                                
                                             @else
                                                0
                                            @endif 
                                           

                                          students in your class this term
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
                                            <i class="fa fa-university" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Class</p>
                                           <p> {{ @$current_registration_teacher->group->name }} </>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i> You are assigned to {{ @$current_registration_teacher->group->name }} this term.
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
                                            <i class="fa fa-text-width" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Term</p>
                                            <p> {{@$current_term->term}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> 
                                        Ends:  {{ @$current_term->end_date->toFormatteddateString() }}
                                               
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
                                            <i class="ti-layout-media-overlay-alt-2"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>School Year {{ $current_school_year->school_year}}</p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-pin-alt"></i> 
                                            Ends: {{ $current_school_year->end_date->toFormatteddateString()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   