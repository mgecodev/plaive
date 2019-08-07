<?php

namespace App\Http\Controllers;

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

        $name = $user->Name;
        $id = $user->id;

        $type = AccountType::where('AccountTypeId', '=', $id)->first()->Type;

        return view('OpenClass')->with('name', $name)->with('type', $type);
    }


}
