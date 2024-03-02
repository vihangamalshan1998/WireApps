<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => 'secret',
        ]);
        User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => 'secret',
        ]);
        User::create([
            'name' => 'Cashiers',
            'email' => 'cashier@gmail.com',
            'password' => 'secret',
        ]);
        $this->enableForeignKeys();
    }
}
