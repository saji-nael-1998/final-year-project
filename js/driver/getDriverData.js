 var user_id = location.search.slice(1).split("&")[0].split("=")[1]
 $.get("../../controller/DriverController.php?getDriver=" + user_id, function (data) {
     const obj = JSON.parse(data);
     var x = $("form").serializeArray();
     for (var att in obj) {
         $.each(x, function (i, field) {
             if (field.name === att) {
                 let id = "#" + att;
                   
                 if (id == "#phoneNO"){

                    $(id).val("0"+obj[att]);
                 }else{
                    $(id).val(obj[att]);
                 }
                    
             }
         });
     }
     $("#licence_img").attr('src', obj.imagePath);
     $("#CPass").val(obj.pass);
 });