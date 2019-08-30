<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSubCourseworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // public $tableName = 'SubCourseworks';
    // public $connection = 'aurora';

    public function up()
    {
        // Schema::create($this->tableName, function (Blueprint $table) {

        //     $table->bigIncrements('SubCourseworkId');
        //     $table->integer('CourseworkId');
        //     $table->text('Content');
        //     $table->timestamps();

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists($this->tableName);
    }
}
