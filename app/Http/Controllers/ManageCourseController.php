<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountType;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index() {

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $courses = Course::where('CreatedBy', 0)->orwhere('CreatedBy', $id)->where('Active', 1)->get();

        return view('ManageCourse')->with('name', $name)->with('type', $type)->with('id', $id)->with('courses', $courses);
    }

    public function showAll(Request $request) {
        // Input :
        // Output :
        // Description : show all the list of courses including official and mine

        $id = $request->_userid;
        $courses = Course::where('CreatedBy', 0)->orwhere('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowAllCourseAjax')->with('courses', $courses);
    }

    public function showMyCourse(Request $request) {


        $id = $request->_userid;
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowMyCourseAjax')->with('courses', $courses);
    }

    public function enroll(Request $request) {

        $id = $request->user_id;
        return view('EnrollCourseAjax')->with('id', $id);
    }

    public function enrollCourse(Request $request) {
        // Input :
        // Output :
        // Description :

        $course_id = $request->_courseid;
        $title = $request->_title;
        $comment = $request->_comment;
        $num_of_student = $request->_numofstudent;
        $weekcount = $request->_weekcount;
        $hourcount = $request->_hourcount;
        $prerequisite = $request->_prerequisite;

        $id = $request->_userid;
        Course::create(['Title' => $title, 'Comment' => $comment, 'NumOfStudent' => $num_of_student, 'WeekCount' => $weekcount, 'HourCount' => $hourcount, 'Prerequisite' => $prerequisite, 'CreatedBy' => $id]);
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();

        return view('EnrollCourseAjax')->with('courses', $courses)->with('id', $id);

    }

    public function deleteCourse(Request $request) {

        $course_id = $request->course_id;
        $id = $request->_userid;

        Course::where('CourseId', $course_id)->update(['Active' => 0]);
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowMyCourseAjax')->with('courses', $courses);
    }

    public function updateCourse(Request $request) {
        // Input :
        // Output :
        // Description :

        $course_id = $request->_courseid;
        $title = $request->_title;
        $comment = $request->_comment;
        $num_of_student = $request->_numofstudent;
        $weekcount = $request->_weekcount;
        $hourcount = $request->_hourcount;

        $id = $request->_userid;

        Course::where('CourseId', $course_id)->update(['Title' => $title, 'Comment' => $comment, 'NumOfStudent' => $num_of_student, 'WeekCount' => $weekcount, 'HourCount' => $hourcount]);
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();
        // dd($courses);
        return view('ShowMyCourseAjax')->with('courses', $courses);
    }
}
