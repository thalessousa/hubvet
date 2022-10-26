<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Store::factory()->count(1)->create(['id' => 1]);
            Store::factory()->count(1)->create(['id' => 2]);
    }
}
