<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'Channels';
    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('ChannelId');
                $table->integer('AccountId');
                $table->string('ApiKey',256);
                $table->string('TableName',32);
                $table->string('ChannelName',64);
                $table->text('ChannelDescription')->nullable();
                $table->string('Field1Name',64);
                $table->string('Field2Name',64)->nullable();
                $table->string('Field3Name',64)->nullable();
                $table->string('Field4Name',64)->nullable();
                $table->string('Field5Name',64)->nullable();
                $table->string('Field6Name',64)->nullable();
                $table->string('Field7Name',64)->nullable();
                $table->string('Field8Name',64)->nullable();
                $table->unsignedSmallInteger('FieldCount');
                $table->timestamps();
                $table->boolean('Active')->default(1);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('Channels');
    }
}
