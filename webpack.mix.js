const mix = require('laravel-mix');

// Bundle CSS files
mix.styles([
    'public/vendor/fonts/boxicons.css',
    'public/vendor/fonts/fontawesome.css',
    'public/vendor/fonts/flag-icons.css',
    'public/vendor/css/rtl/core.css',
    'public/vendor/css/rtl/theme-default.css',
    'public/css/demo.css',
    'public/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
    'public/vendor/libs/typeahead-js/typeahead.css',
    'public/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
    'public/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
    'public/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css',
    'public/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
    'public/vendor/libs/dropzone/dropzone.css',
    'public/vendor/libs/tagify/tagify.css',
    'public/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css',
    'public/vendor/libs/@form-validation/form-validation.css',
    'public/vendor/css/pages/page-profile.css',
    'public/vendor/libs/spinkit/spinkit.css',
    'public/vendor/libs/apex-charts/apex-charts.css',
    'public/css/pickr-themes.css',
    'public/css/fullcalendar.css',
    'public/css/app-calendar.css',
    'public/css/flatpickr.css'
], 'public/css/bundle.css');

// Bundle JavaScript files
mix.scripts([
    'public/vendor/libs/jquery/jquery.js',
    'public/vendor/libs/popper/popper.js',
    'public/vendor/js/bootstrap.js',
    'public/vendor/libs/flatpickr/flatpickr.js',
    'public/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
    'public/vendor/libs/hammer/hammer.js',
    'public/vendor/libs/i18n/i18n.js',
    'public/vendor/libs/typeahead-js/typeahead.js',
    'public/vendor/js/menu.js',
    'public/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'public/vendor/libs/moment/moment.js',
    'public/vendor/libs/apex-charts/apexcharts.js',
    'public/vendor/libs/tagify/tagify.js',
    'public/vendor/libs/@form-validation/popular.js',
    'public/vendor/libs/@form-validation/bootstrap5.js',
    'public/vendor/libs/@form-validation/auto-focus.js',
    'public/js/main.js',
    'public/js/dashboards-analytics.js',
    'public/js/app-academy-dashboard.js',
    'public/js/app-ecommerce-category-list.js',
    'public/vendor/libs/jquery-repeater/jquery-repeater.js',
    'public/js/custom_js.js',
    'public/js/patient_services.js',
    'public/js/patient_details.js',
    'public/js/fullcalendar.js',
    'public/js/app-calendar-events.js',
    'public/js/app-calendar.js'
], 'public/js/bundle.js');

// Versioning for cache busting
if (mix.inProduction()) {
    mix.version();
}