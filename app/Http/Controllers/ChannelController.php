<?php

namespace App\Http\Controllers;

use App\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Channel;
use App\Account;

class ChannelController extends Controller
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
        $channels = Account::find($id)->channels;

        //return $channels;
        return view('Channels.index',compact('channels'))->with('name', $name)->with('type', $type);
    }
}
