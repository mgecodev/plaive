<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'BoardFiles';
    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('FileId');
                $table->integer('BoardId');
                $table->integer('WriterNo');
                $table->string('OriginalFilename');
                $table->string('S3Url');
                $table->string('DownloadPath');
                $table->integer('ModifierNo');
                $table->timestamps();
                $table->boolean('Active')->default(1);
            });
        } else {
            /*Schema::table($this->tableName, function (Blueprint $table) {
                $table->string('DownloadPath');
            });*/
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('board_files');
    }
}
