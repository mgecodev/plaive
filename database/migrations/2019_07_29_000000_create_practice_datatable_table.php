<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticeDatatableTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'practice_datatable';

    /**
     * Run the migrations.
     * @table practice_datatable
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('practice_datatable')) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('id');
                $table->string('asin', 30);
                $table->string('name', 50);
                $table->string('category', 50);
                $table->string('sub_category', 50);
                $table->float('weight');
                $table->float('length');
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
         //Execute this when you want to drop the table
         //Schema::dropIfExists($this->tableName);

     }
}
