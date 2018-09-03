var OpAuthSignUp = function() {
    // Init Sign Up Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
    var initValidationSignUp = function(){
        jQuery('.js-validation-signup').validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: {
                'signup-schoolnum': {
                    required: true
                },
                'signup-username': {
                    required: true,
                    minlength: 3
                },
                'signup-email': {
                    required: true,
                    email: true
                },
                'signup-password': {
                    required: true,
                    minlength: 5
                },
                'signup-password-confirm': {
                    required: true,
                    equalTo: '#signup-password'
                },
                'signup-terms': {
                    required: true
                }
            },
            messages: {
                'signup-schoolnum': {
                    required: 'אנא הכנס מספר בית ספר',
                    min: 'מספר בית ספר לא תקין'
                },
                'signup-username': {
                    required: 'אנא הכנס שם משתמש',
                    minlength: 'שם המשתמש חייב להכיל 3 תווים לפחות'
                },
                'signup-username': {
                    required: 'אנא הכנס שם משתמש',
                    minlength: 'שם המשתמש חייב להכיל 3 תווים לפחות'
                },
                'signup-email': 'אנא הכנס מייל תקין',
                'signup-password': {
                    required: 'אנא הכנס סיסמא',
                    minlength: 'הסיסמה חייבת להכיל 6 תווים לפחות'
                },
                'signup-password-confirm': {
                    required: 'אנא הכנס אימות סיסמא',
                    minlength: 'הסיסמה חייבת להכיל 6 תווים לפחות',
                    equalTo: 'סיסמא ואיממות סיסמא חייבים להיות דומים !'
                },
                'signup-terms': 'כדי להרשם לאתר עליך להסכים לתנאי השימוש !'
            }
        });
    };

    return {
        init: function () {
            // Init SignUp Form Validation
            initValidationSignUp();
        }
    };
}();

$( "#signup-btn" ).click(function()
{
    if(!$('.js-validation-signup').valid())
        return;
    
    var _schoolNum = $('#signup-schoolnum').val();
    var _username = $('#signup-username').val();
    var _password = $('#signup-password').val();
    var _passwordconfirm = $('#signup-password_confirmation').val();
    var _csrf = $("input[name='_token']").val();
    var _tos = $("#signup-tos").is(':checked');

    $.ajax({
        url: '/api/register',
        type: 'POST',
        headers: { 
            'X-CSRF-TOKEN': _csrf,
        },
        data: {
            auth_schoolnum: _schoolNum,
            auth_username: _username,
            auth_password: _password,
            auth_password_confirmation: _passwordconfirm,
            auth_tos: _tos
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
                swal('הרשמה נכשלה', errors,'error');
                return;
            }
            swal('404', 'נמצאה שגיאה !','error');
        },
        success: function(data) 
        {
            if(data.status == true)
            {
                swal('הרשמה הצליחה', data.message,'success');
                setTimeout(function(){ window.location.replace("/login"); }, 2000);
            }
            else
            {
                swal('הרשמה נכשלה', data.message,'error');
            }
        }
     });
});

// Initialize when page loads
jQuery(function(){ OpAuthSignUp.init(); });