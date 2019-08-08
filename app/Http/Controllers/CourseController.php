<?php


namespace App\Http\Controllers;

use App;
use App\AccountType;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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

        $type = AccountType::where('AccountTypeId', '=', $id)->first()->Type;

        $courses_info = $this->showCourseInfo();
        // dd($courses_info);
        return view('ManageClass')->with('courses_info', $courses_info)->with('name', $name)->with('type', $type);
    }

    public function saveCourseInfo() {

        // get data from post method
        $user_id = Auth::user()->id;
        $title = $_POST['title'];
        $num_of_books = $_POST['num_of_books'];
        $stars = $_POST['stars'];
        $period = $_POST['period'];
        $description = $_POST['description'];

        $course_info = new Course;

        $course_info->user_id = $user_id;
        $course_info->title = $title;
        $course_info->num_of_books = $num_of_books;
        $course_info->stars = $stars;
        $course_info->period = $period;
        $course_info->description = $description;

        $course_info->save(); // save the course

        return redirect('/OpenClass');
    }

    public function showCourseInfo() {

        $course_info = App\Course::all();
        return $course_info;
    }
}
