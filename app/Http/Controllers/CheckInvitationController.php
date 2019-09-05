<?php


namespace App\Http\Controllers;

use App;
use App\AccountType;
use App\Account;
use App\Invitation;
use App\ClassMember;
use App\InfoClass;
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
        $invitations = DB::table('Invitations')
            ->join('InfoClasses', 'Invitations.ClassId', '=', 'InfoClasses.ClassId')
            ->where('Invitations.Accepted', '=', 0)
            ->where('InfoClasses.Active', '=', 1)
            ->where('Invitations.Active', '=', 1)
            ->where('Invitations.InviteeId', '=', $id)
            ->select('InfoClasses.ClassName', 'Invitations.InvitationId')
            ->get();
        //$invitations = Invitation::where('InviteeId', '=', $id)->where('Accepted', 0)->get();   // get the data which is not accepted and whose invitee is the user
        return view('CheckInvitation')->with('invitations', $invitations)->with('name', $name)->with('type', $type);
    }

    public function acceptInvitation(Request $request)
    {
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
        // consider duplicated creating class member
        ClassMember::updateOrCreate(
            [
                'ClassId' => $class_id,
                'AccountId' => $id
            ],

            [
                'ClassId' => $class_id,
                'AccountId' => $id,
                'Active' => 1
            ]);

//        ClassMember::create([
//            'ClassId' => $class_id,
//            'AccountId' => $id,
//            'Active' => 1
//        ]);

        $invitations = DB::table('Invitations')
            ->join('InfoClasses', 'Invitations.ClassId', '=', 'InfoClasses.ClassId')
            ->where('Invitations.Accepted', '=', 0)
            ->where('InfoClasses.Active', '=', 1)
            ->where('Invitations.Active', '=', 1)
            ->where('Invitations.InviteeId', '=', $id)
            ->select('InfoClasses.ClassName', 'Invitations.InvitationId')
            ->get();
        //$invitations = Invitation::where('InviteeId', '=', $id)->where('Accepted', 0)->get();   // get the data which is not accepted and whose invitee is the user

        return view('CheckInvitationAjax')->with('invitations', $invitations)->with('name', $name);
//        return redirect('/CheckInvitation');

    }

    public function denyInvitation(Request $request)
    {
        // Input :
        // Output :
        // Description : erase invitation record in Invitation table

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;    // get user id

        $invitation_id = $request->invitation_id;

        $class_id = Invitation::where('InvitationId', $invitation_id)->first()->ClassId;   // get class id. This code should be better!

        Invitation::where('InvitationId', $invitation_id)->update(['Accepted' => 2]);   // update the accepted col

        $invitations = DB::table('Invitations')
            ->join('InfoClasses', 'Invitations.ClassId', '=', 'InfoClasses.ClassId')
            ->where('Invitations.Accepted', '=', 0)
            ->where('InfoClasses.Active', '=', 1)
            ->where('Invitations.Active', '=', 1)
            ->where('Invitations.InviteeId', '=', $id)
            ->select('InfoClasses.ClassName', 'Invitations.InvitationId')
            ->get();   // get the data which is not accepted and in which invitee is the user

        return view('CheckInvitationAjax')->with('invitations', $invitations)->with('name', $name);

    }

    public function showMyClass($state = 'Init', Request $request)
    {
        // Input :
        // Output :
        // Description : show my class that I have dived into
        $user = Auth::user();   // get user

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $my_classes = DB::table('InfoClasses')
            ->join('ClassMembers', 'InfoClasses.ClassId', '=', 'ClassMembers.ClassId')
            ->where('ClassMembers.AccountId', '=', $id)
            ->where('InfoClasses.Active', '=', 1)
            ->where('ClassMembers.Active', '=', 1)
            ->select('InfoClasses.ClassName', 'InfoClasses.ClassImage', 'ClassMembers.ClassId', 'ClassMembers.ClassMemberId')
            ->orderBy('ClassMembers.ClassMemberId', 'desc')
            ->get();

        //$my_classes = ClassMember::where('AccountId', $id)->where('Active',1)->orderBy('ClassMemberId', 'desc')->get();  // get the class that user participate in

        return view('MyClass')->with('my_classes', $my_classes)->with('type', $type)->with('name', $name)->with('message', $state);
    }

    public function emitStudent($invitation, Request $request)
    {
        $update = Invitation::where('InvitationId', $invitation)->update([
            'Active' => 0
        ]);
        $update2 = ClassMember::where('ClassId', $request->_classid)->where('AccountId', $request->_userid)->update([
            'Active' => 0
        ]);
        if ($update && $update2) {
            return response()->json([
                'result' => 'Success'
            ]);
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
    }

    public function RealTimeStudent(Request $request)
    {
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $invitations = DB::table('Invitations')
            ->join('InfoClasses', 'Invitations.ClassId', '=', 'InfoClasses.ClassId')
            ->where('Invitations.Accepted', '=', 0)
            ->where('InfoClasses.Active', '=', 1)
            ->where('Invitations.Active', '=', 1)
            ->where('Invitations.InviteeId', '=', $id)
            ->select('InfoClasses.ClassName', 'Invitations.InvitationId')
            ->get();
        //$invitations = Invitation::where('InviteeId', '=', $id)->where('Accepted', 0)->get();   // get the data which is not accepted and whose invitee is the user
        if ($request->_count != count($invitations)) {
            return view('CheckInvitationAjax')->with('invitations', $invitations)->with('name', $name)->with('message', 'Success');
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
    }

    public function RealTimeTeacher(Request $request)
    {

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $class_id = $request->class_id;
        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $class = InfoClass::where('ClassId', $class_id)->where('Active', 1)->first(); // get one class out of specific teacher's
        $tot_accepted_students = $class->getMatchedStudent()->where("ClassId", $class_id)->where('Accepted', 1)->where('Active', 1)->get();
        $tot_denied_students = $class->getMatchedStudent()->where("ClassId", $class_id)->where('Accepted', 2)->where('Active', 1)->get();

        if ($request->accept_count != count($tot_accepted_students) || $request->deny_count != count($tot_denied_students)) {
            $tot_invited_students = DB::table('Accounts')
                ->join('Invitations', 'Invitations.InviteeId', '=', 'Accounts.id')
                ->where('Invitations.ClassId', '=', $class_id)
                ->where('Accounts.Active', '=', 1)
                ->where('Invitations.Active', '=', 1)
                ->select('Accounts.name', 'Accounts.id', 'Accounts.email', 'Invitations.Accepted', 'Invitations.InvitationId')
                ->get();

            return view('TeacherRealTime')->with('tot_invited_students', $tot_invited_students)->with('tot_accepted_students', $tot_accepted_students)->with('tot_denied_students', $tot_denied_students)->with('class_id', $class_id)->with('type', $type);
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
    }
}
