
function isImage(filename) {
    var ext = filename.split('.').pop();
    switch (ext.toLowerCase()) {
        case 'jpg':
        case 'gif':
        case 'bmp':
        case 'png':
            //etc
            return true;
    }
    return false;
}
jQuery.validator.addMethod("checkImage", function (value, element) {
    return isImage(value);
}, "please select valid image!!");
var registrationForm = $('#registration');

    registrationForm.validate({
        rules: {
            FName: {
                required: true,

            },
            MName: {

            },

            LName: {
                required: true,

            },

            ID: {
                required: true,
            },
            birthDate: {
                required: true,
                date: true,
            },
            imagePath: {
                required: true,
                checkImage: true
            },
            email: {
                required: true,
            },
            phoneNO: {
                required: true,
            },
            pass: {
                required: true,
            },
            CPass: {
                required: true,
                equalTo: '#pass'
            }

        },
        messages: {
            FName: {
                required: 'Please enter First Name!'
            },
            MName: {
                required: 'Please enter Mid Name!'
            },
            LName: {
                required: 'Please enter Last Name!'
            },
            ID: {
                required: 'Please enter ID!'
            },
            birthDate: {
                required: 'Please enter birthdate!'
            },
            imagePath: {
                required: 'Please enter image!'
            },
            email: {
                required: 'Please enter email!'
            },
            phoneNO: {
                required: 'Please enter phone!'
            },
            pass: {
                required: 'Please enter password!'
            },
            CPass: {
                required: 'Please enter confirm pass!',
                equalTo: 'Please enter same password!'
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            // do other things for a valid form
            $('#registration').submit(function (event) {
                event.preventDefault()
                // make selected form variable
                var vForm = $(this);
                var formData = new FormData(this);
                $.ajax({
                    url: '../../controller/OperatorController.php',
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        alert(data)
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        }
    });
