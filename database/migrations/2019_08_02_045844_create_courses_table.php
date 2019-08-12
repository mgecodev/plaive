<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'Courses';
    public $connection = 'aurora';

    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('CourseId');
                $table->string('Title', 100);
                $table->integer('NumOfStudent');
                $table->integer('HourCount');
                $table->integer('WeekCount');
                $table->Text('Prerequisite');
                $table->Text('Comment');
                $table->timestamps();
                $table->integer('CreatedBy');
                $table->boolean('Active')->default(1);
            });

        }

        // Run this code if there is already table and you want additional action for the table
        else {

            // 1. Update column attributes
//            Schema::table($this->tableName, function (Blueprint $table) {
//                $table->string('name', 100)->nullable()->change();
//            });

            // 2. Rename column
//            Schema::table($this->tableName, function (Blueprint $table) {
//                $table->renameColumn('DeleteFlag', 'Active');
//            });

            // 3. Add column
            // Schema::table($this->tableName, function (Blueprint $table) {
            //     $table->integer('Title');
            // });

            // 4. Rename table
//            Schema::rename($this->tableName, 'Accounts');

            // 5. Drop the column
            // Schema::table($this->tableName, function(Blueprint $table) {
            //     $table->dropColumn('ChannelDescription');
            // });
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
        Schema::dropIfExists($this->tableName);
    }
}
