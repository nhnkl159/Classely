var OpAuthSignIn = function() {
    // Init Sign In Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
    var initValidationSignIn = function(){
        jQuery('.js-validation-signin').validate({
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
                'login-username': {
                    required: true,
                    minlength: 3
                },
                'login-password': {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                'login-username': {
                    required: 'אנא הכנס שם משתמש',
                    minlength: 'שם המשתמש חייב להכיל 3 תווים לפחות'
                },
                'login-password': {
                    required: 'אנא הכנס סיסמא',
                    minlength: 'הסיסמה חייבת להכיל 6 תווים לפחות'
                }
            }
        });
    };

    return {
        init: function () {
            // Init Sign In Form Validation
            initValidationSignIn();
        }
    };
}();

$( "#login-btn" ).click(function()
{
    if(!$('.js-validation-signin').valid())
        return;
    
    var _username = $('#login-username').val();
    var _password = $('#login-password').val();
    var _csrf = $("input[name='_token']").val();
    var _remember = $("#login-remember-me").is(':checked');

    $.ajax({
        url: '/api/login',
        type: 'POST',
        headers: { 
            'X-CSRF-TOKEN': _csrf,
        },
        data: {
            auth_username: _username,
            auth_password: _password,
            auth_remember: _remember
        },
        error: function() 
        {
            swal('404', 'נמצאה שגיאה !','error');
        },
        success: function(data) 
        {
            if(data.status == true)
            {
                swal('התחברות הצליחה', data.message,'success');
                setTimeout(function(){ location.reload(); }, 2000);
            }
            else
            {
                swal('התחברות נכשלה', data.message,'error');
            }
        }
     });
});

// Initialize when page loads
jQuery(function(){ OpAuthSignIn.init(); });