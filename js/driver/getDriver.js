$(function () {
    alert(12);
    $.ajax({
        method: "GET",
        url: "../../controller/DriverController.php?getDriver=true",
    }).done(function (data) {
        var result= JSON.parse(data); 
        console.log(result[0].driverID);
  
    });

});