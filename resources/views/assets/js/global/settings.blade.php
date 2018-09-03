<script>

jQuery.datetimepicker.setLocale('he');

jQuery('#settings-dateOfBirth').datetimepicker({
  format:'Y-m-d',
  timepicker:false
});

$(document).on('click','#settings-email-btn',function()
{
    var _email = $('#settings-email').val();
    var _csrf = $("input[name='_token']").val();

    $.ajax({
        url: '/api/settings',
        type: 'POST',
        headers: { 
            'X-CSRF-TOKEN': _csrf,
        },
        data: {
            settings_email: _email
        },
        error: function() 
        {
            swal('404', 'נמצאה שגיאה !','error');
        },
        success: function(data) 
        {
            if(data.status == true)
            {
                swal('שונה בהצלחה', data.message,'success');
            }
            else
            {
                swal('שינוי נכשל', data.message,'error');
            }
        }
     });
});

$(document).on('click','#settings-data-btn',function()
{
    var _firstname = $('#settings-firstname').val();
    var _lastname = $('#settings-lastname').val();
    var _address = $('#settings-address').val();
    var _city = $('#settings-city').val();
    var _zipcode = $('#settings-zipcode').val();
    var _gender = $('#settings-gender').val();
    var _dateOfBirth = $('#settings-dateOfBirth').val();
    var _phone = $('#settings-phone').val();
    var _csrf = $("input[name='_token']").val();

    $.ajax({
        url: '/api/settings',
        type: 'POST',
        headers: { 
            'X-CSRF-TOKEN': _csrf,
        },
        data: {
            settings_firstname: _firstname,
            settings_lastname: _lastname,
            settings_address: _address,
            settings_city: _city,
            settings_zipcode: _zipcode,
            settings_gender: _gender,
            settings_dateOfBirth: _dateOfBirth,
            settings_phone: _phone

        },
        error: function() 
        {
            swal('404', 'נמצאה שגיאה !','error');
        },
        success: function(data) 
        {
            if(data.status == true)
            {
                swal('שונה בהצלחה', data.message,'success');
            }
            else
            {
                swal('שינוי נכשל', data.message,'error');
            }
        }
     });
});

$(document).on('click','#settings-password-btn',function()
{
    var _password = $('#settings-password').val();
    var _password_new = $('#settings-password-new').val();
    var _password_new_confirm = $('#settings-password-new-confirm').val();
    var _csrf = $("input[name='_token']").val();

    $.ajax({
        url: '/api/settings',
        type: 'POST',
        headers: { 
            'X-CSRF-TOKEN': _csrf,
        },
        data: {
            settings_password: _password,
            settings_password_new: _password_new,
            settings_password_new_confirmation: _password_new_confirm

        },
        error: function(xhr, status, error)
        {
            if(xhr.responseText.errors)
            {
                var errors = '';
                $.each(xhr.responseText.errors, function( index, value )
                {
                    errors += value;
                });
                swal('שינוי נכשל', errors,'error');
                return;
            }
            swal('404', 'נמצאה שגיאה !','error');
        },
        success: function(data) 
        {
            if(data.status == true)
            {
                swal('שונה בהצלחה', data.message,'success');
            }
            else
            {
                swal('שינוי נכשל', data.message,'error');
            }
        }
     });
});

function initialize() {
var cityinput = document.getElementById('settings-city');
var addressinput = document.getElementById('settings-address');
var options = {
    types: ['(cities)'],
    componentRestrictions: {country: "il"}
};
var options2 = {
    componentRestrictions: {country: "il"}
};  

var autocomplete = new google.maps.places.Autocomplete(cityinput, options);
var autocomplete2 = new google.maps.places.Autocomplete(addressinput, options2);
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>