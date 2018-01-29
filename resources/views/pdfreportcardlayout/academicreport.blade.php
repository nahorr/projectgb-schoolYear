                      
                    
                      <div class="table-responsive">
                          <table class="table table-bordered text-center table-hover" table-responsive>
                            <thead>
                            <tr>
                                <th colspan="1" class="text-center">Subjects</th>
                                <th colspan="4" class="text-center"> Continuous Assessments 10% each</th>
                                <th colspan="1" class="text-center">60%</th>
                                <th colspan="1" class="text-center">100%</th>
                                <th colspan="3" class="text-center">Class Averages</th>
                                <th colspan="1" class="text-center">Course</th>
                                <th colspan="1" class="text-center">Letter</th>
                                
                              </tr>
                              <tr class="info">
                                <th class="text-center">Name</th>
                                <th class="text-center">Ist</th>
                                <th class="text-center">2nd</th>
                                <th class="text-center">3rd</th>
                                <th class="text-center">4th</th>
                                <th class="text-center">Exam</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Highest</th>
                                <th class="text-center">Lowest</th>
                                <th class="text-center">Average</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Grade</th>

                              </tr>
                            </thead>
                            <tbody>
                            
                                @foreach ($course_grade as $grade)

                                    @foreach ($sorted_grouped as $k1 => $grouped)

                                        @if ($grade->course_id == $k1 )

                                            @foreach($grouped as $k2 => $sorted)

                                                @if($grade->student_id == $sorted->student_id )
                                    

                                    
                                  

                                      <tr>
                                        

                                        <td class="text-center">{{$grade->name}}</td>
                                        <td class="text-center">{{$grade->first_ca}}</td>
                                        <td class="text-center">{{$grade->second_ca}}</td>
                                        <td class="text-center">{{$grade->third_ca}}</td>
                                        <td class="text-center">{{$grade->fourth_ca}}</td>
                                        <td class="text-center">{{$grade->exam}}</td>
                                        <td class="text-center">{{$grade->total}}</td>
                                        
                                        <td class="text-center">

                                        {{$mgb[array_search($grade->course_id, $pluck_course_id)]->max }}


                                        </td>
                                       
                                        <td class="text-center">

                                        {{$mgb_lowest[array_search($grade->course_id, $pluck_course_id_min)]->min }}

                                        </td>

                                        <td class="text-center">

                                        {{number_format($mgb_avg[array_search($grade->course_id, $pluck_course_id_avg)]->avg, 1) }}

                                        </td>

                                        <td class="text-center">

                                        @if ($k2+1 == 1)

                                            {{ $k2+1 }}st

                                        @elseif( $k2+1 == 2 )

                                            {{ $k2+1 }}nd

                                        @elseif( $k2+1 == 3 )

                                            {{ $k2+1 }}rd
                                        @elseif( $k2+1 == 21 )

                                            {{ $k2+1 }}st

                                        @elseif( $k2+1 == 22 )

                                            {{ $k2+1 }}nd

                                        @elseif( $k2+1 == 23 )

                                            {{ $k2+1 }}rd

                                        @else

                                            {{ $k2+1 }}th

                                        @endif 


                                        </td>


                                        <td class="text-center">

                                            
                                            @if ($grade->total < 65)
                                            F
                                            @elseif ($grade->total<= 66 && $grade->total >=65)
                                            D
                                            @elseif ($grade->total<= 69 && $grade->total >=67)
                                            D+
                                            @elseif ($grade->total<= 73 && $grade->total >=70)
                                            C-
                                            @elseif ($grade->total<= 76 && $grade->total >=74)
                                            C
                                            @elseif ($grade->total<= 79 && $grade->total >=77)
                                            C+
                                            @elseif ($grade->total<= 83 && $grade->total >=80)
                                            B-
                                            @elseif ($grade->total<= 86 && $grade->total >=84)
                                            B
                                            @elseif ($grade->total<= 89 && $grade->total >=87)
                                            B+
                                            @elseif ($grade->total<= 93 && $grade->total >=90)
                                            A-
                                            @elseif ($grade->total<= 96 && $grade->total >=94)
                                            A
                                            @elseif ($grade->total>= 97)
                                            A+
                                            @endif

                                         
                                        </td>
                                      
                                      </tr>

                                                @endif
                                            @endforeach
                                        @endif
                                      @endforeach
                                       
                                   
                                @endforeach
                          
                            </tbody>
                          </table>
                        </div>
                