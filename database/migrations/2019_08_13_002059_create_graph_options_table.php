<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraphOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'GraphOptions';
    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('OptionId');
                $table->integer('ChannelId');
                $table->integer('FieldNumber');
                $table->string('LineType', 16)->nullable();
                $table->string('Xlabel', 32)->nullable();
                $table->string('Ylabel', 32)->nullable();
                $table->string('GraphColor', 32)->nullable();
                $table->string('BackColor', 32)->nullable();
                $table->integer('Day')->nullable();
                $table->integer('Result')->nullable();
                $table->float('Min',8,2)->nullable();
                $table->float('Max',8,2)->nullable();
                $table->char('Dynamic',1)->default('N');
                $table->timestamps();
                $table->boolean('Active')->default(1);
            });
        } else {
            /*Schema::table($this->tableName, function (Blueprint $table) {
                $table->char('Dynamic',1)->default('N');
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
        //Schema::dropIfExists('graph_options');
    }
}
