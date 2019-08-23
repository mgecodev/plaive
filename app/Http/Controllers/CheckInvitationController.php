<?php


namespace App\Http\Controllers;

use App;
use App\AccountType;
use App\Account;
use App\Invitation;
use App\ClassMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckInvitationController extends Controller
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
        $invitations = Invitation::where('InviteeId', '=', $id)->where('Accepted', 0)->get();   // get the data which is not accepted and whose invitee is the user

        return view('CheckInvitation')->with('invitations', $invitations)->with('name', $name)->with('type', $type);
    }

    public function acceptInvitation(Request $request) {
        // Input :
        // Output :
        // Description : change the value of accept as 1 and add account info into classMember table
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;    // get user id

        $invitation_id = $request->invitation_id;

        $class_id = Invitation::where('InvitationId', $invitation_id)->first()->ClassId;   // get class id

        Invitation::where('InvitationId', $invitation_id)->update(['Accepted' => 1]);   // update the accepted col

        // create member in ClassMember table
        ClassMember::create([
            'ClassId' => $class_id,
            'AccountId' => $id,
            'Active' => 1
        ]);
        $invitations = Invitation::where('InviteeId', '=', $id)->where('Accepted', 0)->get();   // get the data which is not accepted and whose invitee is the user

        return view('CheckInvitationAjax')->with('invitations', $invitations)->with('name', $name);
//        return redirect('/CheckInvitation');

    }

    public function denyInvitation(Request $request) {
        // Input :
        // Output :
        // Description : erase invitation record in Invitation table

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;    // get user id

        $invitation_id = $request->invitation_id;

        $class_id = Invitation::where('InvitationId', $invitation_id)->first()->ClassId;   // get class id. This code should be better!

        Invitation::where('InvitationId', $invitation_id)->delete();   // delete the accepted col

        // create member in ClassMember table
        ClassMember::create([
            'ClassId' => $class_id,
            'AccountId' => $id,
            'Active' => 1
        ]);

        $invitations = Invitation::where('InviteeId', '=', $id)->where('Accepted', 0)->get();   // get the data which is not accepted and in which invitee is the user

        return view('CheckInvitationAjax')->with('invitations', $invitations)->with('name', $name);
    }

    public function showMyClass(Request $request) {
        // Input :
        // Output :
        // Description : show my class that I have dived into

        $user = Auth::user();   // get user

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $my_classes = ClassMember::where('AccountId', $id)->orderBy('ClassMemberId', 'desc')->get();  // get the class that user participate in

        return view('MyClass')->with('my_classes', $my_classes)->with('type', $type)->with('name', $name);
    }
}
