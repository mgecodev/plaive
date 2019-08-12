<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorData201908sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'SensorData201908s';
    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('DataId');
                $table->integer('ChannelId');
                $table->float('Field1',8,2)->nullable();
                $table->float('Field2',8,2)->nullable();
                $table->float('Field3',8,2)->nullable();
                $table->float('Field4',8,2)->nullable();
                $table->float('Field5',8,2)->nullable();
                $table->float('Field6',8,2)->nullable();
                $table->float('Field7',8,2)->nullable();
                $table->float('Field8',8,2)->nullable();
                $table->timestamps();
                $table->boolean('Active')->default(1);
            });
        } else {
            /*Schema::table($this->tableName, function(Blueprint $table) {
                $table->dropColumn('ApiKey');
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
        //Schema::dropIfExists('sensor_data201908s');
    }
}
