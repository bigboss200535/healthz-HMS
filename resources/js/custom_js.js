// ----------------CALCULATE AGE----------------------------
document.addEventListener('DOMContentLoaded', function() {
  var birthDateInput = document.getElementById('birth_date');
  birthDateInput.addEventListener('input', function() {
      var dob = new Date(this.value);
      if (!isValidDate(dob)) return;
      var age = calculateAge(dob);
      document.getElementById('age').value = age;
  });
});

function calculateAge(birthDate) {
  var now = new Date();
  var dob = new Date(birthDate);
  var age = now.getFullYear() - dob.getFullYear();
  var monthDiff = now.getMonth() - dob.getMonth();

  if (monthDiff < 0 || (monthDiff === 0 && now.getDate() < dob.getDate())) {
      age--;
  }

  return age;
}

function isValidDate(date) {
  return !isNaN(date.getTime());
}
  

// *************************************************
  
  
  $(document).ready(function() {
    // Handle form submission for saving and updating
    $('#category_save').on('submit', function(e) {
      e.preventDefault();

      // Collect form data
      var category_id = $('#category_id').val();
      var category_name = $('#category_name').val();
      var category_status = $('#category_status').val();
      var url = category_id ? '/category/' + category_id : '/category';
      var method = category_id ? 'PUT' : 'POST';

      // Client-side validation
      if (category_name.length < 3) {
        toastr.warning('Category name must be at least 3 characters long');
        return;
      }

      if (!category_status) {
        toastr.warning('Status is required');
        return;
      }

      // Check if category_id has a value before update
      if (category_id && method === 'PUT') {
        $.ajax({
          url: category_id ? '/category/' + category_id : '/category',
          type: method,
          data: $(this).serialize(),
          success: function(response) {
            toastr.success('Data updated successfully!');
            $("#product_list").load(location.href + " #product_list");
            $('#category_save')[0].reset();
            $('#category_id').val('');
          },
          error: function(xhr, status, error) {
            toastr.error('Error updating category! Try again.');
          }
        });
      } else {
        $.ajax({
          url: '/category',
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
            var result = JSON.parse(response);
              if (result == 201) {
                $("#product_list").load(location.href + " #product_list");
                $('#category_save')[0].reset();
                toastr.success('Data save successfully!');
              } else if (result == 200) {
                toastr.warning('Ops');
              }    
          },
          error: function(xhr, status, error) {
            toastr.error('Error saving data! Try again.');
          }
        });
      }
    });

    // Handle delete
    $(document).on('click', '.delete-btn', function() {
      var category_id = $(this).data('id');

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/category/' + category_id,
            type: 'DELETE',
            data: {
              _token: '{{ csrf_token() }}',
              category_id: category_id
            },
            success: function(response) {
              var result = JSON.parse(response);
              if (result == 201) {
                $("#product_list").load(location.href + " #product_list");
                toastr.success('Data deleted successfully!');
              } else if (result == 200) {
                toastr.warning('Data is attached to a product');
              }
            },
            error: function(xhr, status, error) {
              toastr.error('Error deleting item! Try again');
            }
          });
        }
      });
    });

    // Handle edit functionality
    $(document).on('click', '.edit-btn', function() {
      var category_id = $(this).data('id');

      $.ajax({
        url: '/category/' + category_id + '/edit',
        type: 'GET',
        success: function(response) {
          $('#category_id').val(response.category.category_id);
          $('#category_name').val(response.category.category_name);
          $('#category_status').val(response.category.status).trigger('change');
        },
        error: function(xhr, status, error) {
          toastr.error('Error fetching data! Try again.');
        }
      });
    });
  });

  
  document.addEventListener('DOMContentLoaded', function () {
    // Get references to the input fields
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const statusInput = document.getElementById('status');
    
    // Helper function to check if a date is today or in the future
    function isInRange(date) {
      const today = new Date();
      today.setHours(0, 0, 0, 0); // Normalize to remove time part
      return date >= today;
    }
    
    // Function to update the status based on the date range
    function updateStatus() {
      const today = new Date();
      today.setHours(0, 0, 0, 0); // Normalize to remove time part

      const startDate = new Date(startDateInput.value);
      const endDate = new Date(endDateInput.value);
      
      // Check if both dates are valid and in the future
      if (startDate && endDate && isInRange(startDate) && isInRange(endDate)) {
        statusInput.value = 'Active';
      } else {
        statusInput.value = 'Inactive';
      }
    }

    // Event listener for the start_date change
    startDateInput.addEventListener('change', function () {
      const startDate = new Date(startDateInput.value);
      if (startDateInput.value) {
        // Set end_date to start_date + 1 year
        const endDate = new Date(startDate);
        endDate.setFullYear(startDate.getFullYear() + 1);
        endDateInput.value = endDate.toISOString().split('T')[0]; // Format date as YYYY-MM-DD
      }
      // Update status
      updateStatus();
    });

    // Event listener for the end_date change
    endDateInput.addEventListener('change', function () {
      const endDate = new Date(endDateInput.value);
      if (endDateInput.value) {
        // Set start_date to end_date - 1 year
        const startDate = new Date(endDate);
        startDate.setFullYear(endDate.getFullYear() - 1);
        startDateInput.value = startDate.toISOString().split('T')[0]; // Format date as YYYY-MM-DD
      }
      // Update status
      updateStatus();
    });

    // Initial validation when the page loads
    updateStatus();
  });


  // Prevent modal from closing when clicking outside
  $('#addattendance').modal({
    backdrop: 'static',
    keyboard: false
  });

  // Clear form data when the modal is closed
  $('#addattendance').on('hidden.bs.modal', function () {
    $('#service_request_form')[0].reset(); // Reset the form
    $('#service_id').val(''); // Clear specific fields if needed
    $('#service_fee_id').val('');
    $('#gdrg_code').val('');
    $('#attendance_date').val('');
    $('#attendance_type').val('');
  });
