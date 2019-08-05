<?php

use App\AccountType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        // Seed data for AccountType table
        DB::table('AccountTypes')->delete();

        $AccountTypes = [
            ['AccountTypeId' => 0, 'Type' => 'Admin'],
            ['AccountTypeId' => 1, 'Type' => 'Student'],
            ['AccountTypeId' => 2, 'Type' => 'Teacher'],
            ['AccountTypeId' => 3, 'Type' => 'Parent'],
            ['AccountTypeId' => 4, 'Type' => 'Government']
        ];

        AccountType::insert($AccountTypes);
    }
}
