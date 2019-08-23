<?php

namespace App\Http\Controllers;

use App\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Account;
use App\Board;
use App\BoardFile;
use Illuminate\Support\Facades\DB;

class BoardFileController extends Controller
{
    //
    public function destroy($board_id) 
    {
        $board_file = BoardFile::where("FileId",$board_id)->first();
        $file_id = $board_file->FileId;
        $board_id = $board_file->BoardId;
        $nowdate = date('Y-m-d H:i:s');
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $delete = DB::table('BoardFiles')->where('FileId',$file_id)->update([
            'ModifierNo' => $id,
            'updated_at' => $nowdate,
            'Active' => 0,
        ]);

        $files= Board::find($board_id)->files;

        if ($delete) {
            return response()->json([
                'result' => 'Success',
                'files' => $files
            ]);
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
    }
}
