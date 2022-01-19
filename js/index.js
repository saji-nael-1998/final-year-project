
function getCurrentDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = mm + '-' + dd + '-' + yyyy;
    return today;
}
function getParkReports(parkID){
    $.get(`controller/ParkController.php?getRecord=all`, function (data, status) {
        var result = JSON.parse(data);
        for(let x=0;x<result['data'].length;x++){
      
            if(result['data'][x].park_id==parkID){
                sessionStorage.setItem("report_park_name", result['data'][x].park_name);
                sessionStorage.setItem("report_park_id", parkID);
                sessionStorage.setItem("date", getCurrentDate());
                location.replace("view/statistics-view/report.html")
                break;

           }
        }
    });
    sessionStorage.setItem("parkID_report", "parkID");   
}
$('#example').DataTable({
    ajax: {
        url: 'controller/ParkController.php?getRecord=all',
        dataSrc: 'data'
    },

    columns: [{
            "data": "park_name"
        }, {
            "data": "street"
        }, {
            "data": "city"
        },
        {
            "data": "park_id",
            render: function (data, type, row) {

                let editBtn = `<button onclick="getParkReports(${data})" class="choose-btn"><span>Select</span></button>`;
                let container = `
                                <div   class="d-flex">
                                  
                                    ${editBtn}
                                    
                                </div>`;


                return container;
            }
        }
    ]



});
$.get(`controller/indexController.php?operation=get-driver-count`, function (data, status) {
    alert(data)
    var result = JSON.parse(data);
    $("#driver-num").append(result.size);
});
$.get(`controller/indexController.php?operation=get-taxi-count`, function (data, status) {
    var result = JSON.parse(data);
   
    $("#taxi-num").append(result.size);
});
$.get(`controller/indexController.php?operation=get-park-count`, function (data, status) {
    var result = JSON.parse(data);

    $("#park-num").append(result.size);
});
$.get(`controller/indexController.php?operation=get-operator-count`, function (data, status) {
    var result = JSON.parse(data);
    $("#operator-num").append(result.size);
});

