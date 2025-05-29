// $(document).ready(function() {
    // When systemic area is selected
    $('#systemic_review').change(function() {
        var systemicId = $(this).val();
        if (systemicId) {
            // Clear existing table data
            $('#symptoms-table tbody').empty();
            
            // Fetch symptoms for selected systemic area
            $.ajax({
                url: '/consultation/get-systemic-symptoms/' + systemicId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        // Populate table with symptoms
                        $.each(data, function(index, symptom) {
                            
                            var row = '<tr>' +
                                            '<td align="center"><input type="checkbox" class="form-check-input" name="symptom_check[]" value="' + symptom.systemic_symtom_id + '"></td>' +
                                            '<td>' + symptom.systemic_symtom + '</td>' +
                                            '<td><textarea class="form-control" style="resize: none; min-width:400px; max-width:100%; min-height:50px; height:100%; width:100%;" rows="3" cols="150" name="symptom_notes[' + symptom.systemic_symtom_id + ']"></textarea></td>' +
                                            '<td><div class="btn-group">' +
                                                '<button type="button" class="btn btn-sm btn-primary">Add</button>' +
                                                 '</div>' +
                                            '</td>' +
                                        '</tr>';
                            $('#symptoms-table tbody').append(row);
                        });
                    } else {
                        $('#symptoms-table tbody').append('<tr><td colspan="4" class="text-center">No symptoms found for this system</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching symptoms:', error);
                    $('#symptoms-table tbody').append('<tr><td colspan="4" class="text-center">Error loading symptoms</td></tr>');
                }
            });
        }
    });
// });
