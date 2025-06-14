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
            'CREATE PROCEDURE IF NOT EXISTS `GetAgeGroup`(
                IN `input_age` INT) 
                -- OUT `age_group` VARCHAR(50)) 
                BEGIN 
                    SELECT `age_description` FROM `ages`
                    WHERE `input_age` 
                    BETWEEN `min_age` 
                    AND `max_age` 
                    AND `age_description` != "ALL" LIMIT 1; 
                END;'
        );

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
                 SELECT * FROM users.role_id WHERE role_id = role;
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
                patient_info.contact_relationship, patient_nos.opd_number, patient_nos.clinic_code 
                FROM patient_info 
                LEFT JOIN patient_nos 
                ON patient_info.patient_id = patient_nos.patient_id;
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

        // DB::unprepared(
        //     'CREATE PROCEDURE IF NOT EXISTS StorePatient(
        //         IN p_title_id INT,
        //         IN p_firstname VARCHAR(255),
        //         IN p_middlename VARCHAR(255),
        //         IN p_lastname VARCHAR(255),
        //         IN p_birth_date DATE,
        //         IN p_gender_id INT,
        //         IN p_occupation VARCHAR(255),
        //         IN p_education VARCHAR(255),
        //         IN p_religion_id INT,
        //         IN p_nationality VARCHAR(255),
        //         IN p_old_folder VARCHAR(255),
        //         IN p_telephone VARCHAR(255),
        //         IN p_work_telephone VARCHAR(255),
        //         IN p_email VARCHAR(255),
        //         IN p_address TEXT,
        //         IN p_town VARCHAR(255),
        //         IN p_region VARCHAR(255),
        //         IN p_contact_person VARCHAR(255),
        //         IN p_contact_telephone VARCHAR(255),
        //         IN p_contact_relationship VARCHAR(255),
        //         IN p_sponsor_type VARCHAR(255),
        //         IN p_sponsor_name VARCHAR(255),
        //         IN p_member_no VARCHAR(255),
        //         IN p_start_date DATE,
        //         IN p_end_date DATE,
        //         IN p_user_id INT,  -- Passed user_id for better scalability
        //         OUT patient_id INT,
        //         OUT opd_number VARCHAR(255)
        //     )

        //     BEGIN
        //         DECLARE new_patient_id INT;
        //         DECLARE new_opd_number VARCHAR(255);
        //         DECLARE v_current_date DATE;
        //         DECLARE transaction_id VARCHAR(20);
        //         DECLARE sponsor_id INT;
        
        //         SET v_current_date = CURDATE();  -- Use the renamed variable
        
        //         SET transaction_id = DATE_FORMAT(v_current_date, "%Y%m%d%H%i%s"); -- Generate a unique transaction ID
        
        //         -- Check if patient already exists based on critical fields
        //         IF EXISTS (
        //             SELECT 1 FROM patients
        //             WHERE lastname = p_lastname
        //             AND firstname = p_firstname
        //             AND birth_date = p_birth_date
        //             AND telephone = p_telephone
        //         ) THEN
        //             SET patient_id = NULL;
        //             SET opd_number = NULL;
        //             RETURN;  -- Exit the procedure if the patient already exists
        //         END IF;
        
        //         -- Insert patient data into the database
        //         INSERT INTO patients (
        //             title_id, firstname, middlename, lastname, birth_date, gender_id,
        //             occupation, education, religion_id, nationality, old_folder, telephone,
        //             work_telephone, email, address, town, region, contact_person,
        //             contact_telephone, contact_relationship, sponsor_type, added_date,
        //             records_id, user_id
        //         ) VALUES (
        //             p_title_id, p_firstname, p_middlename, p_lastname, p_birth_date, p_gender_id,       
        //             p_occupation, p_education, p_religion_id, p_nationality, p_old_folder, p_telephone, 
        //             p_work_telephone, p_email, p_address, p_town, p_region, p_contact_person,
        //             p_contact_telephone, p_contact_relationship, p_sponsor_type, v_current_date,        
        //             transaction_id, p_user_id
        //         );
        
        //         -- Get the last inserted patient ID
        //         SET new_patient_id = LAST_INSERT_ID();
        
        //         -- Generate OPD number
        //         SET new_opd_number = CONCAT("OPD-", LPAD(new_patient_id, 5, "0")); -- Format: OPD-XXXX  
        
        //         -- Insert OPD number
        //         INSERT INTO opd_numbers (patient_id, opd_number, registration_date, registration_time, user_id)
        //         VALUES (new_patient_id, new_opd_number, v_current_date, v_current_date, p_user_id);     
        
        //         -- Insert sponsor information if available
        //         IF p_sponsor_name IS NOT NULL AND p_sponsor_name != "" THEN
        //             INSERT INTO patient_sponsors (
        //                 patient_id, sponsor_type, sponsor_name, member_no, start_date, end_date, status, user_id
        //             ) VALUES (
        //                 new_patient_id, p_sponsor_type, p_sponsor_name, p_member_no, p_start_date, p_end_date, "Active", p_user_id
        //             );
        //         END IF;
        
        //         -- Return output parameters
        //         SET patient_id = new_patient_id;
        //         SET opd_number = new_opd_number;
        //     END'
        // );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetAgeGroup;'
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
            'DROP PROCEDURE IF EXISTS GetEpisodeId;'
        ); 

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetPatients;'
        );

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetPatientWithPatNumbers;'
        );

        // DB::unprepared(
        //     'DROP PROCEDURE IF EXISTS StorePatient;'
        // );
    }
};
