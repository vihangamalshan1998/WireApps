<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();
        $this->call(AuthSeeder::class);
        Model::reguard();
    }
}
