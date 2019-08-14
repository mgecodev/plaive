<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountType;
use App\Invitation;
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

        $name = $user->name;
        $id = $user->id;
  
        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

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

    public function saveStudent(Request $request) {
        // Input :
        // Output : Save invited students to Invitation datatable 
        // Description : Save invited students to show everything in once
        
        $user = Auth::user();

        $name = $user->Name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $students = Account::wherein('id', $request->student_ids)->get(); // get data from ajax
        
        foreach($students as $student) {

            Invitation::create([
                'InviterId' => $id,
                'InviteeId' => $student->id,
                'ClassId' => 1,
                'Accepted' => 0,
            ]);
        }

        return view('InviteMemberAjax')->with('name', $name)->with('type', $type)->with('students', $students);
    }
}
