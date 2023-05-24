<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Team::factory(20)->create();
    }
}
