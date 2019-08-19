<?php

namespace App\Http\Controllers;

use App\InfoClass;
use App\Account;
use App\Course;
use App\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageClassController extends Controller
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
        // Input :
        // Output :
        // Description : show all the list of classes that teacher takes in charge of

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        $classes = $this->showClassInfo($id);
        // dd($courses_info);
        return view('ManageClass')->with('classes', $classes)->with('name', $name)->with('type', $type)->with('id', $id);
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

    public function showClassInfo($id) {
        // Input :
        // Output : get the list of classes
        // Description : show all the classes that teacher takes in charge of

        $classes = InfoClass::where('AccountId', $id)->where('Active', 1)->get();

        return $classes;
    }

    public function showAllClass($request) {
        // Input :
        // Output :
        // Description : show all the courses that user have made

        $user_id = $request->user_id;


    }

    public function deleteClass() {



    }
    public function enroll(Request $request) {
        // Input :
        // Output :
        // Description : click the 클래스 등록 in side bar which goes to page that can enroll the class using Ajax

        $id = $request->user_id;

        return view('EnrollClassAjax')->with('id', $id);
    }

    public function enrollClass() {


    }
}
