<!-- Modal -->
<div class="modal fade" id="termSelectionModal" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please select a term</h4>
      </div>
      <div class="modal-body">
        
                        <div class="table-responsive">
                      
                            <table class="table table-bordered table-hover" table-responsive>
                                    <thead>
                                        <tr class="info">
                                            <th class="text-center"><strong>#</strong></th>
                                            <th class="text-center"><strong>School Year</strong></th>
                                            <th class="text-center"><strong>Start Date</strong></th>
                                            <th class="text-center"><strong>End Date</strong></th>
                                            <th class="text-center"><strong>Terms</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                                                      
                                        @foreach ($school_years as $key=>$schoolyear)                         
                                                                                     
                                            <tr>
                                                <td class="text-center">{{$number_init++}}</td>
                                                <td class="text-center">
                                                    @if($schoolyear->id == $current_school_year->id)
                                                        {{$schoolyear->school_year}} - <p><strong><mark style="color: green;">Current Year</mark></strong></p>
                                                    @else
                                                        {{$schoolyear->school_year}} 
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$schoolyear->start_date->toFormattedDateString()}}</td>
                                                <td class="text-center">{{$schoolyear->end_date->toFormattedDateString()}}</td>
                                                <td class="text-center">
                                                    @foreach ($terms as $term)
                                                        @foreach ($registrations_teacher->where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id) as $regs_teacher)
                                                        <a href="{{asset('/admin_home/'. $schoolyear->id)}}/{{$term->id}}">
                                                            @if($schoolyear->id == $current_school_year->id)
                                                                @if($term->id == $current_term->id)
                                                                    <button type="button" class="btn btn-info btn-sm">{{strtoupper($term->term)}} <span style="color: red">You are assigned to</span> {{$regs_teacher->group->name}}<br><span style="color: red">Current Term</span></button>
                                                                @else
                                                                    <button type="button" class="btn btn-success btn-sm">{{strtoupper($term->term)}} <span style="color: red">You are assigned to</span> {{$regs_teacher->group->name}}</button>
                                                                @endif
                                                            @else
                                                                    <button type="button" class="btn btn-primary btn-sm">{{strtoupper($term->term)}} <span style="color: red">You are assigned to</span> {{$regs_teacher->group->name}}</button>
                                                            @endif
                                                        </a>
                                                        <br>
                                                        <br>
                                                        @endforeach
                                                    @endforeach
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                            </table>

                        </div>
                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>