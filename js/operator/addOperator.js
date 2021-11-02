
function isPhone(phone) {

    var patt1 = /^059|^056/g;
    var result = phone.match(patt1);
    if (result) {
        return true;
    } else {
        return false;
    }
}

function isEmail(email)

{
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {

        return (true)
    }

    return (false)

}

function isText(inputtxt) {
    if (/^[a-zA-Z]*$/g.test(inputtxt)) {

        return true;
    } else {
        return false;
    }
}

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
jQuery.validator.addMethod("isImage", function (value, element) {
    return isImage(value);
}, "please select valid image!!");
jQuery.validator.addMethod("isText", function (value, element) {
    return isText(value);
}, "input must be letters only!!");
jQuery.validator.addMethod("isEmail", function (value, element) {
    return isEmail(value);
}, "enter valid email!!");
jQuery.validator.addMethod("isPhone", function (value, element) {

    return isPhone(value);
}, "enter valid phone!!");

$('#registration').submit(function (e) {
    e.preventDefault();

}).validate({
    rules: {
        FName: {
            required: true,
            isText: true

        },
        MName: {

            isText: true
        },

        LName: {
            required: true,
            isText: true

        },

        ID: {
            required: true,
            minlength: 9,
            maxlength: 9,
            number: true
        },
        birthDate: {
            required: true,
            date: true,

        },
        imagePath: {
            required: true,
            isImage: true
        },
        email: {
            required: true,
            isEmail: true
        },
        phoneNO: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
            isPhone: true

        },
        pass: {
            required: true,
            minlength: 6,
            maxlength: 25
        },
        CPass: {
            required: true,
            equalTo: '#pass'
        }

    },
    messages: {

        phoneNO: {
            minlength: "phone must be at least 10 number long",
            maxlength: "phone must be at least 10 number long",
            number: "phone must be only numbers",
            isPhone: "phone must start with 059 or 056"
        },
        ID: {
            minlength: "phone must be at least 9 number long",
            maxlength: "phone must be at least 9 number long",
            number: "phone must be only numbers"
        }

    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    submitHandler: function (form) {
      
        
        //add the operation 
        formData.append('operation', 'add-operator');
       
        $.ajax({
            url: '../../controller/OperatorController.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                
                if(data === "true"){
                 alert("the Operator has been added successfully!!");
                }else{
                    $('#msg span').empty();
                    if(data === "-1"){
                        $('#msg span').html("email already registered in the system");
                    }
                    if(data === "1"){
                        $('#msg span').html("operator already registered in the system");
                    }
                    $('#msg').addClass("show");
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });



    }
});