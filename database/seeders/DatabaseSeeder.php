<?php

namespace Database\Seeders;

use App\Models\ConsultingRoom;
// use App\Models\Product;
// use App\Models\SponsorType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UserRoles::class,
            UserSeeder::class,
            GenderSeeder::class,
            HealthFacilitySeeder::class,
            TitleSeeder::class,
            ReligionSeeder::class,
            RelationSeeder::class,
            AgeSeeder::class,
            AttendanceServiceSeeder::class,
            ClinicSeeder::class,
            SponsorTypeSeeder::class,
            SponsorsSeeder::class,
            ClinicAttendanceTypeSeeder::class,
            FacilitySeeder::class,
            ServiceAttendanceTypeSeeder::class,
            ServicesSeeder::class,
            ServiceFeeSeeder::class, //check excel data
            ServicePointSeeder::class,
            ServiceMDCSSeeder::class,
            ConsultingRoomSeeder::class,
            NhisDrugs::class,
            Store::class,
            ICD10GroupSeeder::class,
            ProductPresentationSeeder::class,
            ProductType::class,
            Products::class,
            DiagnosisSeeder::class,
            ProductClassSeeder::class,
           
        ]);
        
        \App\Models\Patient::factory(500)->create();
        \App\Models\PatientSponsor::factory(200)->create();
        \App\Models\PatNumber::factory(500)->create();
        \App\Models\User::factory(50)->create();
    }
}
