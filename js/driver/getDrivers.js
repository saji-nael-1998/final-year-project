$(function () {

    $.ajax({
        method: "GET",
        url: "../../controller/driverController.php?getDriver=1",
    }).done(function (data) {
        var result= JSON.parse(data); 
        console.log(result[0].operatorID);
       $("#table tbody").append("<tr><td></td> <tr>");
    });

});