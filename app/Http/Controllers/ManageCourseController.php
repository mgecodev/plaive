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

        return view('ManageCourse')->with('name', $name)->with('type', $type)->with('id', $id);
    }

    public function showAll(Request $request) {
        // Input :
        // Output :
        // Description : show all the list of courses including official and mine

        $id = $request->user_id;
        $courses = Course::where('CreatedBy', 0)->orwhere('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowAllCourseAjax')->with('courses', $courses);
    }

    public function showMyCourse(Request $request) {


        $id = $request->user_id;
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowMyCourseAjax')->with('courses', $courses);
    }

    public function enroll(Request $request) {

        $id = $request->user_id;
        $courses = Course::where('CreatedBy', $id)->get();

        return view('EnrollCourseAjax')->with('courses', $courses);
    }

    public function deleteCourse(Request $request) {

        $course_id = $request->course_id;
        $id = $request->user_id;

        // dd($id);
        Course::where('CourseId', $course_id)->update(['Active' => 0]);
        $courses = Course::where('CreatedBy', $id)->where('Active', 1)->get();

        return view('ShowMyCourseAjax')->with('courses', $courses);
    }
}
