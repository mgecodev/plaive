<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpenClassController extends Controller
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

        return view('OpenClass')->with('name', $name)->with('type', $type);
    }


}
