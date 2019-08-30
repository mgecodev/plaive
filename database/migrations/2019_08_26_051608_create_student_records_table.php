<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'StudentRecords';

    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('StudentRecordId');
                $table->integer('AccountId');
                $table->integer('ClassId');
                $table->integer('CourseworkId');
                $table->boolean('Done')->default(0);
                $table->integer('SubCourseworkId');
                $table->boolean('Active')->default(1);
                $table->timestamps();
            });
        }

        // Run this code if there is already table and you want additional action for the table
        else {

            // 1. Update column attributes
//            Schema::table($this->tableName, function (Blueprint $table) {
//                $table->Integer('AccountTypeId')->change();
//            });

            // 2. Rename column
//            Schema::table($this->tableName, function (Blueprint $table) {
//                $table->renameColumn('DeleteFlag', 'Active');
//            });

            // 3. Add column
            // Schema::table($this->tableName, function (Blueprint $table) {
        
            //     $table->integer('SubCourseworkId');
            //     $table->boolean('Active')->default(1);
            // });

            // 4. Rename table
//            Schema::rename($this->tableName, 'Accounts');

        }
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
