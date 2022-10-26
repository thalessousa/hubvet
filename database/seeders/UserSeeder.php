<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert([
                'name' => 'market1',
                'password' => '123456',
                'store_id' => 1,
            ]);
            DB::table('users')->insert([
                'name' => 'market2',
                'password' => '123456',
                'store_id' => 2,
            ]);
    }
}
