$(function () {
  
    $.ajax({
        method: "GET",
        url: "../../controller/OperatorController.php?getOperator=true",
    }).done(function (data) {
        var result= JSON.parse(data); 
        console.log(result[0].operatorID);
  
    });

});