INSERT INTO services_fee 
    (service_fee_id, service_id, service, service_type_code, cash_amount, 
    private_amount, nhis_child, foreigners_amount, allow_nhis, nhis_adult, gdrg_adult, gdrg_child, gender_id, 
    patient_type, age_id, editable, allow_topup, topup_amount, delivery_mode) 
VALUES 
('03687', '0032', 'ANTENATAL', '5', '70', '40', '95.59', '40', 'Yes', '0', 'OPDC02A', '', '3', '1', '2', 'Yes', 'No', '0', 'INTERNAL'),
('03972', '0010', 'EYE CONSULTATION', '5', '70', '40', '86.2', '40', 'Yes', '85.62', 'OPDC05A', 'OPDC05C', '1', '1', '3', 'No', 'No', '0', 'INTERNAL'),
('03253', '0011', 'ENT  CONSULTATION', '5', '70', '70', '87.98', '70', 'Yes', '86.53', 'OPDC04A', 'OPDC04C', '1', '1', '3', 'Yes', 'No', '0', 'INTERNAL'),
('03260', '0020', 'GENERAL CONSULTATION', '5', '70', '70', '55.06', '70', 'Yes', '54.7', 'OPDC06A', 'OPDC06C', '1', '1', '3', 'Yes', 'No', '0', 'INTERNAL');