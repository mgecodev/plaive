<?php

namespace App\Http\Controllers;

use App\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Channel;
use App\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\PayUService\Exception;

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
    public function index() 
    {

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        $channels = Account::find($id)->channels;

        //return $channels;
        return view('Channels.index',compact('channels'))->with('name', $name)->with('type', $type);
    }

    public function createIndex() 
    {

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        $channels = Account::find($id)->channels;

        //return $channels;
        return view('Channels.createIndex',compact('channels'))->with('name', $name)->with('type', $type);
    }
    public function create(Request $request)
    {
        $user = Auth::user();
        $name = $user->name;
        $id = $user->id;

        $statement = DB::select("show table status where name = 'Channels'");
        $nextId = $statement[0]->Auto_increment;
        $pass_write = "write".$nextId;
        $api_temp = DB::select("select password('".$pass_write."') as write_key");
        $api_key = $api_temp[0]->write_key;

        $year = date('Y');
        $month = date('m');
        $table_name = 'SensorData'.$year.$month.'s';
        $nowdate = date('Y-m-d H:i:s');
        $request->merge(['AccountId'=>$id , 'ApiKey' => $api_key , 'TableName' => $table_name,'created_at'=>$nowdate,'updated_at'=>$nowdate]);
        //dd($request->all());
        Channel::create($request->all());
        return redirect('/ManageDevice');

    }
    public function edit(Channel $channel)
    {
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        //dd($channel);
        return view('Channels.edit',compact('channel'))->with('name', $name)->with('type', $type);  
    }
    public function update(Request $request, Channel $channel)
    {
        $nowdate = date('Y-m-d H:i:s');
        if(!$request->has('Field2Name')){
            $request->merge(['Field2Name'=>NULL]);
        }
        if(!$request->has('Field3Name')){
            $request->merge(['Field3Name'=>NULL]);
        }
        if(!$request->has('Field4Name')){
            $request->merge(['Field4Name'=>NULL]);
        }
        if(!$request->has('Field5Name')){
            $request->merge(['Field5Name'=>NULL]);
        }
        if(!$request->has('Field6Name')){
            $request->merge(['Field6Name'=>NULL]);
        }
        if(!$request->has('Field7Name')){
            $request->merge(['Field7Name'=>NULL]);
        }
        if(!$request->has('Field8Name')){
            $request->merge(['Field8Name'=>NULL]);
        }
        $request->merge(['updated_at'=>$nowdate]);
        //dd($request);
        $channel->update($request->all());
        return redirect('/ManageDevice'); 
    }
    public function destroy(Channel $channel)
    {
        //dd($channel);
        $nowdate = date('Y-m-d H:i:s');
        $delete = DB::table('Channels')->where('ChannelId',$channel->ChannelId)->update([
            'Active' => 0,
            'updated_at' => $nowdate,
        ]);
        if ($delete) {
            return response()->json([
                'result' => 'Success'
            ]);
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
        //return redirect('/ManageDevice');
    }
}
