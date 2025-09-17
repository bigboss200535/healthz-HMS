<?php

namespace Database\Seeders;

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
        $faker = \Faker\Factory::create();

        $this->call([
            FacilitySeeder::class,
            UserRolesSeeder::class,
            GenderSeeder::class,
            UserSeeder::class,
            OccupationSeeder::class,
            PatientStatusSeeder::class,
            HealthFacilitySeeder::class,
            ServiceTypesSeeder::class,
            TitleSeeder::class,
            ReligionSeeder::class,
            RegionSeeder::class,
            RelationSeeder::class,
            AgeSeeder::class,
            AttendanceServiceSeeder::class,
            ClinicSeeder::class,
            SponsorTypeSeeder::class,
            SponsorsSeeder::class,
            // ClinicAttendanceTypeSeeder::class,
            ServiceAttendanceTypeSeeder::class,
            ServicesSeeder::class,
            ServiceFeeSeeder::class, //check excel data
            ServicePointSeeder::class,
            ServiceMDCSSeeder::class,
            ConsultingRoomSeeder::class,
            NhisDrugs::class,
            StoreSeeder::class,
            ICD10GroupSeeder::class,
            ProductPresentationSeeder::class,
            ProductTypeSeeder::class,
            ProductsSeeder::class,
            DiagnosisSeeder::class,
            ProductClassSeeder::class,
            NationalitySeeder::class,
            AgeGroupsSeeder::class,
            TownSeeder::class, 
            DocumentationRepoSeeder::class,
            ClinicalHistorySeeder::class,
            SystemicAreasSeeder::class,
            FrequenciesSeeder::class,
            PermissionRoleSeeder::class,
            PermissionsSeeder::class,
            UserCategoryAccessLevelSeeder::class,
            // UserPermissionsSeeder::class,
            UserPermissionTestSeeder::class,
            IssueStatusSeeder::class
        ]);

        $users = \App\Models\User::factory(1000)->create();
        $patients = \App\Models\Patient::factory(500)->create();
        // $relations = \App\Models\Relation::factory(700)->create();

            foreach ($patients as $patient) {
                  \App\Models\PatientOpdNumber::factory()->create([
                'patient_id' => $patient->patient_id,
              ]);
            }

            foreach ($patients as $relation) {
                    \App\Models\PatientRelations::factory()->create([
                    'patient_id' => $relation->patient_id,
                    // 'opd_number' => $relation->opd_number,
            ]);
            }

        foreach ($patients as $appointment) {
                \App\Models\PatientAppointments::factory()->create([
                'patient_id' => $appointment->patient_id,
                'opd_number' => $appointment->opd_number,
            ]);
            }

         foreach ($patients as $patient_sponsor) {
                // PatientSponsor::factory()->count(10)->create();
                \App\Models\PatientSponsor::factory()->create([
                'patient_id' => $patient_sponsor->patient_id,
                'opd_number' => $patient_sponsor->opd_number,
            ]);
            }

        // \App\Models\PatientOpdNumber::factory(5000)->create();
        // \App\Models\PatientAttendance::factory(100)->create();
        // \App\Models\ConsultingRoom::factory(10)->create();
        // \App\Models\Consultation::factory(100)->create();
        // \App\Models\Admissions::factory(100)->create();
        // \App\Models\PatientSponsor::factory(200)->create();
        
    }
}
