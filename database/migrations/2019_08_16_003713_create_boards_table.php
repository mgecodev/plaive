<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'Boards';
    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('BoardId');
                $table->string('BoardType',16);
                $table->integer('ClassId')->nullable();
                $table->string('WriterType',16);
                $table->integer('WriterNo');
                $table->string('WriterName');
                $table->string('BoardTitle');
                $table->text('BoardContent');
                $table->string('BoardPassword',8)->nullable();
                $table->char('PasswordState',1)->default('N');
                $table->char('TopFix',1)->default('N');
                $table->integer('ModifierNo');
                $table->timestamps();
                $table->boolean('Active')->default(1);
            });
        } else {
            /*Schema::table($this->tableName, function (Blueprint $table) {
                $table->integer('ModifierNo');
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
        //Schema::dropIfExists('boards');
    }
}
