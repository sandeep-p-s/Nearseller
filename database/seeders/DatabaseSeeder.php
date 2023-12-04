<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UseraccountSeeder::class);
        $this->call(UserPageSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(BusinessTypeSeeder::class);
        $this->call(ServiceCategorySeeder::class);
        // $this->call(PermissionSeeder::class);
        $this->call(MenuMasterSeeder::class);
        // $this->call(SiteModuleSeeder::class);
        // $this->call(CategorySeeder::class);
    }
}
