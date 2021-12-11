function isText(inputtxt) {
    if (/^[a-zA-Z ]*$/g.test(inputtxt)) {

        return true;
    } else {
        return false;
    }
}

function setTaxiValidation(route_id) {

    jQuery.validator.addMethod("isText", function (value, element) {
        return isText(value);
    }, "input must be letters only!!");

    $('#taxi-form').submit(function (e) {
        e.preventDefault();

    }).validate({
        rules: {
            brand: {
                required: true,
                isText: true

            },

            car_year: {
                required: true,
                minlength: 4,
                maxlength: 4,
                number: true
            },

            reqistration_date: {
                required: true,
                date: true,

            },

            plate_no: {
                required: true,
                minlength: 7,
                maxlength: 7,
                number: true
            }

        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {

            let formData = new FormData(form);
            //add the operation 
            formData.append('operation', 'add-record');
            formData.append('route_id', route_id);
            $.ajax({
                url: '../../controller/TaxiController.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    alert(data)
                    if (data == 0) {
                        location.replace('../../view/operator-view/index.html');
                    } else {
                        /*if (data == 1) {
                            $("#model-msg").empty();
                            $("#model-msg").append("The operator already exists !!");
                            $("#myModal").modal('show');
                        } else if (data == -1) {
                            $("#model-msg").empty();
                            $("#model-msg").append("the email already registered !!");
                            $("#myModal").modal('show');
                        }*/
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });



        }
    });
}

function displayTaxiForm(route_id) {
    $("#main-body").empty();
    let form = ` <div class="row m-0">
    <div id="form-container" class="container p-3">
        <h3>Car Form</h3>
        <h6>Please complete the form </h6>
        <form id="taxi-form">
            <div class="container-fluid p-0">
                <div class="row m-0 d-flex flex-column my-3">
                    <h5>Car Details</h5>
                    <div class="row col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="brand " name="brand" class="form-control">
                            <small class="form-text text-muted">
                                brand </small>
                        </div>
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="text" id="car_year" name="car_year" class="form-control">
                            <small class="form-text text-muted">
                               year </small>
                        </div>
                    </div>

                </div>
                <div class="row m-0 d-flex flex-column my-3">
                    <h5>Extra Details</h5>
                    <div class="row col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="date" id="reqistration_date" name="reqistration_date" class="form-control">
                            <small class="form-text text-muted">
                            reqistration date </small>
                        </div>
                        <div class="col-lg-4 col-sm-12 p-0">
                        <input type="text" id="plate_no" name="plate_no" class="form-control">
                        <small class="form-text text-muted">
                            plate no </small>
                         </div>
                    </div>

                </div>
               
                <div class="row m-0 d-flex flex-column my-3">

                    <div class="row d-flex justify-content-end  col m-0 p-0">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <input type="submit" value="submit" class="form-control">

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>`;
    $("#main-body").append(form);
    setTaxiValidation(route_id);
}

function setRouteTable(park_id) {
    $('#example').DataTable({
        ajax: {
            url: `../../controller/TaxiController.php?operation=park-routes&park_id=${park_id}`,
            dataSrc: 'data'
        },

        columns: [{
                "data": "src"
            }, {
                "data": "dest"
            },
            {
                "data": "route_id",
                render: function (data, type, row) {

                    let editBtn = `<button onclick="displayTaxiForm(${data})"   class="choose-btn"><span>Select</span></button>`;
                    let container = `
                                    <div   class="d-flex">
                                      
                                        ${editBtn}
                                        
                                    </div>`;


                    return container;
                }
            }
        ]


    });
}

function displayRouteTable(park_id) {
    $("#main-body").empty();
    let table = `<div id="park-table-container" class="row  m-0">
                    <div class="container-fluid">
                        <div class="row m-0">
                            <div class="col">
                                <h6 style="color: white;"><strong>Choose Park</strong></h6>
                            </div>
                        </div>
                        <div class="row m-0 mt-3">
                            <div class="col">
                                <div class="table-responsive-lg ">
                                    <table id="example" class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Source</th>
                                                <th>Destination</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>`;
    $("#main-body").append(table);
    setRouteTable(park_id);

}

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
        plate_no: {
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
$('#example').DataTable({
    ajax: {
        url: '../../controller/TaxiController.php?operation=get-parks',
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

                let editBtn = `<button onclick="displayRouteTable(${data})" class="choose-btn"><span>Select</span></button>`;
                let container = `
                                <div   class="d-flex">
                                  
                                    ${editBtn}
                                    
                                </div>`;


                return container;
            }
        }
    ]


});