var park_id = location.search.slice(1).split("&")[0].split("=")[1]

$.ajax({
    method: "GET",
    url: "../../controller/ParkController.php?action=getRecord&park_id=" + park_id,
}).done(function (data) {

    var result = JSON.parse(data);

    for (let key in result) {
        $("#" + key).val(result[key])
    }
});

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
        $.post("../../controller/ParkController.php", {
                "action": "updateRecord",
                park: {
                    "park_name": $("#park_name").val(),
                    "street": $("#street").val(),
                    "park_id": park_id
                }
            },
            function (data, status) {
                window.location.reload();
            });
    }

});

function setOperatorTable() {
    $(document).ready(function () {

        $('#operator-table').dataTable();
        $.ajax({
            method: "GET",
            url: "../../controller/OperatorController.php?getOperator=all",
        }).done(function (data) {

            var result = JSON.parse(data);

            for (let x = 0; x < result['data'].length; x++) {

                let fname = result['data'][x]['FName'];
                let lname = result['data'][x]['LName'];
                let email = result['data'][x]['email'];
                let id = result['data'][x]['ID'];
                let oid = result['data'][x]['operator_id'];
                let buttonTemplate = `<button id="${oid}-view" class="btn btn-primary">view</button>`;
                $('#operator-table').dataTable().fnAddData([
                    fname,
                    lname,
                    email,
                    id,
                    buttonTemplate
                ]);
                $(`#${oid}`).click(function () {

                    }

                );

            }
        });

    });
}
setOperatorTable();

function displayRouteTable(routes) {
    var table = $('#route-table').DataTable();
    //clear table
    table.clear().draw();

    for (let x = 0; x < routes.length; x++) {

        let route = routes[x];

        let editBtn = `<button id="${route.route_id}-e" class="edit-btn" style="color:white;" data-toggle="modal"data-target="#update-route-form"><a><i class="fas fa-edit"></i></a></button>`;

        let deleteLink = `../../controller/ParkController.php?action=deleteRoute&route_id=` + route.route_id;
        let removeBtn = `<button id="${route.route_id}-d" class='remove-btn'><a style="color:white;"><i class='far fa-trash-alt'></i></aa></button>`;

        let container = `
        <div   class="d-flex">
          
            ${editBtn}
            ${removeBtn}
        </div>`;

        table.row.add([
            route.src,
            route.dest.replace("-", " "),
            container
        ]).draw(false);
        $("#" + route.route_id + "-d").click(function () {
            $.ajax({
                method: "GET",
                url: deleteLink,
            }).done(function (data) {
                window.location.reload();
            });
        })
        $("#" + route.route_id + "-e").click(function () {
            setRouteField(route.dest)
            routeID = route.route_id
        })
    }

}
let routeID = null;

function setRouteField(dest) {
    $("#route_e").val(dest);
}

function setParkRouteTable() {
    $(document).ready(function () {

        $('#route-table').dataTable();
        $.ajax({
            method: "GET",
            url: "../../controller/ParkController.php?action=getAllRoutes&park_id=" + park_id,
        }).done(function (data) {
            var result = JSON.parse(data);
            displayRouteTable(result);

        });

    });
}
setParkRouteTable();

$('#addRow').on('click', function () {

    let destValue = $("#route").val();
    $("#route").val("");
    if ($('#route+label').length == 1) {
        $('#route+label').remove();
    }
    if (!destValue.trim()) {
        $("#route").after("<label class='error'>This field is required.</label>");
    } else {
        if (isText(destValue) == true) {
            let srcVlaue = $("#city").val();
            destValue = destValue.replace(" ", "-");

            $.post("../../controller/ParkController.php", {
                    "action": "addRoute",
                    data: {
                        "route": {
                            "park_id": park_id,
                            "src": srcVlaue,
                            "dest": destValue
                        }
                    }
                },
                function (data, status) {
                    window.location.reload();
                });

        } else {
            $("#route").after("<label class='error'>input must be letters only!!</label>");

        }
    }

});

function isText(inputtxt) {
    if (/^[a-zA-Z ]*$/g.test(inputtxt)) {
        return true;
    } else {
        return false;
    }
}
$('#updateRow').on('click', function () {

    let destValue = $("#route_e").val();
    $("#route_e").val("");
    if ($('#route_e+label').length == 1) {
        $('#route_e+label').remove();
    }
    if (!destValue.trim()) {
        $("#route_e").after("<label class='error'>This field is required.</label>");
    } else {
        if (isText(destValue) == true) {
            let srcVlaue = $("#city").val();
            destValue = destValue.replace(" ", "-");

            $.post("../../controller/ParkController.php", {
                    "action": "updateRoute",
                    data: {
                        "route": {
                            "route_id": routeID,

                            "dest": destValue
                        }
                    }
                },
                function (data, status) {
                    window.location.reload();
                });

        } else {
            $("#route_e").after("<label class='error'>input must be letters only!!</label>");

        }
    }

});