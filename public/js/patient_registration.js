$(document).ready(function() {
    // Initialize input masks with improved validation
    $('#ghana_card').inputmask('AAA-99999999-9', {
        placeholder: 'GHA-12345678-9',
        clearMaskOnLostFocus: true
    });

    // Phone number validation with Ghanaian format
    const phoneInputs = ['#telephone', '#work_telephone', '#contact_telephone'];
    phoneInputs.forEach(input => {
        $(input).inputmask('099-999-9999', {
            placeholder: '024-123-4567',
            clearMaskOnLostFocus: true,
            definitions: {
                '0': { validator: '[2-5]' } // Ghana phone numbers start with 2,3,4,5
            }
        });
    });

    // Improved age calculation with validation
    function calculateAge(birthDate) {
        const today = new Date();
        const birth = new Date(birthDate);
        
        if (!isValidDate(birth) || birth > today) {
            return '';
        }
        
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }
        
        return age;
    }

    function isValidDate(date) {
        return date instanceof Date && !isNaN(date);
    }

    $('#birth_date').on('change', function() {
        const age = calculateAge($(this).val());
        $('#age').val(age);
        
        if (age === '') {
            $(this).addClass('is-invalid');
            $(this).after('<div class="invalid-feedback">Please enter a valid date not in the future</div>');
        } else {
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }
    });

    // Enhanced sponsorship management
    const sponsorshipManager = {
        clearSponsorshipFields: function() {
            $('#sponsor_id').html('<option value="" disabled selected>-Select-</option>');
            $('#member_no').val('');
            $('#dependant').val('NO');
            $('#start_date, #end_date').val('');
            $('#card_status').val('');
        },

        validateDates: function(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (start > end) {
                toastr.error('End date must be after start date');
                return false;
            }
            if (start < today) {
                toastr.error('Start date cannot be in the past');
                return false;
            }
            return true;
        },

        loadSponsors: function(sponsorTypeId) {
            if (!sponsorTypeId) return;

            $.ajax({
                url: '/get-sponsors/' + sponsorTypeId,
                type: 'GET',
                timeout: 10000,
                beforeSend: function() {
                    $('#sponsor_id').html('<option value="" disabled selected>Loading...</option>');
                },
                success: function(response) {
                    let options = '<option value="" disabled selected>-Select-</option>';
                    response.forEach(function(sponsor) {
                        options += `<option value="${sponsor.sponsor_id}">${sponsor.sponsor_name}</option>`;
                    });
                    $('#sponsor_id').html(options);
                },
                error: function(xhr, status, error) {
                    toastr.error('Failed to load sponsors. Please try again.');
                    $('#sponsor_id').html('<option value="" disabled selected>-Select-</option>');
                    console.error('Sponsor loading error:', error);
                }
            });
        }
    };

    // Show/hide sponsorship details based on sponsor type
    $('#sponsor_type_id').on('change', function() {
        const sponsorTypeId = $(this).val();
        if (!sponsorTypeId) {
            $('.sponsorship_details_settings').hide();
            sponsorshipManager.clearSponsorshipFields();
        } else {
            $('.sponsorship_details_settings').show();
            sponsorshipManager.loadSponsors(sponsorTypeId);
        }
    });

    // Handle date validation
    $('#start_date, #end_date').on('change', function() {
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();

        if (startDate && endDate) {
            if (sponsorshipManager.validateDates(startDate, endDate)) {
                $('#card_status').val('Active');
            } else {
                $('#card_status').val('Inactive');
            }
        }
    });

    // Initialize form validation with improved rules
    const requiredFields = [
        { id: 'title', name: 'Title', type: 'select' },
        { id: 'firstname', name: 'Firstname', type: 'text', minLength: 2 },
        { id: 'lastname', name: 'Lastname', type: 'text', minLength: 2 },
        { id: 'birth_date', name: 'Date of Birth', type: 'date' },
        { id: 'gender_id', name: 'Gender', type: 'select' },
        { id: 'occupation', name: 'Occupation', type: 'select' },
        { id: 'education', name: 'Education', type: 'select' },
        { id: 'religion', name: 'Religion', type: 'select' },
        { id: 'nationality', name: 'Nationality', type: 'select' }
    ];

    // Form submission handler with retry mechanism and improved validation
    const formHandler = {
        maxRetries: 3,
        retryDelay: 2000, // 2 seconds
        currentRetry: 0,

        resetFormState: function($form) {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            toastr.clear();
            $form.find('.form-overlay').remove();
        },

        validateField: function(field) {
            const $field = $('#' + field.id);
            const value = $field.val();
            let isValid = true;
            let errorMessage = '';

            if (!value || value === '' || value === '-Select-') {
                isValid = false;
                errorMessage = `${field.name} is required`;
            } else if (field.type === 'text' && field.minLength && value.length < field.minLength) {
                isValid = false;
                errorMessage = `${field.name} must be at least ${field.minLength} characters`;
            } else if (field.type === 'date' && new Date(value) > new Date()) {
                isValid = false;
                errorMessage = 'Birth date cannot be in the future';
            }

            if (!isValid) {
                $field.addClass('is-invalid')
                      .after(`<div class="invalid-feedback">${errorMessage}</div>`);
            }

            return isValid;
        },

        showLoadingState: function($form) {
            const submitBtn = $form.find('button[type="submit"]');
            const resetBtn = $form.find('button[type="reset"]');
            const searchBtn = $form.find('a.btn-dark');

            submitBtn.prop('disabled', true).html('<i class="bx bx-loader bx-spin"></i> Saving...');
            resetBtn.prop('disabled', true);
            searchBtn.addClass('disabled');

            const formOverlay = $('<div class="form-overlay"><div class="spinner-border text-primary"></div></div>');
            $form.css('position', 'relative').append(formOverlay);
        },

        resetLoadingState: function($form) {
            const submitBtn = $form.find('button[type="submit"]');
            const resetBtn = $form.find('button[type="reset"]');
            const searchBtn = $form.find('a.btn-dark');

            submitBtn.prop('disabled', false).html('<i class="bx bx-save"></i> Save Patient');
            resetBtn.prop('disabled', false);
            searchBtn.removeClass('disabled');
            $form.find('.form-overlay').remove();
        },

        handleSuccess: function(response, patient_id) {
            toastr.success('Patient registered successfully');
            window.location.href = '/patients/' + patient_id;
        },

        handleError: function($form, xhr) {
            const errors = xhr.responseJSON?.errors;
            if (errors) {
                Object.keys(errors).forEach(function(field) {
                    const $field = $('#' + field);
                    if ($field.length) {
                        $field.addClass('is-invalid')
                              .after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                    }
                });
                toastr.error('Please correct the errors in the form');
            } else {
                toastr.error('An error occurred while registering patient');
                if (this.currentRetry < this.maxRetries) {
                    this.currentRetry++;
                    setTimeout(() => {
                        toastr.info(`Retrying submission (Attempt ${this.currentRetry} of ${this.maxRetries})...`);
                        this.submitForm($form);
                    }, this.retryDelay);
                    return;
                }
            }
            this.resetLoadingState($form);
        },

        submitForm: function($form) {
            const formData = new FormData($form[0]);
            
            $.ajax({
                url: '/patient/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    if (response.success) {
                        this.handleSuccess(response, response.patient_id);
                    } else {
                        toastr.error(response.message || 'Failed to register patient');
                        this.resetLoadingState($form);
                    }
                },
                error: (xhr) => this.handleError($form, xhr),
                complete: () => {
                    if (this.currentRetry >= this.maxRetries) {
                        this.currentRetry = 0;
                    }
                }
            });
        }
    };

    // Handle form submission with improved validation
    $('#patient_info').on('submit', function(e) {
        e.preventDefault();
        const $form = $(this);

        // Check if form is already being submitted
        if ($form.find('button[type="submit"]').prop('disabled')) {
            toastr.warning('Form submission in progress, please wait...');
            return;
        }

        formHandler.resetFormState($form);

        // Check if the form is completely empty
        let hasValue = false;
        $form.find('input, select').each(function() {
            if ($(this).val() && $(this).val() !== '-Select-' && $(this).val() !== '') {
                hasValue = true;
                return false; // Break the loop
            }
        });

        if (!hasValue) {
            toastr.error('Please fill in the form before submitting');
            requiredFields.forEach(field => {
                const $field = $('#' + field.id);
                $field.addClass('is-invalid')
                      .after('<div class="invalid-feedback">This field is required</div>');
            });
            return;
        }

        // Validate all required fields
        let isValid = requiredFields.every(field => formHandler.validateField(field));

        // Validate email format if provided
        const email = $('#email').val();
        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            isValid = false;
            $('#email').addClass('is-invalid')
                      .after('<div class="invalid-feedback">Please enter a valid email address</div>');
        }

        if (!isValid) {
            toastr.error('Please fill in all required fields');
            return;
        }

        formHandler.showLoadingState($form);
        formHandler.submitForm($form);
    });
    });