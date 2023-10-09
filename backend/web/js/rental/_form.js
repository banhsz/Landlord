$(document).ready(function(){
    $('input[name="toggle-radio"]').change(function(){
        var selectedValue = $('input[name="toggle-radio"]:checked').val();

        // You can perform actions based on the selected value here
        if (selectedValue === 'yes') {
            // Do something when "Yes" is selected
            console.log('yes');
            $("#new-tenant-div").show();
            $("#apartment-id-div").hide();
        } else if (selectedValue === 'no') {
            // Do something when "No" is selected
            console.log('no');
            $("#new-tenant-div").hide();
            $("#apartment-id-div").show();
        }
    });
});