<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {

    $school_year = DB::table('school_years')->first();                                                                                                                                                                                 
    return view('welcome', compact('school_year'));
});*/
//Home Public
Route::get('/', 'HomePublicController@index')->name('homepublic');
Route::get('/features', 'HomePublicController@features');
Route::get('/contact', 'HomePublicController@contact');
Route::post('/contact', 'HomePublicController@postContact');

//Videos
Route::get('/videos', 'HomePublicController@videos');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//for user profile avatar

Route::get('/profile', 'UserController@profile');

Route::post('/profile', 'UserController@update_avatar');


//Admin/staff Registeration and login

//Logged in users/admin/staff cannot access or send requests to these pages

Route::group(['middleware' => 'admin_guest'], function() {

Route::get('/admin_register', 'AdminAuth\RegisterController@showRegistrationForm');

Route::post('/admin_register', 'AdminAuth\RegisterController@register');

Route::get('/admin_login', 'AdminAuth\LoginController@showLoginForm');

Route::post('/admin_login', 'AdminAuth\LoginController@login');

//Password reset routes
Route::get('/admin_password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('/admin_password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');

Route::get('/admin_password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

Route::post('/admin_password/reset', 'AdminAuth\ResetPasswordController@reset');


});

//Only logged in admin/staff can access or send requests to these pages
Route::group(['middleware' => 'admin_auth'], function(){

Route::post('/admin_logout', 'AdminAuth\LoginController@logout');

Route::get('/admin_home', 'AdminAuth\HomeController@index')->name('adminhome');
Route::get('/admin/printregcode/{student}', 'AdminAuth\HomeController@printRegCode');
Route::get('/admin/printallregcode', 'AdminAuth\HomeController@printAllRegCode');
Route::get('/admin/observationsonconduct', 'AdminAuth\HomeController@observationsOnConduct');
//Route::get('/admin/emailcode', 'AdminAuth\HomeController@emailCode');

//Print Students Report Cards
Route::get('/admin/reportcards/terms', 'AdminAuth\ReportCards\CrudeController@Terms');
Route::get('/admin/reportcards/students/{term}', 'AdminAuth\ReportCards\CrudeController@Students');
Route::get('/admin/reportcards/print/{student}/{term}', 'AdminAuth\ReportCards\CrudeController@Print');
Route::get('/admin/reportcards/printall/{term}', 'AdminAuth\ReportCards\CrudeController@PrintAll')->where(['students'=>'.*']);


//Ban and UnBan Students
Route::get('/admin/banstudents', 'AdminAuth\BanController@banStudents');
Route::post('/admin/posteditban/{student}', 'AdminAuth\BanController@posteditBan');
Route::post('/admin/posteditunban/{student}', 'AdminAuth\BanController@posteditUnBan');

//for staffer profile avatar

Route::get('/admin/profile', 'AdminAuth\AdminUserController@profile');

Route::post('/admin/profile', 'AdminAuth\AdminUserController@update_avatar');

//admin courses

Route::get('/admincourses', 'AdminAuth\CoursesController@index');

Route::get('/admincourses/{term}', 'AdminAuth\CoursesController@show');

Route::get('/admincourses/{term}/studentsterm', 'AdminAuth\CoursesController@students');

Route::get('/addGrades/{student}/{course}', 'AdminAuth\GradesCrudController@addGrades');
Route::post('/postGrades/{student}/{course}', 'AdminAuth\GradesCrudController@postGrades');
Route::get('/editGrades/{student_id}/{course_id}', 'AdminAuth\GradesCrudController@editGrades');
Route::post('/postGradeUpdate/{student_id}/{course_id}', 'AdminAuth\GradesCrudController@postGradeUpdate');
//Route::get('/deletegrade/{grade}', 'AdminAuth\GradesCrudController@deleteGrade');

Route::get('/showstudentcoursesgrades/{course}', 'AdminAuth\StudentCoursesGradesController@showCourseGrades')->name('showstudentcoursesgrades');
Route::get('/deletegrade/{grade}', 'AdminAuth\StudentCoursesGradesController@deleteGrade');

//show students grades by term for editing
//comments crud
Route::get('/addComment/{student_id}/{term_id}', 'AdminAuth\CommentCrudController@addComment');
Route::post('/postComment', 'AdminAuth\CommentCrudController@postComment');
Route::get('/editComment/{student_id}/{term_id}', 'AdminAuth\CommentCrudController@editComment');
Route::post('/postCommentUpdate/{student_id}/{term_id}', 'AdminAuth\CommentCrudController@postCommentUpdate');
Route::get('/postcommentdelete/{comment}', 'AdminAuth\CommentCrudController@deleteComment');

//Health Records
Route::get('/healthrecords/showterms', 'AdminAuth\HealthRecords\CrudeController@showTerms');
Route::get('/healthrecords/showstudents/{term}', 'AdminAuth\HealthRecords\CrudeController@showStudents')->name('showstudentshrecord');
Route::get('/healthrecords/addhrecord/{term}/{student}', 'AdminAuth\HealthRecords\CrudeController@addHRecord');
Route::post('/healthrecords/posthrecord/{term}/{student}', 'AdminAuth\HealthRecords\CrudeController@postHRecord');
Route::get('/healthrecords/edithrecord/{term}/{student}', 'AdminAuth\HealthRecords\CrudeController@editHRecord');
Route::post('/healthrecords/posthrecordupdate/{term}/{student}', 'AdminAuth\HealthRecords\CrudeController@postHRecordUpdate');
Route::get('/healthrecords/posthrecorddelete/{hrecord}', 'AdminAuth\HealthRecords\CrudeController@deleteHRecord');


//Effective Area
Route::get('/effectiveareas/showterms', 'AdminAuth\EffectiveAreas\CrudeController@showTerms');
Route::get('/effectiveareas/showstudents/{term}', 'AdminAuth\EffectiveAreas\CrudeController@showStudents')->name('showstudentseffectiveareas');
Route::get('/effectiveareas/addeffectivearea/{term}/{student}', 'AdminAuth\EffectiveAreas\CrudeController@addEffectiveArea');
Route::post('/effectiveareas/posteffectivearea/{term}/{student}', 'AdminAuth\EffectiveAreas\CrudeController@postEffectiveArea');
Route::get('/effectiveareas/editeffectivearea/{term}/{student}', 'AdminAuth\EffectiveAreas\CrudeController@editEffectiveArea');
Route::post('/effectiveareas/posteffectiveareaupdate/{term}/{student}', 'AdminAuth\EffectiveAreas\CrudeController@postEffectiveAreaUpdate');
Route::get('/effectiveareas/posteffectiveareadelete/{effectivearea}', 'AdminAuth\EffectiveAreas\CrudeController@deleteEffectiveArea');


//psychomotors
Route::get('/psychomotors/showterms', 'AdminAuth\Psychomotors\CrudeController@showTerms');
Route::get('/psychomotors/showstudents/{term}', 'AdminAuth\Psychomotors\CrudeController@showStudents')->name('showstudentspsychomotors');
Route::get('/psychomotors/addpsychomotor/{term}/{student}', 'AdminAuth\Psychomotors\CrudeController@addPsychomotor');
Route::post('/psychomotors/postpsychomotor/{term}/{student}', 'AdminAuth\Psychomotors\CrudeController@postPsychomotor');
Route::get('/psychomotors/editpsychomotor/{term}/{student}', 'AdminAuth\Psychomotors\CrudeController@editPsychomotor');
Route::post('/psychomotors/postpsychomotorupdate/{term}/{student}', 'AdminAuth\Psychomotors\CrudeController@postPsychomotorUpdate');
Route::get('/psychomotors/postpsychomotordelete/{psychomotor}', 'AdminAuth\Psychomotors\CrudeController@deletePsychomotor');

//Learning and Accademics
Route::get('/learningandaccademics/showterms', 'AdminAuth\LearningAndAccademics\CrudeController@showTerms');
Route::get('/learningandaccademics/showstudents/{term}', 'AdminAuth\LearningAndAccademics\CrudeController@showStudents')->name('showstudentslearningandaccademics');
Route::get('/learningandaccademics/addlearningandaccademic/{term}/{student}', 'AdminAuth\LearningAndAccademics\CrudeController@addLearningAndAccademic');
Route::post('/learningandaccademics/postlearningandaccademic/{term}/{student}', 'AdminAuth\LearningAndAccademics\CrudeController@postLearningAndAccademic');
Route::get('/learningandaccademics/editlearningandaccademic/{term}/{student}', 'AdminAuth\LearningAndAccademics\CrudeController@editLearningAndAccademic');
Route::post('/learningandaccademics/postlearningandaccademicupdate/{term}/{student}', 'AdminAuth\LearningAndAccademics\CrudeController@postLearningAndAccademicUpdate');
Route::get('/learningandaccademics/postlearningandaccademicdelete/{learningandaccademic}', 'AdminAuth\LearningAndAccademics\CrudeController@deleteLearningAndAccademic');

//Attendance
Route::get('/attendances/showterms', 'AdminAuth\Attendances\CrudeController@showTerms');
Route::get('/attendances/showstudents', 'AdminAuth\Attendances\CrudeController@showStudents')->name('showstudentsattendance');
Route::get('/attendances/addattendance/{student}', 'AdminAuth\Attendances\CrudeController@addAttendance');
Route::post('/attendances/postattendance/{student}', 'AdminAuth\Attendances\CrudeController@postAttendance');
Route::get('/attendances/editattendance/{student}', 'AdminAuth\Attendances\CrudeController@editAttendance');
Route::post('/attendances/postattendanceupdate/{student}', 'AdminAuth\Attendances\CrudeController@postAttendanceUpdate');
Route::get('/attendances/postattendancedelete/{attendance}', 'AdminAuth\Attendances\CrudeController@deleteAttendance');

//Group Events
Route::get('/groupevents/showgroupevents', 'AdminAuth\GroupEvents\SetUpController@showGroupEvents')->name('groupevents');
Route::get('/groupevents/addgroupevent/{group}/{term}', 'AdminAuth\GroupEvents\SetUpController@addGroupEvent');
Route::post('/groupevents/postgroupevent/{group}/{term}', 'AdminAuth\GroupEvents\SetUpController@postGroupEvent');
Route::get('/groupevents/editgroupevent/{event}', 'AdminAuth\GroupEvents\SetUpController@editGroupEvent');
Route::post('/groupevents/postgroupeventupdate/{event}', 'AdminAuth\GroupEvents\SetUpController@postGroupEventUpdate');
Route::get('/groupevents/postgroupeventdelete/{event}', 'AdminAuth\GroupEvents\SetUpController@postGroupEventDelete');

//Students - Activities
Route::get('/students/activities/showstudentsactivitytypes', 'AdminAuth\Students\Activities\CrudeController@showStudentsActivityTypes');
Route::get('/students/activities/dailyactivities', 'AdminAuth\Students\Activities\CrudeController@dailyActivities')->name('dailyactivities');
Route::get('/students/activities/adddailyactivity', 'AdminAuth\Students\Activities\CrudeController@addDailyActivity');
Route::post('/students/activities/postdailyactivity', 'AdminAuth\Students\Activities\CrudeController@postDailyActivity');
Route::get('/students/activities/editdailyactivity/{activity}', 'AdminAuth\Students\Activities\CrudeController@editDailyActivity');
Route::post('/students/activities/posteditdailyactivity/{activity}', 'AdminAuth\Students\Activities\CrudeController@posteditDailyActivity');
Route::get('/students/activities/deleteactivity/{activity}', 'AdminAuth\Students\Activities\CrudeController@deleteActivity');

//Students - Disciplinary Records
Route::get('/students/discipline/allstudents', 'AdminAuth\Students\Discipline\CrudeController@allStudents')->name('discipline_allstudents');
Route::get('/students/discipline/studentdrecords/{student}', 'AdminAuth\Students\Discipline\CrudeController@studentDRecords')->name('discipline_student');
Route::get('/students/discipline/adddrecord/{student}', 'AdminAuth\Students\Discipline\CrudeController@addDRecord');
Route::post('/students/discipline/postdrecord/{student}', 'AdminAuth\Students\Discipline\CrudeController@postDRecord');
Route::get('/students/discipline/editdrecord/{drecord}/{student}', 'AdminAuth\Students\Discipline\CrudeController@editDRecord');
Route::post('/students/discipline/posteditdrecord/{drecord}/{student}', 'AdminAuth\Students\Discipline\CrudeController@postEditDRecord');
Route::get('/students/discipline/deletedrecord/{drecord}', 'AdminAuth\Students\Discipline\CrudeController@deleteDRecord');

//messages from students
Route::get('/students/messages/allstudents', 'AdminAuth\Students\Messages\CrudeController@allStudents')->name('messages_allstudents');
Route::get('/students/messages/studentmessages/{user}', 'AdminAuth\Students\Messages\CrudeController@studentMessages')->name('messages_student');
Route::get('/students/messages/viewstudentmessage/{message}', 'AdminAuth\Students\Messages\CrudeController@viewStudentMessages');
Route::post('/students/messages/deletemessageforstaffer/{message}/{user}', 'AdminAuth\Students\Messages\CrudeController@deleteMessageForStaffer');

//messages and replies to students
Route::get('/students/messages/sendmessagetostudent/{user}', 'AdminAuth\Students\Messages\CrudeController@sendMessageToStudent');
Route::post('/students/messages/postsendmessagetostudent/{user}', 'AdminAuth\Students\Messages\CrudeController@postSendMessageToStudent');
Route::get('/students/messages/replystudentmessage/{message}', 'AdminAuth\Students\Messages\CrudeController@replyStudentMessage');
Route::post('/students/messages/postreplystudentmessage/{message}', 'AdminAuth\Students\Messages\CrudeController@postReplyStudentMessage');



//statistics
Route::get('/admin/stats/showstatstypes', 'AdminAuth\Stats\StatsCrudeController@showStatsTypes');

//super admin setup page

Route::group(['middleware' => 'superadmin'], function () {  
    
    Route::get('schoolsetup', 'AdminAuth\SetUpController@schoolSetUp');
    Route::post('schoolsetup', 'AdminAuth\SetUpController@update_logo');
    
    Route::get('/schoolsetup/showschoolyear', 'AdminAuth\SchoolYearSetUpController@showSchoolYear')->name('showschoolyear');
    Route::get('/schoolsetup/addschoolyear', 'AdminAuth\SchoolYearSetUpController@addSchoolYear');
    Route::post('/schoolsetup/postaddschoolyear', 'AdminAuth\SchoolYearSetUpController@postAddSchoolYear');
    Route::get('/schoolsetup/deleteschoolyear/{schoolyear}', 'AdminAuth\SchoolYearSetUpController@deleteSchoolYear');
    Route::get('/schoolsetup/editschoolyear/{schoolyear}', 'AdminAuth\SchoolYearSetUpController@editSchoolYear');
    Route::post('/schoolsetup/postschoolyearupdate/{schoolyear}', 'AdminAuth\SchoolYearSetUpController@postSchoolYearUpdate');

    Route::get('/schoolsetup/terms/schoolyears', 'AdminAuth\TermSetUpController@schoolYears');
    Route::get('/schoolsetup/showterms/{schoolyear}', 'AdminAuth\TermSetUpController@showTerms')->name('setupshowterms');
    Route::get('/schoolsetup/addterm/{schoolyear}', 'AdminAuth\TermSetUpController@addTerm');
    Route::post('/schoolsetup/postterm/{schoolyear}', 'AdminAuth\TermSetUpController@postTerm');
    Route::get('/schoolsetup/editterm/{schoolyear}/{term}', 'AdminAuth\TermSetUpController@editTerm');
    Route::post('/schoolsetup/posttermupdate/{term}', 'AdminAuth\TermSetUpController@postTermUpdate');
    Route::get('/schoolsetup/posttermdelete/{term}', 'AdminAuth\TermSetUpController@deleteTerm');

    Route::get('/schoolsetup/showgroups', 'AdminAuth\GroupSetUpController@showGroups');
    Route::get('/schoolsetup/addgroup', 'AdminAuth\GroupSetUpController@addGroup');
    Route::post('/schoolsetup/postgroup', 'AdminAuth\GroupSetUpController@postGroup');
    Route::get('/schoolsetup/editgroup/{group}', 'AdminAuth\GroupSetUpController@editGroup');
    Route::post('/schoolsetup/postgroupupdate/{group}', 'AdminAuth\GroupSetUpController@postGroupUpdate');
    Route::get('/schoolsetup/postgroupdelete/{group}', 'AdminAuth\GroupSetUpController@deleteGroup');

    Route::get('/schoolsetup/courses/schoolyears', 'AdminAuth\CourseSetUpController@schoolYears');
    Route::get('/schoolsetup/showcoursesterms/{schoolyear}', 'AdminAuth\CourseSetUpController@showCoursesTerms');
    Route::get('/schoolsetup/showcoursesgroups/{schoolyear}/{term}', 'AdminAuth\CourseSetUpController@showCoursesGroups');
    Route::get('/schoolsetup/showcourses/{schoolyear}/{term}/{group}', 'AdminAuth\CourseSetUpController@showCourses')->name('showcourses');
    Route::get('/schoolsetup/addcourse/{schoolyear}/{term}/{group}', 'AdminAuth\CourseSetUpController@addCourse');
    Route::post('/schoolsetup/postcourse/{schoolyear}/{term}/{group}', 'AdminAuth\CourseSetUpController@postCourse');
    Route::get('/schoolsetup/editcourse/{schoolyear}/{course}/{term}/{group}', 'AdminAuth\CourseSetUpController@editCourse');
    Route::post('/schoolsetup/postcourseupdate/{course}/{term}/{group}', 'AdminAuth\CourseSetUpController@postCourseUpdate');
    Route::get('/schoolsetup/postcoursedelete/{course}', 'AdminAuth\CourseSetUpController@deleteCourse');
    Route::post('/schoolsetup/importcourses/{term}/{group}', 'AdminAuth\CourseSetUpController@importCourses');

    //Assign and unAssign courses to instructors
    Route::get('/schoolsetup/assigncourse/{course}/{group}/{term}', 'AdminAuth\Courses\AssignUnassignController@assignCourse');
    Route::post('/schoolsetup/postassigncourse/{course}/{group}/{term}', 'AdminAuth\Courses\AssignUnassignController@postAssignCourse');
    Route::post('/schoolsetup/postunassigncourse/{course}', 'AdminAuth\Courses\AssignUnassignController@postUnassignCourse');

    Route::get('/schoolsetup/students/showgroups', 'AdminAuth\Students\SetUpController@showGroups');
    Route::get('/schoolsetup/students/showregisteredstudents/{group}', 'AdminAuth\Students\SetUpController@showStudents')->name('showstudents');
    Route::get('/schoolsetup/students/addstudent/{group}', 'AdminAuth\Students\SetUpController@addStudent');


    Route::get('/schoolsetup/students/addnewstudents', 'AdminAuth\Students\SetUpController@addNewStudents');
    Route::post('/schoolsetup/students/postaddnewstudents', 'AdminAuth\Students\SetUpController@postAddNewStudents');
    Route::get('/schoolsetup/students/viewallstudents', 'AdminAuth\Students\SetUpController@viewAllStudents')->name('viewallstudents');



    Route::post('/schoolsetup/students/poststudent/{group}', 'AdminAuth\Students\SetUpController@postStudent');
    Route::get('/schoolsetup/students/editstudent/{group}/{student}', 'AdminAuth\Students\SetUpController@editStudent');
    Route::post('/schoolsetup/students/poststudentupdate/{group}/{student}', 'AdminAuth\Students\SetUpController@postStudentUpdate');
    Route::get('/schoolsetup/students/poststudentdelete/{student}', 'AdminAuth\Students\SetUpController@deleteStudent');
    Route::post('/schoolsetup/students/importstudents/{group}', 'AdminAuth\Students\SetUpController@importStudents');

    Route::get('/schoolsetup/staffers/showstaffers', 'AdminAuth\Staffers\SetUpController@showStaffers')->name('showstaffers');
    Route::get('/schoolsetup/staffers/addstaffer', 'AdminAuth\Staffers\SetUpController@addStaffer');
    Route::post('/schoolsetup/staffers/poststaffer', 'AdminAuth\Staffers\SetUpController@postStaffer');
    Route::get('/schoolsetup/staffers/editstaffer/{staffer}', 'AdminAuth\Staffers\SetUpController@editStaffer');
    Route::post('/schoolsetup/staffers/poststafferupdate/{staffer}', 'AdminAuth\Staffers\SetUpController@postStafferUpdate');
    Route::get('/schoolsetup/staffers/poststafferdelete/{staffer}', 'AdminAuth\Staffers\SetUpController@deleteStaffer');
    Route::post('/schoolsetup/staffers/importstaffers', 'AdminAuth\Staffers\SetUpController@importStaffers');

    Route::get('/schoolsetup/feetypes/showfeetypes', 'AdminAuth\FeeTypes\SetUpController@showFeeTypes')->name('showfeetypes');
    Route::get('/schoolsetup/feetypes/addfeetype', 'AdminAuth\FeeTypes\SetUpController@addFeeType');
    Route::post('/schoolsetup/feetypes/postfeetype', 'AdminAuth\FeeTypes\SetUpController@postFeeType');
    Route::get('/schoolsetup/feetypes/editfeetype/{feetype}', 'AdminAuth\FeeTypes\SetUpController@editfeetype');
    Route::post('/schoolsetup/feetypes/postfeetypeupdate/{feetype}', 'AdminAuth\FeeTypes\SetUpController@postFeeTypeUpdate');
    Route::get('/schoolsetup/feetypes/postfeetypedelete/{feetype}', 'AdminAuth\FeeTypes\SetUpController@deleteFeeType');

    Route::get('/schoolsetup/fees/showfees', 'AdminAuth\Fees\SetUpController@showFees')->name('showfees');
    Route::get('/schoolsetup/fees/addfee', 'AdminAuth\Fees\SetUpController@addFee');
    Route::post('/schoolsetup/fees/postfee', 'AdminAuth\Fees\SetUpController@postFee');
    Route::get('/schoolsetup/fees/editfee/{fee}/{group}/{term}/{feetype}', 'AdminAuth\Fees\SetUpController@editFee');
    Route::post('/schoolsetup/fees/postfeeupdate/{fee}/{group}/{term}/{feetype}', 'AdminAuth\Fees\SetUpController@postFeeUpdate');
    Route::get('/schoolsetup/fees/postfeedelete/{fee}', 'AdminAuth\Fees\SetUpController@deleteFee');

    Route::get('/schoolsetup/eventtypes/showeventtypes', 'AdminAuth\EventTypes\SetUpController@showeventTypes')->name('showeventtypes');
    Route::get('/schoolsetup/eventtypes/addeventtype', 'AdminAuth\EventTypes\SetUpController@addeventType');
    Route::post('/schoolsetup/eventtypes/posteventtype', 'AdminAuth\EventTypes\SetUpController@postEventType');
    Route::get('/schoolsetup/eventtypes/editeventtype/{eventtype}', 'AdminAuth\EventTypes\SetUpController@editEventType');
    Route::post('/schoolsetup/eventtypes/posteventtypeupdate/{eventtype}', 'AdminAuth\EventTypes\SetUpController@postEventTypeUpdate');
    Route::get('/schoolsetup/eventtypes/posteventtypedelete/{eventtype}', 'AdminAuth\EventTypes\SetUpController@deleteEventType');

    Route::get('/schoolsetup/events/showevents', 'AdminAuth\Events\SetUpController@showEvents')->name('showevents');
    Route::get('/schoolsetup/events/addevent', 'AdminAuth\Events\SetUpController@addEvent');
    Route::post('/schoolsetup/events/postevent', 'AdminAuth\Events\SetUpController@postEvent');
    Route::get('/schoolsetup/events/editevent/{event}/{group}/{term}/{eventtype}', 'AdminAuth\Events\SetUpController@editEvent');
    Route::post('/schoolsetup/events/posteventupdate/{event}/{group}/{term}/{eventtype}', 'AdminAuth\Events\SetUpController@postEventUpdate');
    Route::get('/schoolsetup/events/posteventdelete/{event}', 'AdminAuth\Events\SetUpController@deleteEvent');

    //Attendance Code
    Route::get('/schoolsetup/attendancecodes/showcodes', 'AdminAuth\AttendanceCodes\SetUpController@showCodes')->name('showattendancecodes');
    Route::get('/schoolsetup/attendancecodes/addcode', 'AdminAuth\AttendanceCodes\SetUpController@addCode');
    Route::post('/schoolsetup/attendancecodes/postcode', 'AdminAuth\AttendanceCodes\SetUpController@postCode');
    Route::get('/schoolsetup/attendancecodes/editcode/{code}', 'AdminAuth\AttendanceCodes\SetUpController@editCode');
    Route::post('/schoolsetup/attendancecodes/postcodeupdate/{code}', 'AdminAuth\AttendanceCodes\SetUpController@postCodeUpdate');
    Route::get('/schoolsetup/attendancecodes/postcodedelete/{code}', 'AdminAuth\AttendanceCodes\SetUpController@deleteCode');

    //School
    Route::get('/schoolsetup/schools/showschools', 'AdminAuth\Schools\SetUpController@showSchools')->name('showschools');
    Route::get('/schoolsetup/schools/addschool', 'AdminAuth\Schools\SetUpController@addSchool');
    Route::post('/schoolsetup/schools/postschool', 'AdminAuth\Schools\SetUpController@postSchool');
    Route::get('/schoolsetup/schools/editschool/{school}', 'AdminAuth\Schools\SetUpController@editSchool');
    Route::post('/schoolsetup/schools/postschoolupdate/{school}', 'AdminAuth\Schools\SetUpController@postSchoolUpdate');
    Route::get('/schoolsetup/schools/postschooldelete/{school}', 'AdminAuth\Schools\SetUpController@deleteSchool');

    //Messages-Contact us
    Route::get('/schoolsetup/messages/contactus', 'AdminAuth\Messages\MessagesController@contactUs');
    Route::get('/schoolsetup/messages/getcontactusdata', 'AdminAuth\Messages\MessagesController@getContactUsData');
    Route::get('/schoolsetup/messages/messagedetails/{message}', 'AdminAuth\Messages\MessagesController@messageDetails');
    Route::get('/schoolsetup/messages/postmessagedelete/{message}', 'AdminAuth\Messages\MessagesController@deleteMessage');

    //Login Activities
    Route::get('/schoolsetup/logs/studentsloginactivities', 'AdminAuth\LoginActivity\CrudeController@index');
    //Login Activities
    Route::get('/schoolsetup/logs/adminsloginactivities', 'AdminAuth\LoginActivity\AdminAuthActivityController@adminAuthActivities');



    


});

Route::group(['middleware' => 'headadmin'], function () { 

  Route::get('/headadmin/home', 'AdminAuth\HeadAdmin\HomeController@index'); 

  Route::get('/headadmin/students/showstudents', 'AdminAuth\HeadAdmin\StudentsController@showStudents')->name('headadmin.showstudents');
  Route::get('/headadmin/students/getstudentsdata', 'AdminAuth\HeadAdmin\StudentsController@getStudentsData');
  Route::get('/headadmin/students/showstudent/{student}', 'AdminAuth\HeadAdmin\StudentsController@showStudent');
  Route::get('/headadmin/students/showstudent/{student}/terms', 'AdminAuth\HeadAdmin\StudentsController@showStudentTerms');
  Route::get('/headadmin/students/{student}/terms/{term}/courses', 'AdminAuth\HeadAdmin\StudentsController@showStudentTermCourses');
});





});





//route for courses
Route::get('/courses', 'CourseController@index');
Route::get('/courses/{course}', 'CourseController@show');

//route for terms
//Route::get('/courses', 'CourseController@index');
Route::get('/terms/{courses}', 'TermController@show');

//route for report card
Route::get('/currentreportcard', 'CurrentReportCardController@index');

Route::get('/reportcards', 'ReportCardsController@index');
Route::get('/reportcards/{term}', 'ReportCardsController@show');

Route::get('/pdfreportcard/{term}', 'ReportCardsController@pdfshow');

//Attendance
Route::get('/attendances/terms', 'AttendancesController@showTerms');
Route::get('/attendances/days/{term}', 'AttendancesController@showDays');

//Daily Activities
Route::get('/dailyactivity/activities', 'DailyActivity\CrudeController@showActivities');

//Disciplinary Record Activities
Route::get('/discipline/records', 'Discipline\CrudeController@showDRecords');

//Messages and replies to Teacher
Route::get('/messages/messagetoteacher', 'Messages\MessageToTeacher\CrudeController@showMessages');
Route::get('/messages/viewmessage/{message}', 'Messages\MessageToTeacher\CrudeController@viewMessages');
Route::get('/messages/sendmessagetoteacher/{teacher}', 'Messages\MessageToTeacher\CrudeController@sendMessageToTeacher');
Route::post('/messages/postsendmessagetoteacher/{teacher}', 'Messages\MessageToTeacher\CrudeController@postSendMessageToTeacher');
