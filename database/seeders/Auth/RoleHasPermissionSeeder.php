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

class RoleHasPermissionSeeder extends CsvSeeder
{
    use DisableForeignKeys;

    public function __construct()
    {
        $this->file = '/database/seeders/Auth/role_has_permission.csv';
        $this->tablename = 'role_has_permissions';
        $this->delimiter = ',';
        $this->timestamps = false; //doesn't use created/updated_at fields
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        //import CRM role has permissions
        DB::disableQueryLog();
        Schema::disableForeignKeyConstraints();
        parent::run();

        Schema::enableForeignKeyConstraints();
        $this->enableForeignKeys();
    }
}
