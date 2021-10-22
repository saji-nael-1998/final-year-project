$(function () {
    alert(12);
    $.ajax({
        method: "GET",
        url: "../../controller/DriverController.php?getDriver=1",
    }).done(function (data) {
        var result= JSON.parse(data); 
        console.log(result[0].driver_id);
  
    });

});