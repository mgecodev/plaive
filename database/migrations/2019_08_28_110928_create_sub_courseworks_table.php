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
    public $tableName = 'SubCourseworks';
    public $connection = 'aurora';

    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('SubCourseworkId');
                $table->Integer('CourseworkId');
                $table->text('Content');
                $table->Integer('ContentNumber');
                $table->timestamps();
                $table->boolean('Active')->default(1);
            });
        } else {
            /*Schema::table($this->tableName, function (Blueprint $table) {
                $table->renameColumn('CourseId', 'CourseworkId');
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
        //Schema::dropIfExists('sub_courseworks');
    }
}
