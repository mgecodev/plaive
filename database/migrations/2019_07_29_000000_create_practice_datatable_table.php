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
    public $connection = 'aurora';

    /**
     * Run the migrations.
     * @table practice_datatable
     *
     * @return void
     */
    public function up()
    {
        // Run this code if there is no table
        if (!Schema::hasTable($this->tableName)) {
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
