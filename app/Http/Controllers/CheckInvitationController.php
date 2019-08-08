<?php


namespace App\Http\Controllers;

use App;
use App\AccountType;
use App\Account;
use App\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $name = $user->Name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $invitations = Invitation::where('InviteeId', '=', $id)->get();

        return view('CheckInvitation')->with('invitations', $invitations)->with('name', $name)->with('type', $type);
    }

 
}
