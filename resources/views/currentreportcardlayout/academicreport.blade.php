                      <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>Subject</th>
                                <th>Ist CA</th>
                                <th>2nd CA</th>
                                <th>3rd CA</th>
                                <th>4th CA</th>
                                <th>Exam</th>
                                <th>Total</th>
                                <th>Class Highest</th>
                                <th>Class Lowest</th>
                                <th>Class Average</th>
                                <th>Position</th>
                                <th>Letter Grade</th>

                              </tr>
                            </thead>
                            <tbody>
                            
                                @foreach ($course_grade as $grade)
                                  

                                      <tr>
                                        
                                        <td>{{$grade->name}}</td>
                                        <td>{{$grade->first_ca}}</td>
                                        <td>{{$grade->second_ca}}</td>
                                        <td>{{$grade->third_ca}}</td>
                                        <td>{{$grade->fourth_ca}}</td>
                                        <td>{{$grade->exam}}</td>
                                        <td>{{ $grade->first_ca + $grade->second_ca + $grade->third_ca + $grade->fourth_ca + $grade->exam}}</td>
                                        <td>{{$grade->class_highest}}</td>
                                        <td>{{$grade->class_lowest}}</td>
                                        <td>{{$grade->class_caverage}}</td>
                                        <td>{{$grade->position_in_class}}</td>
                                        <td>{{$grade->letter_grade}}</td>
                                      
                                      </tr>
                                   
                                @endforeach
                           
                            </tbody>
                          </table>
                        </div>