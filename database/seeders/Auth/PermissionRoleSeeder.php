<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use DB;
use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;
use Schema;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends CsvSeeder
{
    use DisableForeignKeys;

    public function __construct()
    {
        $this->file = '/database/seeders/Auth/permission.csv';
        $this->tablename = 'permissions';
        $this->delimiter = ',';
        $this->timestamps = true; //doesn't use created/updated_at fields

    }
    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        // Create Roles
        Role::create([
            'id' => 1,
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrator',
        ]);
        Role::create([
            'id' => 2,
            'type' => User::TYPE_MANAGER,
            'name' => 'Manager',
        ]);
        Role::create([
            'id' => 3,
            'type' => User::TYPE_CASHIER,
            'name' => 'Cashier',
        ]);
        //import CRM permission
        DB::disableQueryLog();
        Schema::disableForeignKeyConstraints();
        parent::run();
        Schema::enableForeignKeyConstraints();
        $this->enableForeignKeys();
    }
}
