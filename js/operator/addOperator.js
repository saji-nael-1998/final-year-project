var counter = 0;

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

$('#registration').submit(function (e) {
    e.preventDefault();

}).validate({
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
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    submitHandler: function (form) {
        var formData = new FormData(form);
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
                alert("the Operator already exists!!");
               }
            },
            cache: false,
            contentType: false,
            processData: false
        });



    }
});