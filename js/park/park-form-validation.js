//  validation section 
function displayParkForm() {
    let form = ` <div class="container p-3">
    <h3>Park Form</h3>
    <h6>Please complete the form </h6>
    <form id="park-form" method="POST">
        <div class="container-fluid p-0">
            <div class="row m-0 d-flex flex-column my-3">
                <h5>Park Name</h5>
                <div class="row col m-0 p-0">
                    <div class="col-lg-4 col-sm-12 p-0">
                        <input type="text" id="park_name" name="park_name" class="form-control">
                        <small class="form-text text-muted">
                            park name </small>
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

                <div class="row d-flex justify-content-end  col m-0 p-0">
                    <div class="col-lg-4 col-sm-12 p-0">
                        <input type="submit" value="NEXT" class="form-control">

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>`;
    return form;
}

function displayRouteForm() {
    let form = ` <div class="container p-3">
    <h3>Route Form</h3>
    <h6>Please complete the form </h6>
    <form id="route-form">
        <div class="container-fluid p-0">

            <div class="row m-0 d-flex flex-column my-3">
                <h5>Route</h5>
                <div class="row col m-0 p-0">
                    <div class="col-lg-4 col-sm-12 p-0">
                        <select class="form-control" id="src" name="src">
                            <option value="Ramallah">Ramallah</option>

                        </select>
                        <small class="form-text text-muted">
                            source </small>
                    </div>
                    <div class="col-lg-4 col-sm-12 p-0">
                        <input type="text" id="dest" name="dest" class="form-control">
                        <small class="form-text text-muted">
                            destination </small>
                    </div>
                    <div class="col-lg-2 col-sm-12 p-0">
                        <button id="addRow" type="button" class="btn btn-success">Add</button>
                    </div>
                </div>
            </div>
            <div class="row m-0 d-flex flex-column my-3">

                <div class="col-lg-12 table-responsive p-0">
                    <table id="example" class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Source</th>
                                <th>Destination</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                    </table>
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
</div>`;
    return form;
}
//display  park form
$("#form-container").append(displayParkForm());

let data = null;

function isText(inputtxt) {
    if (/^[a-zA-Z ]*$/g.test(inputtxt)) {
        return true;
    } else {
        return false;
    }
}

jQuery.validator.addMethod("isText", function (value, element) {
    return isText(value);
}, "input must be letters only!!");
$('#park-form').validate({
    rules: {
        park_name: {
            required: true,
            isText: true
        },
        city: {
            required: true,
            isText: true
        },
        street: {
            required: true,
            isText: true
        }

    },
    messages: {


    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    submitHandler: function (form) {

        data = {
            "park": {
                "park_name": $("#park_name").val(),
                "street": $("#street").val(),
                "city": $("#city").val(),
                "routes": []
            }


        }
        $("#form-container").empty();
        //display  park form
        $("#form-container").append(displayRouteForm());
        setRouteFromValidation(data);
    }

});

function displayRouteTable(routes) {
    var table = $('#example').DataTable();
    //clear table
    table.clear().draw();

    for (let x = 0; x < routes.length; x++) {
        let route = routes[x];
        let deleteBTN = `<button id="${route}" class="btn btn-danger"><span>remove</span></button>`;

        table.row.add([
            data.park.city,
            route.replace("-", " "),
            deleteBTN
        ]).draw(false);
        $("#" + route).click(function () {
            let index = data.park.routes.indexOf(route, 0);
            data.park.routes.splice(index, 1);
            displayRouteTable(data.park.routes);
        })
    }

}

function setRouteFromValidation(data) {
    var table = $('#example').DataTable();
    jQuery.validator.addMethod("isText", function (value, element) {
        return isText(value);
    }, "input must be letters only!!");
    $('#route-form').submit(function (e) {
        e.preventDefault();
    }).validate({
        submitHandler: function (form) {
            $.post("../../controller/ParkController.php", {
                    "action": "createRecord",
                    data: data
                },
                function (data, status) {
                    if (data == 1)

                        location.replace("index.html");
                        else{
                            alert(data)
                        }
                });

        }

    });
    //set action for add button 
    $('#addRow').on('click', function () {

        let destValue = $("#dest").val();
        $("#dest").val("");
        if ($('#dest+label').length == 1) {
            $('#dest+label').remove();
        }
        if (!destValue.trim()) {
            $("#dest").after("<label class='error'>This field is required.</label>");
        } else {
            if (isText(destValue) == true) {
                let srcVlaue = $("#src").val();
                destValue = destValue.replace(" ", "-");
                data.park.routes.push(destValue);
                displayRouteTable(data.park.routes);


            } else {
                $("#dest").after("<label class='error'>input must be letters only!!</label>");

            }
        }

    });
}