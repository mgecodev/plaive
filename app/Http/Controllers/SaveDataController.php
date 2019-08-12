<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Channel;

class SaveDataController extends Controller
{
    //
    public function save(Request $request)
    {
        //dd($request);
        //dd($request->api_key);
        try {
            $channel = Channel::where('ApiKey', '=', $request->api_key)->first();
            $table_name = $channel->TableName;
            $channel_id = $channel->ChannelId;
            //dd($request->all()); 
            $nowdate = date('Y-m-d H:i:s');
            $field1 = NULL; 
            $field2 = NULL; 
            $field3 = NULL; 
            $field4 = NULL; 
            $field5 = NULL; 
            $field6 = NULL; 
            $field7 = NULL; 
            $field8 = NULL; 
 
            if($request->has('field1')){
                $field1 = $request->field1;
            }
            if($request->has('field2')){
                $field2 = $request->field2;
            }
            if($request->has('field3')){
                $field3 = $request->field3;
            }
            if($request->has('field4')){
                $field4 = $request->field4;
            }
            if($request->has('field5')){
                $field5= $request->field5;
            }
            if($request->has('field6')){
                $field6 = $request->field6;
            }
            if($request->has('field7')){
                $field7 = $request->field7;
            }
            if($request->has('field8')){
                $field8 = $request->field8;
            }

            $table = DB::table($table_name);
            $table->insert(
                ['ChannelId' => $channel_id, 'Field1' => $field1, 'Field2' => $field2, 'Field3' => $field3,
                 'Field4' => $field4 , 'Field5' => $field5, 'Field6' => $field6, 'Field7' => $field7, 'Field8' => $field8,
                 'created_at' => $nowdate, 'updated_at' => $nowdate]
            );
        } catch(\Exception $e){

        }
    }
}
