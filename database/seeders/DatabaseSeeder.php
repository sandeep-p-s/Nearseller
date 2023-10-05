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
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UseraccountSeeder::class);
        $this->call(SiteModuleSeeder::class);
        $this->call(MaritalstatusSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(ProfessionSeeder::class);
        $this->call(BankdetailsSeeder::class);
        $this->call(BanktypeSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
