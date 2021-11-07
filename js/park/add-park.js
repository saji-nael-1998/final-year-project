var parkRoute = [];

function addRoute() {
    //get values from fields 
    let src = $('#src').val();
    let dest = $('#dest').val();
    //create an object 
    let route = {
        src: src,
        dest: dest
    };
    //push object to array
    parkRoute.push(route);
    addToTable();
}


function addToTable() {
    //clear the table
    $('tbody').empty();
    for (var x = 0; x < parkRoute.length; x++) {
        let number = "<td>" + (x + 1) + "</td>";
        let src = "<td>" + parkRoute[x].src + "</td>";
        let dest = "<td>" + parkRoute[x].dest + "</td>";
        let remove = "<td><button type='button' onclick='removeFromTable(" + (x) + ")' class='btn btn-danger'>delete</button></td>";
        let row = "<tr>" + number + src + dest + remove + "</tr>";
        //add to table 
        $('tbody').append(row);
    }
}

function removeFromTable(index) {
    parkRoute.splice(index, 1);
    addToTable();
}


//  validation section 
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
$('#registration').submit(function (e) {
    e.preventDefault();
}).validate({
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


        //add the operation 
        formData.append('operation', 'add-operator');

        $.ajax({
            url: '../../controller/OperatorController.php',
            type: 'POST',
            data: formData,
            success: function (data) {

                if (data === "true") {
                    alert("the Operator has been added successfully!!");
                } else {
                    $('#msg span').empty();
                    if (data === "-1") {
                        $('#msg span').html("email already registered in the system");
                    }
                    if (data === "1") {
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