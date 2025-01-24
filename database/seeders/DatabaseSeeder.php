<?php

namespace Database\Seeders;

use App\Models\ConsultingRoom;
use App\Models\Nationality;
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
            PatientStatusSeeder::class,
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
            NationalitySeeder::class,
        ]);
        
        // \App\Models\Patient::factory(2000)->create();
        // \App\Models\PatientSponsor::factory(200)->create();
        // \App\Models\PatientOpdNumber::factory(450)->create();
        \App\Models\User::factory(50)->create();
        // \App\Models\PatientAttendance::factory(100)->create();
        // \App\Models\ConsultingRoom::factory(10)->create();
        // \App\Models\Consultation::factory(100)->create();
        // \App\Models\Admissions::factory(100)->create();
    }
}
