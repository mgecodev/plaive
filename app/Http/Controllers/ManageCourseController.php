<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountType;
use App\Course;
use App\Coursework;
use App\SubCoursework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ManageCourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $courses = Course::where('CreatedBy', 0)->orwhere('CreatedBy', $id)->where('Active', 1)->get();

        return view('ManageCourse')->with('name', $name)->with('type', $type)->with('id', $id)->with('courses', $courses);
    }

    public function showAll(Request $request)
    {
        // Input :
        // Output :
        // Description : show all the list of courses including official and mine

        $id = $request->_userid;
        $courses = Course::where('CreatedBy', 0)->orwhere('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowAllCourseAjax')->with('courses', $courses);
    }

    public function showMyCourse(Request $request)
    {


        $id = $request->_userid;
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowMyCourseAjax')->with('courses', $courses);
    }

    public function enroll(Request $request)
    {

        $id = $request->user_id;
        return view('EnrollCourseAjax')->with('id', $id);
    }

    public function enrollCourse(Request $request)
    {
        // Input :
        // Output :
        // Description :
        //dd($request->all());
        if($request->hasFile('course_image')) {
            $file = $request->file('course_image');
            $file_name = $file->getClientOriginalName();
            $path = Storage::disk('s3')->put('plaive/course_image',$file,'public');
            $s3_url = "https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/".$path;
        } else {
            $s3_url = null;
        }
        $title = $request->_title;
        $comment = $request->_comment;
        $num_of_student = $request->_numofstudent;
        $weekcount = $request->_weekcount;
        $hourcount = $request->_hourcount;
        $prerequisite = $request->_prerequisite;
        $id = $request->_userid;
        Course::create(['Title' => $title, 'Comment' => $comment, 'NumOfStudent' => $num_of_student,'CourseImage' => $s3_url, 'WeekCount' => $weekcount, 'HourCount' => $hourcount, 'Prerequisite' => $prerequisite, 'CreatedBy' => $id]);
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowMyCourseAjax')->with('courses', $courses);
    }

    public function deleteCourse(Request $request)
    {

        $course_id = $request->_courseid;
        $id = $request->_userid;

        Course::where('CourseId', $course_id)->update(['Active' => 0]);
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowMyCourseAjax')->with('courses', $courses);
    }

    public function updateCourse(Request $request)
    {
        // Input :
        // Output :
        // Description :
        if($request->hasFile('course_image')) {
            $file = $request->file('course_image');
            $file_name = $file->getClientOriginalName();
            $path = Storage::disk('s3')->put('plaive/course_image',$file,'public');
            $s3_url = "https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/".$path;
        } else {
            $s3_url = null;
        }

        $course_id = $request->_courseid;
        $title = $request->_title;
        $comment = $request->_comment;
        $num_of_student = $request->_numofstudent;
        $weekcount = $request->_weekcount;
        $hourcount = $request->_hourcount;
        $prerequisite = $request->_prerequisite;
        $id = $request->_userid;

        if($s3_url == null ) {
            Course::where('CourseId', $course_id)->update(['Title' => $title, 'Comment' => $comment, 'NumOfStudent' => $num_of_student, 'Prerequisite' => $prerequisite, 'WeekCount' => $weekcount, 'HourCount' => $hourcount]);
        } else {
            Course::where('CourseId', $course_id)->update(['Title' => $title, 'Comment' => $comment, 'NumOfStudent' => $num_of_student, 'Prerequisite' => $prerequisite, 'CourseImage' => $s3_url, 'WeekCount' => $weekcount, 'HourCount' => $hourcount]);
        }
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();
        // dd($courses);
        return view('ShowMyCourseAjax')->with('courses', $courses);
    }

    public function saveCurriculum(Request $request)
    {
        // Input :
        // Output :
        // Description : save all the data from curriculum that teacher wrote

        $course_id = $request->_courseid;
        $courseworks = $request->_courseworks;
        $subcourseworks = $request->_subcourseworks;
        $week = $request->_week;
        for($i=1;$i<=$week;$i++){
            if(isset($courseworks[$i])) {
                $temp[$i] = Coursework::create([
                    'CourseId' => $course_id,
                    'WeekNumber' => $i,
                    'Content' => $courseworks[$i],
                ]);
            }
        }
        for($j=1;$j<=$week;$j++){
            if(isset($subcourseworks[$j])) {
                for($k=1;$k<count($subcourseworks[$j]);$k++){
                    $create = SubCoursework::create([
                        'CourseworkId' => $temp[$j]->CourseworkId,
                        'Content' => $subcourseworks[$j][$k],
                        'ContentNumber' => $k
                    ]);
                }
            }
        }

        return 0;
    }
    function enrollDetail($course_id)
    {
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        $course = Course::where('CourseId',$course_id)->where('Active',1)->first();
        if(!$course){

        } else {
            $courseworks = $course->getCoursework()->where('Active',1)->orderby('WeekNumber','asc')->get();
            $subcourseworks = $course->getSubCourseworks()->where('SubCourseworks.Active',1)->where('Courseworks.Active',1)->orderby('SubCourseworks.CourseworkId','asc')->get();
            if(count($courseworks) < 1) {
                return view('EnrollDetailCourse',compact('courseworks'))->with('name', $name)->with('type', $type)->with('id', $id)->with('course', $course);
            } else {
                return view('UpdateDetailCourse',compact('courseworks'))->with('name', $name)->with('type', $type)->with('id', $id)->with('course', $course)->with('subcourseworks',$subcourseworks);
            }
        }
    }
    function updateCurriculum(Request $request) 
    {
        $course_id = $request->_courseid;
        $courseworks = $request->_courseworks;
        $subcourseworks = $request->_subcourseworks;
        $week = $request->_week;
        for($i=1;$i<=$week;$i++){
            if(isset($courseworks[$i])) {
                $temp[$i] = Coursework::updateOrCreate(
                    ['WeekNumber'=>$i, 'CourseId'=>$course_id],
                    ['Content' => $courseworks[$i],'Active' => 1]
                );
            }
        }

        for($j=1;$j<=$week;$j++){
            if(isset($subcourseworks[$j])) {
                for($k=1;$k<count($subcourseworks[$j]);$k++){
                    $update = SubCoursework::updateOrCreate(
                        ['CourseworkId'=>$temp[$j]->CourseworkId, 'ContentNumber'=>$k],
                        ['Content' => $subcourseworks[$j][$k],'Active' => 1]
                    );
                    if($update){
                        if(isset($count_update[$j])) {
                            $count_update[$j]++;
                        } else {
                            $count_update[$j] = 1;
                        }
                    }
                }
            }
        }
        for($t=1;$t<=$week;$t++) {
            $coursework = Coursework::where('CourseId',$course_id)->where('WeekNumber',$t)->where('Active',1)->first();
            if(!$coursework) {
            } else {
                if(!isset($count_update[$t])){
                    $count_update[$t] = 0;
                }
                $delete = SubCoursework::where('CourseworkId',$coursework->CourseworkId)->where('ContentNumber','>',$count_update[$t])->update([
                    'Active'=> 0
                ]);
            }
        }
        return 0;
    }

    public function setSpecific($course_id, Request $request) {

        dd($course_id);
    }
}
