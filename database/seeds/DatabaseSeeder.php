<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PrizeSeeder::class);
    }
}

class PrizeSeeder extends Seeder
{

    public function run()
    {
        DB::table('prizes')->insert([
            ['prize' => 'First','amount' => 1,'prize_structure' => '300$'],
            ['prize' => 'Runner Up','amount' => 2,'prize_structure' => '100$'],
            ['prize' => 'Consolation','amount' => 10,'prize_structure' => '50$'],
        ]);
    }
}

class UserSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            ['username' => 'Guests','account' => 'guests','encode' => md5(123456)],
        ]);
    }
}
