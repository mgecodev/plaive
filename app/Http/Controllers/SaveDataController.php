<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Channel;
use App\GraphOption;

class SaveDataController extends Controller
{
    public function save(Request $request)
    {
        try {
            $channel = Channel::where('ApiKey', '=', $request->api_key)->first();
            $table_name = $channel->TableName;
            $channel_id = $channel->ChannelId;

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
            $insert = $table->insert(
                ['ChannelId' => $channel_id, 'Field1' => $field1, 'Field2' => $field2, 'Field3' => $field3,
                 'Field4' => $field4 , 'Field5' => $field5, 'Field6' => $field6, 'Field7' => $field7, 'Field8' => $field8,
                 'created_at' => $nowdate, 'updated_at' => $nowdate]
            );

            if($insert) {
                return response()->json([
                    'error_code' => '0000'
                ]);
            } else {
                return response()->json([
                    'error_code' => '1000'
                ]);
            }
        } catch(\Exception $e){
            return response()->json([
                'error_code' => '2000'
            ]);
        }
    }
    public function saveOption(Request $request,Channel $channel) {
        $nowdate = date('Y-m-d H:i:s');
        $request->merge(['ChannelId' => $channel->ChannelId,'created_at'=>$nowdate,'updated_at'=>$nowdate]);
        GraphOption::create($request->all());
        return back();
    }

    public function updateOption(Request $request, $graph) {
        $nowdate = date('Y-m-d H:i:s');
        $request->merge(['updated_at'=>$nowdate]);
        GraphOption::find($graph)->update($request->all());
        return back();
    }

    public function deleteData(Request $request, Channel $channel, $index) 
    {
        $channel_id = $channel->ChannelId;
        $table_name = $channel->TableName;
        $field_name = 'Field'.$index;

        $update = DB::table($table_name)->where('ChannelId',$channel_id)->update([$field_name => NULL]);
        return response()->json([
            'result' => $update
        ]);
    }
}
