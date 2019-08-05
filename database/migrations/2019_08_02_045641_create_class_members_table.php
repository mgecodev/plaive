<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'ClassMembers';
    public $connection = 'aurora';

    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('ClassMemberId');
                $table->integer('ClassId');
                $table->integer('AccountId');
                $table->timestamps();
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
//            Schema::table($this->tableName, function (Blueprint $table) {
//                $table->integer('AccountTypeId');
//                $table->boolean('DeleteFlag')->default(1);
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
        //Execute this when you want to drop the table
        //Schema::dropIfExists($this->tableName);
    }
}
