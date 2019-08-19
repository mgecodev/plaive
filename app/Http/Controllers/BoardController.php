<?php

namespace App\Http\Controllers;

use App\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Account;
use App\Board;
use App\BoardFile;
use Illuminate\Support\Facades\DB;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {

        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        $top_boards = DB::table('Boards')->where('BoardType','All')->where('TopFix','Y')->orderBy('created_at','desc');
        $down_boards = DB::table('Boards')->where('BoardType','All')->where('TopFix','N')->orderBy('created_at','desc');
        $boards = $top_boards->union($down_boards)->get();
        /*$down_boards = Board::where('BoardType','All')->where('TopFix','N')->orderby('created_at','desc');
        $boards = Board::where('BoardType','All')->where('TopFix','Y')->orderby('created_at','desc')->get();*/
        return view('Boards.index',compact('boards'))->with('name', $name)->with('type', $type)->with('id',$id);
    }
    public function create($board_type)
    {
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        return view('Boards.create')->with('name', $name)->with('type', $type)->with('id',$id)->with('board_type',$board_type);
    }
    public function save(Request $request, $board_type)
    {
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $statement = DB::select("show table status where name = 'BoardFiles'");
        $nextId = $statement[0]->Auto_increment;

        $nowdate = date('Y-m-d H:i:s');

        if($request->hasFile('files')){
            $files = $request->file('files');
            foreach($files as $file){
                $file_name = $file->getClientOriginalName();
                $path = Storage::disk('s3')->put('plaive/AllDiscussion',$file,'public');
                $s3_url = "https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/".$path;
                DB::table('BoardFiles')->insert([
                    'BoardId' => $nextId,
                    'WriterNo' => $id,
                    'OriginalFilename' => $file_name,
                    'S3Url' => $s3_url,
                    'DownloadPath' => $path,
                    'ModifierNo' => $id,
                    'created_at' => $nowdate,
                    'updated_at' => $nowdate,
                ]);
            }
        }

        DB::table('Boards')->insert([
            'BoardType' => $board_type,
            'WriterType' => $type,
            'WriterNo' => $id,
            'WriterName' => $name,
            'BoardTitle' => $request->BoardTitle,
            'BoardContent' => $request->board_editor,
            'TopFix' => $request->TopFix,
            'ModifierNo' => $id,
            'created_at' => $nowdate,
            'updated_at' => $nowdate,
        ]);

        return redirect('/MainBoard');
    }
    public function show($board_type,Board $board)
    {
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        $files= Board::find($board->BoardId)->files;

        return view('Boards.show',compact('board'))->with('name', $name)->with('type', $type)->with('id',$id)->with('files',$files);

    }
    public function fileDownload($file_id)
    {
        $d_file = BoardFile::where('FileId',$file_id)->first();

        try{
            $file_url = $d_file->DownloadPath;
            $file_name  = $d_file->OriginalFilename;
            $mime = Storage::disk('s3')->getDriver()->getMimetype($file_url);
            $size = Storage::disk('s3')->getDriver()->getSize($file_url);
            $response =  [
            'Content-Type' => $mime,
            'Content-Length' => $size,
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename=".$file_name,
            'Content-Transfer-Encoding' => 'binary',
            ];

            ob_end_clean();

            return \Response::make(Storage::disk('s3')->get($file_url), 200, $response);
        }
        catch(Exception $e){
            return $this->respondInternalError( $e->getMessage(), 'object', 500);
        }
    }
    public function edit($board_type, Board $board)
    {
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;
        $files= Board::find($board->BoardId)->files;

        return view('Boards.edit',compact('board'))->with('name', $name)->with('type', $type)->with('id',$id)->with('board_type',$board_type)->with('files',$files);
    }
    public function update(Request $request,$board_type,Board $board)
    {
        $user = Auth::user();

        $name = $user->name;
        $id = $user->id;

        $account_type_id = Account::where('id', $id)->first()->AccountTypeId;
        $type = AccountType::where('AccountTypeId', '=', $account_type_id)->first()->Type;

        $board_id = $board->BoardId;

        $nowdate = date('Y-m-d H:i:s');

        if($request->hasFile('files')){
            $files = $request->file('files');
            foreach($files as $file){
                $file_name = $file->getClientOriginalName();
                $path = Storage::disk('s3')->put('plaive/AllDiscussion',$file,'public');
                $s3_url = "https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/".$path;
                DB::table('BoardFiles')->insert([
                    'BoardId' => $board_id,
                    'WriterNo' => $id,
                    'OriginalFilename' => $file_name,
                    'S3Url' => $s3_url,
                    'DownloadPath' => $path,
                    'ModifierNo' => $id,
                    'created_at' => $nowdate,
                    'updated_at' => $nowdate,
                ]);
            }
        }
        DB::table('Boards')->where('BoardId',$board->BoardId)->update([
            'BoardTitle' => $request->BoardTitle,
            'BoardContent' => $request->board_editor,
            'TopFix' => $request->TopFix,
            'ModifierNo' => $id,
            'updated_at' => $nowdate,
        ]);

        $files= Board::find($board->BoardId)->files;

        return view('Boards.show',compact('board'))->with('name', $name)->with('type', $type)->with('id',$id)->with('files',$files);
    }
    public function destroy($board_type, Board $board) 
    {
        $delete = $board->delete();
        if ($delete) {
            return response()->json([
                'result' => 'Success'            
            ]);
        } else {
            return response()->json([
                'result' => 'Fail'
            ]);
        }
    }
}
