<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Let's truncate our existing records to start from scratch.
         Account::truncate();

         $faker = \Faker\Factory::create();
 
         // And now, let's create a few Accounts in our database:
         for ($i = 0; $i < 50; $i++) {
             Account::create([
                'id' => $faker->numerify('##'),
                'balance' => $faker->numerify('###'),
             ]);
         }
    }
}
