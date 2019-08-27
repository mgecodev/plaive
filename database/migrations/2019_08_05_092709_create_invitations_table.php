<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */

    public $tableName = 'Invitations';
    public $connection = 'aurora';

    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('InvitationId');
                $table->Integer('InviterId');
                $table->Integer('InviteeId');
                $table->Integer('ClassId');
                $table->Integer('Accepted');
                $table->timestamps();
                $table->boolean('Active')->default(1);
            });
        }

        // Run this code if there is already table and you want additional action for the table
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
//                $table->boolean('Active')->default(1);
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
