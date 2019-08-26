<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\InfoClass;
use App\Account;
use App\Course;
use App\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function index($board_flag=NULL) {
        // Input :
        // Output :
        // Description : show all the list of classes that teacher takes in charge of

        //dd($action_type);
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $courses = Course::where('CreatedBy', $id)->orwhere('CreatedBy', 0)->where('Active', 1)->get();
        $classes = $this->showClassInfo($id);
        return view('ManageClass')->with('classes', $classes)->with('name', $name)->with('type', $type)->with('id', $id)->with('board_flag',$board_flag)->with('courses',$courses);
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

    public function deleteClass(Request $request) {
        // Input :
        // Output :
        // Description : delete class
        $nowdate = date('Y-m-d H:i:s');
        $class_id = $request->_classid;
        $delete = InfoClass::where("ClassId", $class_id)->update(["Active" => 0,'updated_at' => $nowdate]);
        if ($delete) {
            return response()->json([
                'result' => 'Success'            
            ]);
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
        //return redirect('/home');
    }
    public function enroll(Request $request) {
        // Input :
        // Output :
        // Description : click the 클래스 등록 in side bar which goes to page that can enroll the class using Ajax.
        //                  This function should be accompanied with course data that user can choose before they invite students
        //                  In addition, they need to show the information for students who teacher can go through

        $id = $request->user_id;

        $courses = Course::where('CreatedBy', $id)->orwhere('CreatedBy', 0)->where('Active', 1)->get();    // get the public courses and their own courses
        $students = Account::where('AccountTypeId', 1)->get();  // get all the students

        return view('EnrollClassAjax')->with('id', $id)->with('courses', $courses)->with('students', $students);
    }

    public function enrollClass() {


    }

    public function enterClass($class_id, $board_flag=null, Request $request) {
        // Input :
        // Output :
        // Description :

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        $class = InfoClass::where('ClassId', $class_id)->where('Active', 1)->first(); // get one class out of specific teacher's
        $tot_invited_students = $class->getUserInfo()->where("ClassId", $class_id)->get();
        $tot_accepted_students = $class->getMatchedStudent()->where("ClassId", $class_id)->where('Accepted', 1)->get();

        $tot_viable_students = Account::where("Active", 1)->where("AccountTypeId", 1)->get();   // get students
        $boards = DB::table('Boards')->where('BoardType','Class')->where('Active',1)->where('TopFix','Y')->where('ClassId',$class_id)->orderBy('created_at','desc')->get();
        $down_boards = DB::table('Boards')->where('BoardType','Class')->where('Active',1)->where('TopFix','N')->where('ClassId',$class_id)->orderBy('created_at','desc')->get();
        $boards = $boards->merge($down_boards);
//        foreach($students as $student) {
//
//            $tmp = $student->checkInvitation()->where("ClassId", "<>", $class_id)->get()->toarray();
//            if ($tmp == NULL or count($tmp) == 0) continue;
//            else {
//                var_dump($tmp);
//            }
//        }
//        die();

//        $tot_viable_students = $students->checkInvitation()->where("ClassId", "<>", $class_id)->get();
//        dd($tot_viable_students);
        return view('EnterClass')->with('class', $class)->with('name', $name)->with('type', $type)->with('id', $id)->with('tot_viable_students', $tot_viable_students)->with('class_id', $class_id)->with('tot_invited_students', $tot_invited_students)->with('tot_accepted_students', $tot_accepted_students)->with('boards',$boards)->with('board_flag',$board_flag);
    }

    public function inviteAdditionalMember($board_flag=null, Request $request) {
        // Input :
        // Output :
        // Description : 1. Check if he/she is already invited
        //               2. If it is not invited, invite him and refresh page
        //               3. If it is invited, I don't know

        $user = Auth::user();   // get user
        $id = $user->id;        // get user id

        $ids = $request->ids;
        $ids = explode(',', $ids);

        $student_id = $ids[0];  // get student id
        $teacher_id = $ids[1];  // get teacher id
        $class_id = $ids[2];    // get class id

        Invitation::create([
            'InviterId' => $teacher_id,
            'InviteeId' => $student_id,
            'ClassId' => $class_id,
            'Accepted' => 0,
        ]);

        $class = InfoClass::where('ClassId', $class_id)->where('Active', 1)->first(); // get one class out of specific teacher's
        $tot_invited_students = $class->getUserInfo()->where("ClassId", $class_id)->get();
        $tot_accepted_students = $class->getMatchedStudent()->where("ClassId", $class_id)->where('Accepted', 1)->get();
        $students = Account::where('Active', 1)->get();
        $tot_viable_students = array();

        foreach($students as $student) {

            $cnt = $student->checkInvitation()->where("ClassId", $class_id)->count();

            if ($cnt == 0) {
                array_push($tot_viable_students, $student);
            }
            else {
                continue;
            }
        }


        //        dd($tot_viable_students);
//        return view('StudentManagementAjax')->with('id', $id)->with('class_id', $class_id)->with('class', $class)->with('tot_invited_students', $tot_invited_students)->with('tot_accepted_students', $tot_accepted_students)->with('tot_viable_students', $tot_viable_students)->with('board_flag', $board_flag);
        return 0;
    }

    public function acceptInvitation() {
        // Input :
        // Output :
        // Description : change 'accepted' as 1 and add this student into class member table


    }

    public function showMyClass(Request $request) {
        // Input :
        // Output :
        // Description : show my class

    }

    public function includeStudent(Request $request) {
        // Input :
        // Output :
        // Description :    1. Make class first
        //                  2. Get ClassId and invite students
        //dd($request->all());
        if($request->hasFile('class_image')){
            $file = $request->file('class_image');
            $file_name = $file->getClientOriginalName();
            $path = Storage::disk('s3')->put('plaive/class_image',$file,'public');
            $s3_url = "https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/".$path;
        } else {
            $s3_url = null;
        }
        $temp_student_ids = $request->_checked_students;
        $student_ids = explode(',',$temp_student_ids);
        $course_id = $request->_courseid;
        $user_id = $request->_teacherid;

        // save new class
        $insert1 = InfoClass::create([
            "AccountId" => $user_id,
            "CourseId" => $course_id,
            "ClassName" => $request->class_name,
            "ClassImage" => $s3_url,
            "Active" => 1
        ]);
        $class_id = InfoClass::where("AccountId", $user_id)->where("CourseId", $course_id)->first()->ClassId;   // get new class id

        // invite all the students that teacher selected
        foreach($student_ids as $student_id) {

//            var_dump("here");

            $insert2 = Invitation::create([
                "InviterId" => $user_id,
                "InviteeId" => $student_id,
                "ClassId" => $class_id,
                "Accepted" => 0
            ]);

        }
        if ($insert1 && $insert2) {
            return response()->json([
                'result' => 'Success'            
            ]);
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
    }
    public function updateStudent(InfoClass $class_id,Request $request) {
        $nowdate = date('Y-m-d H:i:s');
        if($request->hasFile('class_image')){
            $file = $request->file('class_image');
            $file_name = $file->getClientOriginalName();
            $path = Storage::disk('s3')->put('plaive/class_image',$file,'public');
            $s3_url = "https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/".$path;
        } else {
            $s3_url = $class_id->ClassImage;
        }
        if($request->_courseid == 0) {
            $course_id = $class_id->CourseId;
        } else {
            $course_id = $request->_courseid;
        }

        // update Class
        $update = InfoClass::where('ClassId',$class_id->ClassId)->update([
            "CourseId" => $course_id,
            "ClassName" => $request->class_name,
            "ClassImage" => $s3_url,
            "updated_at" => $nowdate,
            "Active" => 1
        ]);
        if ($update) {
            return response()->json([
                'result' => 'Success'            
            ]);
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
    }
}
