<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['homeroute']='HomeController/index';
$route['courseroute'] = 'CourseController/Course';
$route['batchroute']='BatchController/Batch';
$route['subjectroute']='SubjectController/Subject';
$route['dashroute']='DashController/Dashboard';
$route['changepassroute']='ChangepassController/Changepass';
$route['coursevalidation']='CourseController/insertCourse';
$route['editcourse/(:any)']='CourseController/EditCourse';
$route['batchvalidation']='BatchController/insertbatch';
$route['subjectvalidation']='SubjectController/insertsubject';
$route['add/(:any)'] = 'CourseController/EditCourse/$1';
$route['itemsDelete/(:any)'] = 'CourseController/deleteCourse/$1';
$route['addbatch/(:any)'] = 'BatchController/EditBatch/$1';
$route['batchDelete/(:any)'] = 'BatchController/deleteBatch/$1';
$route['addsubject/(:any)'] = 'SubjectController/EditSubject/$1';
$route['subjectDelete/(:any)'] = 'SubjectController/deleteSubject/$1';
$route['batchchangestatusroute'] ='BatchController/changeStatus';
$route['mapsubject']='CourseController/mapSubejct';
$route['mapbatch'] = 'CourseController/mapBatch';
$route['coursechangestatusroute'] = 'CourseController/changeStatus';
$route['subchangestatusroute']='SubjectController/changeStatus';
$route['admininfo']='DashController/fetchAdminInfo';
$route['changepass']='ChangepassController/updatePwd';
$route['logoutroute']='StudloginController/logout';


$route['loginroute']='StudloginController/Studlogin';
$route['studInforoute']='StudInfoController/StudInfo';
$route['studdatatableroute']='StudDatatableController/StudDatatable';
$route['studdocroute']='StudDocController/StudDocument';
$route['studdocpage']='StudDocPageController/StudDocPage';
$route['studdocid/(:any)']='StudDocPageController/EditDoc/$1';
$route['studforgotpass']='forgetpassController/Studforgotpass';
$route['studresetPass']='resetPasswordController/StudResetPass';
$route['studImage']='StudloginController/uploadimage';
$route['validation'] = 'StudInfoController/Validstudent';
$route['AddDocPageValid'] = 'StudDocPageController/studDocValid';
$route['AddAdminLoginValid']='StudloginController/LoginAdmin';
$route['displaystudent']='StudDatatableController/getStudentData';
$route['edit/(:any)']='StudInfoController/EditStudent/$1';
$route['docDelete/(:any)'] = 'StudDocController/deleteDoc/$1';
$route['deletede/(:any)']='StudDocController/deleteDoc/$1';
$route['changeStudStatus']='StudInfoController/changeStudentStatus';
$route['Add/(:any)'] = 'StudDocController/EditDoc/$1';
$route['mapstudentbatch']='StudInfoController/mapStudentBatch';
$route['changepassword']='StudloginController/Chanage_Password';

$route['quesbankroute']='QuesBankController/QuesBank';
$route['QuesBank1']='QuesBankController/QuesBank1';
$route['selectqueroute']='selectQuestionController/SelectQue';
$route['multiplechroute'] = 'MultiplechController/MultipleChoice';
$route['multiplechroute1'] = 'MultiplechController/addque';
$route['multiplechroute2'] = 'Multiplech2Controller/addque';
$route['truefalseroute'] = 'TrueFalseController/TrueFalse';
$route['truefalseroute1'] = 'TrueFalseController/addque';
$route['fillblankroute']='FillBlankController/FillBlank';
$route['sequencetyperoute']='SequenceTypeController/SequenceType';
$route['sequencetyperoute1']='SequenceTypeController/addsequencetype';
$route['matchthefollowroute']='MatchthefollowController/MatchtheFollow';
$route['matchthefollowroute1']='MatchthefollowController/addmatchpair';
$route['multiplech2route']='Multiplech2Controller/MultipleChoice2';
$route['dropdown']='dropdowncontroller/dropdown';
$route['delete/(:any)']='QuesBankController/deleteQuestion/$1';

$route['testcreationroute']='TestCreationController/TestCreation';
$route['addnewtestroute']='AddNewTestController/AddNewTest';
$route['addquesroute']='AddQuesController/AddQues';
$route['publishtestroute']='PublishTestController/PublishTest';
$route['assigntestroute']='AssignTestController/AssignTest';
$route['AddTest'] = 'AddNewTestController/createTest';
$route['publish'] = 'PublishTestController/displayTest';
$route['Quesset'] = 'AddQuesController/AddSet';
$route['getQuestion'] = 'AddQuesController/getQuestion';
$route['Publishque'] ='PublishTestController/Publishque';
$route['getAssign'] ='AssignTestController/getAssign';
$route['InsertAssign'] = 'AssignTestController/InsertAssignData';
$route['selectedQuestion'] ='AddQuesController/selectedQuestion';
$route['Test'] = 'TestCreationController/Test';
$route['Qsetroute'] ='QsetController/QuestionSet';
$route['Queset'] ='QsetController/Queset';
$route['Mapset'] ='AddNewTestController/MapSet';
$route['edit-test/(:any)']='AddNewTestController/editTest/$1';
$route['delete-test/(:any)'] ='AddNewTestController/deleteTest/$1';
$route['changestatus'] ='AddNewTestController/changeStatus';
$route['edit-set/(:any)'] ='AddNewTestController/editset/$1';
$route['edit-assign/(:any)']='AssignTestController/editAssign/$1';
$route['edit-publishTest/(:any)']='PublishTestController/editPublishTest/$1';
$route['delete-set/(:any)'] = 'QsetController/deleteQuesset/$1';
$route['changestatusqset'] ='QsetController/changeStatus';