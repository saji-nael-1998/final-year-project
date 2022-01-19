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



//set table 

function setTable(data) {

    $(document).ready(function () {
        $('#example').dataTable();
    });

    for (let x = 0; x < data.length; x++) {
        let date = data[x].date;
        let day = data[x].day;
        let buttonTemplate = `<button id="${date}" class="btn btn-primary">view</button>`;
        $('#example').dataTable().fnAddData([
            day,
            date,
            buttonTemplate
        ]);
        $(`#${date}`).click(function () {
                sessionStorage.setItem("date", date);
                location.replace("report.html");
            }

        );

    }



}

function getDayName(dateStr) {
    var date = new Date(dateStr);
    return date.getDay();
}

function getDays() {
    let data = [];

    let parkName = sessionStorage.getItem("report_park_name");
    const dbRef = ref(getDatabase());
    get(child(dbRef, `days/`)).then((snapshot) => {
        if (snapshot.exists()) {
            const days = snapshot.val();


            for (var p in days) {
                const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];


                for (var k in days[p]) {


                    if (k === parkName) {
                        let dayOfWeek = getDayName(p);
                        dayOfWeek = weekday[dayOfWeek];
                        let day = {
                            "date": `${p}`,
                            "day": `${dayOfWeek}`,
                            "status": `${days[p][k].status}`
                        }
                        data.push(day)

                    }

                }
            }

            setTable(data);
        } else {

        }
    }).catch((error) => {
        console.error(error);
    });
    /*data.push(a)
    setTable(data);*/
}
getDays();