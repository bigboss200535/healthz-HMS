<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            'CREATE PROCEDURE IF NOT EXISTS GetUsers()
              BEGIN 
              SELECT * FROM users;
             END;'
        );

        DB::unprepared(
            'CREATE PROCEDURE IF NOT EXISTS GetUsersById(IN `user_id` CHAR)
              BEGIN 
              SELECT * FROM users WHERE users.user_id = user_id;
             END;'
        );

        DB::unprepared(
            'CREATE PROCEDURE IF NOT EXISTS GetUsersByRole(IN `role` CHAR)
              BEGIN 
              SELECT * FROM users.role WHERE role = role;
             END;'
        );

        DB::unprepared(
            'CREATE PROCEDURE IF NOT EXISTS GetUsersByStatus(IN `status` CHAR)
              BEGIN 
              SELECT * FROM users.status WHERE status = status;
             END;'
        );

        DB::unprepared(
            'CREATE PROCEDURE IF NOT EXISTS GetPatients()
              BEGIN 
              SELECT * FROM patient_info;
             END;'
        );

        DB::unprepared(
            'CREATE PROCEDURE IF NOT EXISTS GetPatientWithPatNumbers()
              BEGIN 
                SELECT patient_info.patient_id, patient_info.fullname, patient_info.birth_date,
                patient_info.occupation, patient_info.education, patient_info.gender_id, patient_info.nationality,
                patient_info.death_status, patient_info.telephone, patient_info.email, patient_info.address, 
                patient_info.status, patient_info.archived, patient_info.contact_person, patient_info.contact_telephone, 
                patient_info.contact_relationship, 
                patient_nos.opd_number, patient_nos.clinic_code FROM patient_info left join patient_nos on 
                patient_info.patient_id = patient_nos.patient_id;
             END;'
        );

        DB::unprepared(
            'CREATE PROCEDURE IF NOT EXISTS GetEpisodeId(
        IN in_patient_id VARCHAR(50),
        IN in_pat_number VARCHAR(50),
        IN in_claims_code VARCHAR(10),
        IN in_request_date DATE
            )
            BEGIN
                DECLARE episode_exists INT DEFAULT 0;

                -- Check if an episode exists for the given criteria
                SELECT COUNT(*) INTO episode_exists 
                FROM episodes
                WHERE patient_id = in_patient_id 
                AND pat_no = in_pat_number 
                AND attendance_date = in_request_date
                AND (in_claims_code IS NULL OR claims_code = in_claims_code);

                -- If episode exists, return the details; otherwise, return nothing
                IF episode_exists > 0 THEN
                    SELECT episode_id, patient_id, pat_no, attendance_date
                    FROM episodes
                    WHERE patient_id = in_patient_id 
                    AND pat_no = in_pat_number 
                    AND attendance_date = in_request_date
                    AND (in_claims_code IS NULL OR claims_code = in_claims_code)
                    LIMIT 1;
                ELSE
                    SELECT NULL AS episode_id, NULL AS patient_id, NULL AS pat_no, NULL AS attendance_date;
                END IF;
            END;'
                );
        // usage DB::select('CALL GetEpisodeId(?, ?, ?, ?)', [123, 'PAT123456', 'CLAIMCODE123', '2024-11-11']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetEpisodeId;'
        ); 

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetUsers;'
        );

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetUsersById;'
        );

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetUsersByRole;'
        );

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetUsersByStatus;'
        );

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetPatients;'
        );

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetPatientWithPatNumbers;'
        );

    }
};
