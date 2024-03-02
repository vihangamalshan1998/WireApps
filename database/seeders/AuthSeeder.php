<?php

namespace Database\Seeders;

use App\Domains\Auth\Models\User;
use Database\Seeders\Auth\PermissionRoleSeeder;
use Database\Seeders\Auth\RoleHasPermissionSeeder;
use Database\Seeders\Auth\UserRoleSeeder;
use Database\Seeders\Auth\UserSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\PermissionRegistrar;

/**
 * Class AuthTableSeeder.
 */
class AuthSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Reset cached roles and permissions
        Artisan::call('cache:clear');
        resolve(PermissionRegistrar::class)->forgetCachedPermissions();
        $this->call(UserSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(RoleHasPermissionSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->enableForeignKeys();

    }
}
