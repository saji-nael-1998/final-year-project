
function getParkReports(parkID){
    $.get(`../../controller/ParkController.php?getRecord=all`, function (data, status) {
        var result = JSON.parse(data);
        for(let x=0;x<result['data'].length;x++){
      
            if(result['data'][x].park_id==parkID){
                sessionStorage.setItem("report_park_name", result['data'][x].park_name);
                sessionStorage.setItem("report_park_id", parkID);
                location.replace("days.html")
                break;

           }
        }
    });
    sessionStorage.setItem("parkID_report", "parkID");
    
}
$('#example').DataTable({
    ajax: {
        url: '../../controller/ParkController.php?getRecord=all',
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

