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

use App\Account;
use App\AccountType;

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {

    $user = Auth::user();
    if ($user == NULL) {

        $id = NULL;
        $type = NULL;
        $name = NULL;

    }
    else {

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
    }

    return view('index')->with('id', $id)->with('type', $type)->with('name', $name);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
// Route::get('/home', 'HomeController@index')->redirect('/');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout'); // Do not remove this code
Route::post('/SaveCourseInfo', 'CourseController@saveCourseInfo');
// Route::get('/showCourseInfo', 'CourseController@showCourseInfo');

Route::get('/class', function () {
    return view('ClassIndex');
});
Route::get('/ManageClass', 'ManageClassController@index');
Route::get('/ManageClass/Enroll', 'ManageClassController@enroll');
Route::get('/Class/{classid}/{board_flag?}', 'ManageClassController@enterClass');
Route::get('/Class/{classid}/{courseworkid}/{weekcount}', 'ManageClassController@checkCoursework');
Route::post('/saveMyFootprint', 'ManageClassController@saveMyFootprint');
Route::post('/Invite', 'ManageClassController@inviteAdditionalMember');
Route::post('/ManageClass/IncludeStudent', 'ManageClassController@includeStudent');
Route::patch('/ManageClass/IncludeStudent/{class_id}', 'ManageClassController@updateStudent');
Route::patch('/ManageClass/ReInvite/{invitation_id}','ManageClassController@ReInvite');
Route::patch('/ManageClass/DenyStudent/{invitation_id}','ManageClassController@denyStudent');
Route::patch('/ManageClass/EmitStudent/{invitation_id}','CheckInvitationController@emitStudent');
Route::patch('/ManageClass/DeleteClass', 'ManageClassController@deleteClass');

Route::get('/EnrollCourseDetail/{course_id}', 'ManageCourseController@enrollDetail');
Route::get('/ReadCourseDetail/{course_id}', 'ManageCourseController@readonlyDetail');
Route::get('/ManageCourse', 'ManageCourseController@index');
Route::get('/ManageCourse/ShowAll', 'ManageCourseController@showAll');
Route::get('/ManageCourse/MyList', 'ManageCourseController@showMyCourse');
Route::get('/ManageCourse/Enroll', 'ManageCourseController@enroll');
Route::get('/ManageCourse/{CourseId}/Specific', 'ManageCourseController@setSpecific');
Route::post('/ManageCourse/EnrollCourse', 'ManageCourseController@enrollCourse');
Route::post('/ManageCourse/DeleteCourse', 'ManageCourseController@deleteCourse');
Route::post('/ManageCourse/UpdateCourse', 'ManageCourseController@updateCourse');
Route::post('/ManageCourse/SaveCurriculum', 'ManageCourseController@saveCurriculum');
Route::patch('/ManageCourse/SaveCurriculum', 'ManageCourseController@updateCurriculum');

Route::get('/MyClass/{state?}', 'CheckInvitationController@showMyClass');
Route::get('/CheckInvitation', 'CheckInvitationController@index');
Route::post('/AcceptInvitation', 'CheckInvitationController@acceptInvitation');
Route::post('/DenyInvitation', 'CheckInvitationController@denyInvitation');
Route::get('/CheckInvitation/student/realtime', 'CheckInvitationController@RealTimeStudent');
Route::get('/CheckInvitation/teacher/realtime', 'CheckInvitationController@RealTimeTeacher');

Route::post('/SaveStudent', 'InviteMemberController@saveStudent');

Route::get('ClassBoard', function () {
    return view('ClassBoard');
});

Route::get('/ManageDevice', 'ChannelController@index');
Route::get('/CreateDevice', 'ChannelController@createIndex');
Route::post('/CreateDevice', 'ChannelController@create');
Route::get('/EditDevice/{channel}/edit', 'ChannelController@edit');
Route::patch('/EditDevice/{channel}', 'ChannelController@update');
Route::patch('/DeleteDevice/{channel}', 'ChannelController@destroy');
Route::get('/SaveData','SaveDataController@save');
Route::get('/DownloadData/{channel}','ShowDataController@download');
Route::get('/ShowData/{channel}','ShowDataController@index');
Route::get('/ShowData/DynamicData/{channel}/{index}','ShowDataController@dynamic');
Route::post('/SaveOption/{channel}','SaveDataController@saveOption');
Route::patch('/SaveOption/{graphOption}','SaveDataController@updateOption');
Route::patch('/ShowData/DeleteData/{channel}/{index}','SaveDataController@deleteData');

Route::get('/MainBoard','BoardController@index');
Route::get('/CreateBoard/{type}/{class_id?}','BoardController@create');
Route::post('/CreateBoard/{type}/{class_id?}','BoardController@save');
Route::get('/ShowBoard/{type}/{board}/{class_id?}','BoardController@show');
Route::get('/DownloadFile/{file}','BoardController@fileDownload');
Route::get('/EditBoard/{type}/{board}/edit/{class_id?}','BoardController@edit');
Route::patch('/UpdateBoard/{type}/{board}/{class_id?}','BoardController@update');
Route::patch('/DeleteBoard/{type}/{board}','BoardController@destroy');

Route::patch('/DeleteBoardFile/{boardFile}', 'BoardFileController@destroy');
Route::get('/ShowStatus/{class_id}/{coursework_id}','ManageClassController@showStatus');
Route::get('/ShowStatus/student/data/{class_id}/{coursework_id}','ManageClassController@getStatus');
