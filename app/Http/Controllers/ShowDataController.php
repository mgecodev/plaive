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
           $option[$i]['Id'] = 0;
        }
        $options = Channel::find($channel_id)->options;
        foreach($options as $opt) {
            if($opt->FieldNumber<=$field_count){
                $option[$opt->FieldNumber-1]['valid'] = "Y";
                $option[$opt->FieldNumber-1]['Id'] = $opt->OptionId;
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
            if(is_null($option[0]['day']) && is_null($option[0]['result'])) {
                $field1_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field1 as field1")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field1','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit(100)
                            ->get();

                $field1_data = $field1_data->reverse()->values();
            } else if (is_null($option[0]['day']) && !is_null($option[0]['result'])) {
                $field1_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field1 as field1")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field1','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit($option[0]['result'])
                            ->get();
                $field1_data = $field1_data->reverse()->values();
            } else if (!is_null($option[0]['day']) && is_null($option[0]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[0]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field1_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field1 as field1")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field1','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit(100)
                            ->get();
            } else if (!is_null($option[0]['day']) && !is_null($option[0]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[0]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field1_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field1 as field1")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field1','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit($option[0]['result'])
                            ->get();
            }
            if(count($field1_data) == 0) {
                $option[0]['field_valid'] = "N"; 
            } else {
                $option[0]['field_valid'] = "Y";
                $option[0]['last_field'] = $field1_data->last()->datetime; 
            }
            $result1[] = ['Date','Field1'];
            foreach ($field1_data as $key => $value) {
                $result1[++$key] = [$value->datetime, (float)$value->field1];
            }
            $t_data[0] = $result1;
        }
        if ($field_count >= 2) {
            if(is_null($option[1]['day']) && is_null($option[1]['result'])) {
                $field2_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field2 as field2")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field2','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit(100)
                            ->get();
                $field2_data = $field2_data->reverse()->values();
            } else if (is_null($option[1]['day']) && !is_null($option[1]['result'])) {
                $field2_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field2 as field2")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field2','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit($option[1]['result'])
                            ->get();
                $field2_data = $field2_data->reverse()->values();
            } else if (!is_null($option[1]['day']) && is_null($option[1]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[1]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field2_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field2 as field2")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field2','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit(100)
                            ->get();
            } else if (!is_null($option[1]['day']) && !is_null($option[1]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[1]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field2_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field2 as field2")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field2','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit($option[1]['result'])
                            ->get();
            }

            if(count($field2_data) == 0) {
                $option[1]['field_valid'] = "N"; 
            } else {
                $option[1]['field_valid'] = "Y";
                $option[1]['last_field'] = $field2_data->last()->datetime;  
            }

            $result2[] = ['Date','Field2'];
            foreach ($field2_data as $key => $value) {
                $result2[++$key] = [$value->datetime, (float)$value->field2];
            }
            $t_data[1] = $result2;
        }
        if ($field_count >= 3) {
            if(is_null($option[2]['day']) && is_null($option[2]['result'])) {
                $field3_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field3 as field3")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field3','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit(100)
                            ->get();
                $field3_data = $field3_data->reverse()->values();
            } else if (is_null($option[2]['day']) && !is_null($option[2]['result'])) {
                $field3_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field3 as field3")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field3','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit($option[2]['result'])
                            ->get();
                $field3_data = $field3_data->reverse()->values();
            } else if (!is_null($option[2]['day']) && is_null($option[2]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[2]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field3_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field3 as field3")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field3','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit(100)
                            ->get();
            } else if (!is_null($option[2]['day']) && !is_null($option[2]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[2]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field3_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field3 as field3")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field3','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit($option[2]['result'])
                            ->get();
            }

            if(count($field3_data) == 0) {
                $option[2]['field_valid'] = "N"; 
            } else {
                $option[2]['field_valid'] = "Y";
                $option[2]['last_field'] = $field3_data->last()->datetime;   
            }
            $result3[] = ['Date','Field3'];
            foreach ($field3_data as $key => $value) {
                $result3[++$key] = [$value->datetime, (float)$value->field3];
            }
            $t_data[2] = $result3;
        }
        if ($field_count >= 4) {
            if(is_null($option[3]['day']) && is_null($option[3]['result'])) {
                $field4_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field4 as field4")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field4','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit(100)
                            ->get();
                $field4_data = $field4_data->reverse()->values();
            } else if (is_null($option[3]['day']) && !is_null($option[3]['result'])) {
                $field4_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field4 as field4")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field4','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit($option[3]['result'])
                            ->get();
                $field4_data = $field4_data->reverse()->values();
            } else if (!is_null($option[3]['day']) && is_null($option[3]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[3]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field4_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field4 as field4")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field4','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit(100)
                            ->get();
            } else if (!is_null($option[3]['day']) && !is_null($option[3]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[3]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field4_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field4 as field4")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field4','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit($option[3]['result'])
                            ->get();
            }

            if(count($field4_data) == 0) {
                $option[3]['field_valid'] = "N"; 
            } else {
                $option[3]['field_valid'] = "Y";
                $option[3]['last_field'] = $field4_data->last()->datetime;    
            }
            $result4[] = ['Date','Field4'];
            foreach ($field4_data as $key => $value) {
                $result4[++$key] = [$value->datetime, (float)$value->field4];
            }
            $t_data[3] = $result4;
        }
        if ($field_count >= 5) {
            if(is_null($option[4]['day']) && is_null($option[4]['result'])) {
                $field5_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field5 as field5")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field5','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit(100)
                            ->get();
                $field5_data = $field5_data->reverse()->values();
            } else if (is_null($option[4]['day']) && !is_null($option[4]['result'])) {
                $field5_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field5 as field5")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field5','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit($option[4]['result'])
                            ->get();
                $field5_data = $field5_data->reverse()->values();
            } else if (!is_null($option[4]['day']) && is_null($option[4]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[4]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field5_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field5 as field5")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field5','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit(100)
                            ->get();
            } else if (!is_null($option[4]['day']) && !is_null($option[4]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[4]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field5_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field5 as field5")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field5','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit($option[4]['result'])
                            ->get();
            }

            if(count($field5_data) == 0) {
                $option[4]['field_valid'] = "N"; 
            } else {
                $option[4]['field_valid'] = "Y";
                $option[4]['last_field'] = $field5_data->last()->datetime; 
            }
            $result5[] = ['Date','Field5'];
            foreach ($field5_data as $key => $value) {
                $result5[++$key] = [$value->datetime, (float)$value->field5];
            }
            $t_data[4] = $result5;
        }
        if ($field_count >= 6) {
            if(is_null($option[5]['day']) && is_null($option[5]['result'])) {
                $field6_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field6 as field6")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field6','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit(100)
                            ->get();
                $field6_data = $field6_data->reverse()->values();
            } else if (is_null($option[5]['day']) && !is_null($option[5]['result'])) {
                $field6_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field6 as field6")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field6','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit($option[5]['result'])
                            ->get();
                $field6_data = $field6_data->reverse()->values();
            } else if (!is_null($option[5]['day']) && is_null($option[5]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[5]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field6_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field6 as field6")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field6','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit(100)
                            ->get();
            } else if (!is_null($option[5]['day']) && !is_null($option[5]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[5]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field6_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field6 as field6")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field6','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit($option[5]['result'])
                            ->get();
            }

            if(count($field6_data) == 0) {
                $option[5]['field_valid'] = "N"; 
            } else {
                $option[5]['field_valid'] = "Y";
                $option[5]['last_field'] = $field6_data->last()->datetime; 
            }
            $result6[] = ['Date','Field6'];
            foreach ($field6_data as $key => $value) {
                $result6[++$key] = [$value->datetime, (float)$value->field6];
            }
            $t_data[5] = $result6;
        }
        if ($field_count >= 7) {
            if(is_null($option[6]['day']) && is_null($option[6]['result'])) {
                $field7_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field7 as field7")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field7','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit(100)
                            ->get();
                $field7_data = $field7_data->reverse()->values();
            } else if (is_null($option[6]['day']) && !is_null($option[6]['result'])) {
                $field7_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field7 as field7")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field7','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit($option[6]['result'])
                            ->get();
                $field7_data = $field7_data->reverse()->values();
            } else if (!is_null($option[6]['day']) && is_null($option[6]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[6]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field7_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field7 as field7")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field7','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit(100)
                            ->get();
            } else if (!is_null($option[6]['day']) && !is_null($option[6]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[6]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field7_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field7 as field7")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field7','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit($option[6]['result'])
                            ->get();
            }

            if(count($field7_data) == 0) {
                $option[6]['field_valid'] = "N"; 
            } else {
                $option[6]['field_valid'] = "Y";
                $option[6]['last_field'] = $field7_data->last()->datetime; 
            }
            $result7[] = ['Date','Field7'];
            foreach ($field7_data as $key => $value) {
                $result7[++$key] = [$value->datetime, (float)$value->field7];
            }
            $t_data[6] = $result7;
        }
        if ($field_count >= 8) {
            if(is_null($option[7]['day']) && is_null($option[7]['result'])) {
                $field8_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field8 as field8")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field8','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit(100)
                            ->get();
                $field8_data = $field8_data->reverse()->values();
            } else if (is_null($option[7]['day']) && !is_null($option[7]['result'])) {
                $field8_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field8 as field8")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field8','<>','')
                            ->orderBy("created_at",'desc')
                            ->limit($option[7]['result'])
                            ->get();
                $field8_data = $field8_data->reverse()->values();
            } else if (!is_null($option[7]['day']) && is_null($option[7]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[7]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field8_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field8 as field8")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field8','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit(100)
                            ->get();
            } else if (!is_null($option[7]['day']) && !is_null($option[7]['result'])) {
                $today = date('Y-m-d');
                $user_day = $option[7]['day'];
                $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
                $field8_data = DB::table($table_name)
                            ->select(
                                DB::raw("created_at as datetime"),
                                DB::raw("Field8 as field8")
                            )
                            ->where('channelId',$channel_id)
                            ->where('Field8','<>','')
                            ->whereDate('created_at','>=',$beforeDay)
                            ->orderBy("created_at",'asc')
                            ->limit($option[7]['result'])
                            ->get();
            }
            if(count($field8_data) == 0) {
                $option[7]['field_valid'] = "N"; 
            } else {
                $option[7]['field_valid'] = "Y";
                $option[7]['last_field'] = $field8_data->last()->datetime; 
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
    public function dynamic(Request $request, Channel $channel, $index) 
    {
        $channel_id = $channel->ChannelId;
        $field_count = $channel->FieldCount;
        $table_name = $channel->TableName;

        $option = $request->option;
        $r_index = $index + 1;
        $field_name = "Field".$r_index;
        $as_name = "field".$r_index;

        if(is_null($option['day']) && is_null($option['result'])) {
            $field_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw($field_name.' as '.$as_name)
                        )
                        ->where('channelId',$channel_id)
                        ->where($field_name,'<>','')
                        ->orderBy("created_at",'desc')
                        ->limit(100)
                        ->get();
            $field_data = $field_data->reverse()->values();
        } else if (is_null($option['day']) && !is_null($option['result'])) {
            $field_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw($field_name.' as '.$as_name)
                        )
                        ->where('channelId',$channel_id)
                        ->where($field_name,'<>','')
                        ->orderBy("created_at",'desc')
                        ->limit($option['result'])
                        ->get();
            $field_data = $field_data->reverse()->values();
        } else if (!is_null($option['day']) && is_null($option['result'])) {
            $today = date('Y-m-d');
            $user_day = $option['day'];
            $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
            $field_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw($field_name.' as '.$as_name)
                        )
                        ->where('channelId',$channel_id)
                        ->where($field_name,'<>','')
                        ->whereDate('created_at','>=',$beforeDay)
                        ->orderBy("created_at",'asc')
                        ->limit(100)
                        ->get();
        } else if (!is_null($option['day']) && !is_null($option['result'])) {
            $today = date('Y-m-d');
            $user_day = $option['day'];
            $beforeDay = date("Y-m-d", strtotime($today." -$user_day day"));
            $field_data = DB::table($table_name)
                        ->select(
                            DB::raw("created_at as datetime"),
                            DB::raw($field_name.' as '.$as_name)
                        )
                        ->where('channelId',$channel_id)
                        ->where($field_name,'<>','')
                        ->whereDate('created_at','>=',$beforeDay)
                        ->orderBy("created_at",'asc')
                        ->limit($option['result'])
                        ->get();
        }
        if($field_data->last()->datetime != $option['last_field']){
            $result[] = ['Date',$field_name];
                foreach ($field_data as $key => $value) {
                    $result[++$key] = [$value->datetime, (float)$value->$as_name];
            }
            return response()->json([
                'result' => 'Y',
                'data' => $result,
                'last' => $field_data->last()->datetime
            ]);
        } else {
            return response()->json([
                'result' => "N"
            ]);
        }
    }
    public function download(Request $request, Channel $channel)
    {
        $csvExporter = new \Laracsv\Export();
        $channel_id = $channel->ChannelId;
        $field_count = $channel->FieldCount;
        $table_name = $channel->TableName;
        $channel_name = $channel->ChannelName;

        $data = DB::table($table_name)->where('ChannelId',$channel_id)->orderby('created_at','asc')->get();
        return $csvExporter->build($data, ['Field1','Field2','Field3','Field4','Field5','Field6','Field7','Field8','created_at'=>'입력 일자'])->download($channel_name.'.csv');
    } 
}
