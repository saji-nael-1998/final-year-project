import {  wirteParkData} from "../firebase/addPark.js";
var parkRoute = [];
$("#addRoute").click(function () {
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
});



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

        let formData = new FormData(form);
        //add the operation 
        formData.append('operation', 'add-park');
        //remove src & dest field from formdata
        formData.delete("src");
        formData.delete("dest");

        if (parkRoute.length != 0) {
            var myJsonString = JSON.stringify(parkRoute);
            formData.append('routes', myJsonString);
        }

        $.ajax({
            url: '../../controller/ParkController.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                alert(data);
                wirteParkData();
            },
            cache: false,
            contentType: false,
            processData: false
        });



    }
});
export {parkRoute};