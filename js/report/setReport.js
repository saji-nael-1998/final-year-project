$(document).ready(function () {
    $('#driver-list').dataTable();
    $('#operator-list').dataTable();
    $('#trip-history').dataTable();
});

//connect to firebase
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/9.5.0/firebase-app.js";
import {
    getDatabase,
    onValue,
    ref,
    set,
    get,
    child,
    update
} from "https://www.gstatic.com/firebasejs/9.5.0/firebase-database.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries
// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCcgd7L-Qi_r8sMGu-C_r-VpRWhFQkkPv4",
    authDomain: "final-project-533d7.firebaseapp.com",
    projectId: "final-project-533d7",
    storageBucket: "final-project-533d7.appspot.com",
    messagingSenderId: "666735050862",
    appId: "1:666735050862:web:637053cdd421a6771ba67f"
};
const app = initializeApp(firebaseConfig);

const db = getDatabase();
//set report
var dateOfReport = sessionStorage.getItem("date");

function setDriverList(driverList) {
    let parkID=sessionStorage.getItem("report_park_id");
    let count= Object.keys(driverList).length;
    $("#taxi-amount").append(count)
   
    $.get(`../../controller/reportController.php?operation=get-drivers&park_id=${parkID}`, function (data, status) {
      
        var result = JSON.parse(data);
        for (let driver in driverList) {
            for (let x = 0; x < result['data'].length; x++) {
                let d = result['data'][x];

                if (d.driver_id === driver) {
                    let buttonTemplate = `<button id="${driver}" class="btn btn-primary" data-toggle="modal" data-target="#driverModal">view</button>`;
                    if (driverList[driver].endShfitTime === undefined) {
                        $('#driver-list').dataTable().fnAddData([
                            d.FName + " " + d.LName,
                            driverList[driver].startShfitTime,
                            "still working",
                            buttonTemplate
                        ]);
                    } else {
                        $('#driver-list').dataTable().fnAddData([
                            d.FName + " " + d.LName,
                            driverList[driver].startShfitTime,
                            driverList[driver].endShfitTime,
                            buttonTemplate
                        ]);
                    }

                    $(`#${driver}`).click(function () {

                        $("#driver-photo").attr("src", "../../../final_year_project/" + d.imagePath);
                        $("#driver-name").empty();
                        $("#driver-name").append("Name:<br>" + d.FName + " " + d.LName);
                        $("#driver-email").empty();
                        $("#driver-email").append("Email:<br>" + d.email);
                        $("#driver-birthdate").empty();
                        $("#driver-birthdate").append("BirthDate:<br>" + d.birthdate);
                        $("#driver-location").empty();
                        $("#driver-location").append("Address:<br>" + d.street + "," + d.city);
                        $("#driver-route").empty();
                        $("#driver-route").append("Route:<br>" + d.dest);
                        $("#driver-taxi").empty();
                        $("#driver-taxi").append("Taxi Plate No:<br>" + d.plate_no);
                        const myArray = dateOfReport.split("-");
                        let date = myArray[2] + "-" + myArray[0] + "-" + myArray[1];

                        $.get(`../../controller/reportController.php?operation=get-driver-trip&driver_id=${d.driver_id}&date=${date}`, function (data, status) {
                            var result = JSON.parse(data);
                            var table = $('#trip-history').DataTable();
                            table .clear() .draw();
                            for (let x = 0; x < result['data'].length; x++) {
                                let trip = result['data'][x];
                               
                                $('#trip-history').dataTable().fnAddData([
                                    trip.start_trip_time,
                                    trip.end_trip_time,
                                    trip.totalRider
                                ]);
                            }
                        });
                    });
                    break;
                }
            }
        }

    });

}

function setOperatorList(operatorList) {
    let parkID=sessionStorage.getItem("report_park_id");
    let count= Object.keys(operatorList).length;
    $("#operator-amount").append(count)
    $.get(`../../controller/reportController.php?operation=get-operator&park_id=${parkID}`, function (data, status) {
       
        var result = JSON.parse(data);
        for (let operator in operatorList) {
            for (let x = 0; x < result['data'].length; x++) {
                let d = result['data'][x];

                if (d.operator_id === operator) {
                    let buttonTemplate = `<button id="${operator}" class="btn btn-primary" data-toggle="modal" data-target="#operatorModel">view</button>`;
                    if (operatorList[operator].endShfitTime === undefined) {
                        $('#operator-list').dataTable().fnAddData([
                            d.FName + " " + d.LName,
                            operatorList[operator].startShiftTime,
                            "still working",
                            buttonTemplate
                        ]);
                    } else {
                        $('#operator-list').dataTable().fnAddData([
                            d.FName + " " + d.LName,
                            operatorList[operator].startShiftTime ,
                            operatorList[operator].endShfitTime,
                            buttonTemplate
                        ]);
                    }

                    $(`#${operator}`).click(function () {
                        $("#operator-photo").attr("src", "../../../final_year_project/" + d.imagePath);
                        $("#operator-name").empty();
                        $("#operator-name").append("Name:<br>" + d.FName + " " + d.LName);
                        $("#operator-email").empty();
                        $("#operator-email").append("Email:<br>" + d.email);
                        $("#operator-birthdate").empty();
                        $("#operator-birthdate").append("BirthDate:<br>" + d.birthdate);
                        $("#operator-location").empty();
                        $("#operator-location").append("Address:<br>" + d.street + "," + d.city);

                    });
                    break;
                }
            }
        }

    });

}

function setReport() {
    let parkName=sessionStorage.getItem("report_park_name");
    const dbRef = ref(getDatabase());
    get(child(dbRef, `days/${dateOfReport}/${parkName}/`)).then((snapshot) => {

        if (snapshot.exists()) {
            let data = snapshot.val();
            console.log(JSON.stringify(data))
            let driverList = data.driver_shifts;
            setDriverList(driverList)
            let operatorList = data.operator_shifts;
            setOperatorList(operatorList);
        } else {
            alert("No date !!");
        }
    }).catch((error) => {
        console.error(error);
    });
}
setReport();