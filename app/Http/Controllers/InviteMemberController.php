<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteMemberController extends Controller
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

        $name = $user->Name;
        $id = $user->id;

        $type = AccountType::where('AccountTypeId', '=', $id)->first()->Type;
        $students = $this->showAllStudent();

        return view('InviteMember')->with('name', $name)->with('type', $type)->with('students', $students);
    }

    public function showAllStudent() {
        // Input : 
        // Output : Show whole accounts who have AccountTypeId as 1
        // Description : show the list of students for teacher to select the student who he/her wants

        $students = Account::where('AccountTypeId', 1)->get();
        // dd($students);
        return $students;
    }

    public function showInvitedStudent() {
        // Input :
        // Output :
        // Description :

    }

    public function saveStudent() {
        // Input :
        // Output : Save invited students to Invitation datatable 
        // Description : Save invited students to show everything in once
        $student_ids = $_POST['StudentIds'];
        dd($student_ids);
        
    }
}
