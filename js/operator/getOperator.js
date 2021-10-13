$(function () {

    $.ajax({
        method: "GET",
        url: "../../controller/OperatorController.php?getOperator=1",
    }).done(function (data) {
        var result= JSON.parse(data); 
        console.log(result[0].operatorID);
       $("#table tbody").append("<tr><td></td> <tr>");
    });

});