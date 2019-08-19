<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BoardFile;
use App\Board;

class BoardFileController extends Controller
{
    //
    public function destroy($board_id) 
    {
        //$delete = $board_file->delete();
        $board_file = BoardFile::where("FileId",$board_id)->first();
        $board_id = $board_file->BoardId;
        $delete = $board_file->delete();
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
