import './bootstrap';
import './jquery.js';
import './popper.js';
// import './vendor/libs/flatpickr/flatpickr.js';
import './bootstrap1.js';
// import './perfect-scrollbar.js';
// import './helpers.js';
// import './hammer.js';
// import './i18n.js';
// import './typeahead.js';
// import './menu.js';
// import './datatables-bootstrap5.js';
// import './moment.js';
// import './apexcharts.js';
// import './tagify.js';
// import './popular.js';
// import './bootstrap5.js';
// import './auto-focus.js';
// import './main.js';
// import './js/dashboards-analytics';
// import './js/app-academy-dashboard';
// import './js/app-ecommerce-category-list';
// import './jquery-repeater';
// import './custom_js';
// import './patient_services';
// import './patient_details';
// import './js/fullcalendar';
// import './js/app-calendar-events';
// import './js/app-calendar';

// Initialize DataTables
$(document).ready(function () {
    $('#app_list').DataTable();
    $('#attendance_details').DataTable();
    $('#claims_code_list').DataTable();
    $('#patient_sponsor').DataTable();
    $('#appointments').DataTable();
    $('#diagnostics_list').DataTable();
    $('#patient_list').DataTable();
    $('#patient_services').DataTable();
    $('#patient_search_list').DataTable();
    $('#patient_searches').DataTable();
    $('#nurses_notes_patient').DataTable();
    $('#drugs').DataTable();
    $('#diagnosis').DataTable();

    // Initialize Select2
    $('.sponsor_name').select2();
    $('.diagnosis_search').select2();
    $('.select_2_dropbox').select2();
});

// Product Delete Confirmation
$(document).on('click', '.product_delete_btn', function () {
    var product_id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/product/' + product_id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result == 201) {
                        $('#product_list').load(location.href + ' #product_list');
                        toastr.success('Data deleted successfully!');
                    } else if (result == 200) {
                        toastr.warning('Data is attached to stock or prices');
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error('Error deleting item! Try again');
                },
            });
        }
    });
});

// Chart Initialization
const ctx = document.getElementById('vital_sign_chart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [
            {
                label: 'Pressure',
                data: [12, 19, 3, 5, 2, 20],
                borderWidth: 3,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});