<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::factory()->count(1)->create(['store_id' => 1]);
        Sector::factory()->count(1)->create(['store_id' => 2]);
    }
}
