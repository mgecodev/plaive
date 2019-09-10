<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCourseworksTable extends Migration
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
        }
        else {
            // 1. Update column attributes
            //    Schema::table($this->tableName, function (Blueprint $table) {
            //        $table->Integer('AccountTypeId')->change();
            //        $table->timestamps();
            //    });

            // 2. Rename column
//            Schema::table($this->tableName, function (Blueprint $table) {
//                $table->renameColumn('DeleteFlag', 'Active');
//            });

            // 3. Add column
//            Schema::table($this->tableName, function (Blueprint $table) {
//                $table->Integer('ContentNumber');
//            });

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
        //Schema::dropIfExists('sub_courseworks');
    }
}
