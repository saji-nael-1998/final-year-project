function isId(inputtxt) {
    return /^[a-zA-Z0-9\-]*$/g.test(inputtxt);
}

function isText(inputtxt) {
    return /^[a-zA-Z]*$/g.test(inputtxt);
}

function isImage(filename) {
    if ($("input[name='taxi_id']").prop('disabled')) {
        return true;
    }
    let ext = filename.split('.').pop();
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
jQuery.validator.addMethod("isId", function (value, element) {
    return isId(value);
}, "Please enter valid id");

$('#registration').submit(function (e) {
    e.preventDefault();
}).validate({
    rules: {
        taxi_id: {
            required: true,
            isId: true,
            minlength: 7
        },
        model: {
            required: true,
            isText: true,
            minlength: 3
        },
        year: {
            required: true,
            minlength: 4,
            maxlength: 4,
            number: true
        },
        capacity: {
            required: true,
            minlength: 1,
            maxlength: 2,
            number: true
        },
        end_date: {
            required: true,
            date: true,
        },
        license_photo: {
            isImage: true
        },
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    submitHandler: function (form) {
        let formData = new FormData(form);
        let searchParams = new URLSearchParams(window.location.search)
        if (searchParams.has('id')) {
            let id = searchParams.get('id');
            formData.append('taxi_id', id)
            formData.append('action', 'update')
        } else {
            formData.append('action', 'add')
        }
        $.ajax({
            url: '../../controller/TaxiController.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                alert(data)
                if (data == 0) {
                    location.replace("../../view/taxi_view/taxi-table.php");
                } else {
                    alert("the Taxi already exists!");
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
});