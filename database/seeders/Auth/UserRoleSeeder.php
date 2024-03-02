<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        User::find(1)->assignRole(User::TYPE_ADMIN);
        User::find(2)->assignRole(User::TYPE_MANAGER);
        User::find(3)->assignRole(User::TYPE_CASHIER);
        $this->enableForeignKeys();
    }
}
