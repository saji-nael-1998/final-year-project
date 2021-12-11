var park_id = -1;

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
    if (/^[a-zA-Z ]*$/g.test(inputtxt)) {

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

function setOperatorFormValidation() {
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

    $('#operator-form').submit(function (e) {
        e.preventDefault();

    }).validate({
        rules: {
            FName: {
                required: true,
                isText: true

            },
            MName: {
                required: true,
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
            street: {
                required: true,
                isText: true

            },
            city: {
                required: true,
            },
            birthdate: {
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

            let formData = new FormData(form);
            //add the operation 
            formData.append('operation', 'add-record');
            formData.append('park_id', park_id);
            $.ajax({
                url: '../../controller/OperatorController.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    alert(data)
                    if (data == 0) {
                        location.replace('../../view/operator-view/index.html');
                    } else {
                        if (data == 1) {
                            $("#model-msg").empty();
                            $("#model-msg").append("The operator already exists !!");
                            $("#myModal").modal('show');
                        } else if (data == -1) {
                            $("#model-msg").empty();
                            $("#model-msg").append("the email already registered !!");
                            $("#myModal").modal('show');
                        }
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });



        }
    });
}

function displayOperatorForm(id) {
    $("#main-body").empty();
    park_id = id;
    let form = ` <div class="row m-0">
    <div id="form-container" class="container p-3">
        <h3>Employment Application</h3>
        <h6>Please complete the form </h6>
        <form id="operator-form">
            <div class="container-fluid p-0">
                <div class="row m-0 d-flex flex-column my-3">
                    <h5>Full Name</h5>
                    <div class="row col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="FName" name="FName" class="form-control">
                            <small class="form-text text-muted">
                                first name </small>
                        </div>
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="MName" name="MName" class="form-control">
                            <small class="form-text text-muted">
                                mid name </small>
                        </div>
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="LName" name="LName" class="form-control">
                            <small class="form-text text-muted">
                                last name </small>
                        </div>
                    </div>

                </div>
                <div class="row m-0 d-flex flex-column my-3">
                    <h5>Birthdate</h5>
                    <div class="row col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="date" id="birthdate" name="birthdate" class="form-control">
                            <small class="form-text text-muted">
                                birthdate </small>
                        </div>
                        <div class="col-lg-4 col-sm-12 p-0">
                        <input type="text" id="ID" name="ID" class="form-control">
                        <small class="form-text text-muted">
                            ID </small>
                         </div>
                    </div>

                </div>
                <div class="row m-0 d-flex flex-column my-3">
                    <h5>Address</h5>
                    <div class="row col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="street" name="street" class="form-control">
                            <small class="form-text text-muted">
                                street address </small>
                        </div>
                        <div class="col-lg-4 col-sm-12 p-0">
                            <select class="form-control" id="city" name="city">
                                <option value="Ramallah">Ramallah</option>

                            </select>
                            <small class="form-text text-muted">
                                city </small>
                        </div>

                    </div>

                </div>
                <div class="row m-0 d-flex flex-column my-3">
                    <h5>Contact Information</h5>
                    <div class="row col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="email" id="email" name="email" class="form-control">
                            <small class="form-text text-muted">
                                email </small>
                        </div>
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="phoneNO" name="phoneNO" class="form-control">
                            <small class="form-text text-muted">
                                phone </small>
                        </div>

                    </div>

                </div>
                <div class="row m-0 d-flex flex-column my-3">
                    <h5>Account Information</h5>
                    <div class="row col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="pass" name="pass" class="form-control">
                            <small class="form-text text-muted">
                                password </small>
                        </div>
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="CPass" name="CPass" class="form-control">
                            <small class="form-text text-muted">
                                confirm password </small>
                        </div>

                    </div>

                </div>
                <div class="row m-0 d-flex flex-column my-3">
                    <h5>Upload Photo</h5>
                    <div class="row col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="file" id="imagePath" name="imagePath" class="form-control">
                            <small class="form-text text-muted">
                                profile photo </small>
                        </div>


                    </div>

                </div>
                <div class="row m-0 d-flex flex-column my-3">

                    <div class="row d-flex justify-content-end  col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="submit" class="form-control">

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>`;
    $("#main-body").append(form);
    setOperatorFormValidation();
}


$('#example').DataTable({
    ajax: {
        url: '../../controller/ParkController.php?getRecord=all',
        dataSrc: 'data'
    },

    columns: [{
            "data": "park_name"
        }, {
            "data": "street"
        }, {
            "data": "city"
        },
        {
            "data": "park_id",
            render: function (data, type, row) {

                let editBtn = `<button onclick="displayOperatorForm(${data})" class="choose-btn"><span>Select</span></button>`;
                let container = `
                                <div   class="d-flex">
                                  
                                    ${editBtn}
                                    
                                </div>`;


                return container;
            }
        }
    ]


});