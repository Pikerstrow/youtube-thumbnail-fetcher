<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use TCG\Voyager\Traits\Seedable;

class DatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/';
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cache::flush();

        $this->seedersPath = database_path('seeds') . DIRECTORY_SEPARATOR;

        $this->seed('DataTypesTableSeeder');
        $this->seed('DataRowsTableSeeder');
        $this->seed('MenusTableSeeder');
        $this->seed('MenuItemsTableSeeder');
        $this->seed('RolesTableSeeder');
        $this->seed('PermissionsTableSeeder');
        $this->seed('SettingsTableSeeder');
        $this->seed('UsersTableSeeder');
        $this->seed('CategoriesTableSeeder');
        $this->seed('PagesTableSeeder');
        $this->seed('PostsTableSeeder');
        $this->seed('PermissionRoleTableSeeder');
        $this->seed('ZipFilesInfoTableSeeder');
    }
}
