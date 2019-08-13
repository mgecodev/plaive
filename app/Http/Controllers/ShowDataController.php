<?php

namespace App\Http\Controllers;

use App\AccountType;
use Illuminate\Support\Facades\Auth;
use App\Channel;
use App\Account;
use Illuminate\Support\Facades\DB;
use App\Services\PayUService\Exception;
use Illuminate\Http\Request;

class ShowDataController extends Controller
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
    public function index(Channel $channel) 
    {

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $channel_id = $channel->ChannelId;
        $field_count = $channel->FieldCount;
        $table_name = $channel->TableName;
        for ($i=0;$i<$field_count;$i++) {
           $option[$i]['valid'] = "N";
           $option[$i]['day'] = null;
           $option[$i]['result'] = null;
           $option[$i]['dynamic'] = "N";

        }
        $options = Channel::find($channel_id)->options;
        foreach($options as $opt) {
            if($opt->FieldNumber<$field_count){
                $option[$opt->FieldNumber-1]['valid'] = "Y";
                $option[$opt->FieldNumber-1]["line_type"] = $opt->LineType;
                $option[$opt->FieldNumber-1]["x_label"] = $opt->Xlabel;
                $option[$opt->FieldNumber-1]["y_label"] = $opt->Ylabel;
                $option[$opt->FieldNumber-1]["graph_color"] = $opt->GraphColor;
                $option[$opt->FieldNumber-1]["back_color"] = $opt->BackColor;
                $option[$opt->FieldNumber-1]["day"] = $opt->Day;
                $option[$opt->FieldNumber-1]["result"] = $opt->Result;
                $option[$opt->FieldNumber-1]["min"] = $opt->Min;
                $option[$opt->FieldNumber-1]["max"] = $opt->Max;
                $option[$opt->FieldNumber-1]["dynamic"] = $opt->Dynamic;
            }
        }
        
        //dd($option);
        if ($field_count >= 1) {
            $field1_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw("Field1 as field1")
                        )
                        ->where('channelId',$channel_id)
                        ->where('Field1','<>','')
                        ->orderBy("created_at",'asc')
                        ->get();

            if(count($field1_data) == 0) {
                $option[0]['field_valid'] = "N"; 
            } else {
                $option[0]['field_valid'] = "Y"; 
            }
            $result1[] = ['Date','Field1'];
            foreach ($field1_data as $key => $value) {
                $result1[++$key] = [$value->datetime, (float)$value->field1];
            }
            $t_data[0] = $result1;
        }
        if ($field_count >= 2) {
            $field2_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw("Field2 as field2")
                        )
                        ->where('channelId',$channel_id)
                        ->where('Field2','<>','')
                        ->orderBy("created_at",'asc')
                        ->get();

            if(count($field2_data) == 0) {
                $option[1]['field_valid'] = "N"; 
            } else {
                $option[1]['field_valid'] = "Y"; 
            }

            $result2[] = ['Date','Field2'];
            foreach ($field2_data as $key => $value) {
                $result2[++$key] = [$value->datetime, (float)$value->field2];
            }
            $t_data[1] = $result2;
        }
        if ($field_count >= 3) {
            $field3_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw("Field3 as field3")
                        )
                        ->where('channelId',$channel_id)
                        ->where('Field3','<>','')
                        ->orderBy("created_at",'asc')
                        ->get();

            if(count($field3_data) == 0) {
                $option[2]['field_valid'] = "N"; 
            } else {
                $option[2]['field_valid'] = "Y"; 
            }
            $result3[] = ['Date','Field3'];
            foreach ($field3_data as $key => $value) {
                $result3[++$key] = [$value->datetime, (float)$value->field3];
            }
            $t_data[2] = $result3;
        }
        if ($field_count >= 4) {
            $field4_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw("Field4 as field4")
                        )
                        ->where('channelId',$channel_id)
                        ->where('Field4','<>','')
                        ->orderBy("created_at",'asc')
                        ->get();

            if(count($field4_data) == 0) {
                $option[3]['field_valid'] = "N"; 
            } else {
                $option[3]['field_valid'] = "Y"; 
            }
            $result4[] = ['Date','Field4'];
            foreach ($field4_data as $key => $value) {
                $result4[++$key] = [$value->datetime, (float)$value->field4];
            }
            $t_data[3] = $result4;
        }
        if ($field_count >= 5) {
            $field5_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw("Field5 as field5")
                        )
                        ->where('channelId',$channel_id)
                        ->where('Field5','<>','')
                        ->orderBy("created_at",'asc')
                        ->get();

            if(count($field5_data) == 0) {
                $option[4]['field_valid'] = "N"; 
            } else {
                $option[4]['field_valid'] = "Y"; 
            }
            $result5[] = ['Date','Field5'];
            foreach ($field5_data as $key => $value) {
                $result5[++$key] = [$value->datetime, (float)$value->field5];
            }
            $t_data[4] = $result5;
        }
        if ($field_count >= 6) {
            $field6_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw("Field6 as field6")
                        )
                        ->where('channelId',$channel_id)
                        ->where('Field6','<>','')
                        ->orderBy("created_at",'asc')
                        ->get();

            if(count($field6_data) == 0) {
                $option[5]['field_valid'] = "N"; 
            } else {
                $option[5]['field_valid'] = "Y"; 
            }
            $result6[] = ['Date','Field6'];
            foreach ($field6_data as $key => $value) {
                $result6[++$key] = [$value->datetime, (float)$value->field6];
            }
            $t_data[5] = $result6;
        }
        if ($field_count >= 7) {
            $field7_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw("Field7 as field7")
                        )
                        ->where('channelId',$channel_id)
                        ->where('Field7','<>','')
                        ->orderBy("created_at",'asc')
                        ->get();

            if(count($field7_data) == 0) {
                $option[6]['field_valid'] = "N"; 
            } else {
                $option[6]['field_valid'] = "Y"; 
            }
            $result7[] = ['Date','Field7'];
            foreach ($field7_data as $key => $value) {
                $result7[++$key] = [$value->datetime, (float)$value->field7];
            }
            $t_data[6] = $result7;
        }
        if ($field_count >= 8) {
            $field8_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw("Field8 as field8")
                        )
                        ->where('channelId',$channel_id)
                        ->where('Field8','<>','')
                        ->orderBy("created_at",'asc')
                        ->get();

            if(count($field8_data) == 0) {
                $option[7]['field_valid'] = "N"; 
            } else {
                $option[7]['field_valid'] = "Y"; 
            }
            $result8[] = ['Date','Field8'];
            foreach ($field8_data as $key => $value) {
                $result8[++$key] = [$value->datetime, (float)$value->field8];
            }
            $t_data[7] = $result8;
        }
        //$data = DB::table($table_name)->where('ChannelId',$channel_id)->get();
        //$channels = Account::find($id)->channels;

        //return $channels;
        return view('ShowData',compact('channel'))->with('option', json_encode($option))->with('data', json_encode($t_data))->with('name', $name)->with('type', $type);
    }
}
