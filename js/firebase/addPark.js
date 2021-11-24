import {  parkRoute} from "../park/add-park.js";
//add to firebase 
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/9.5.0/firebase-app.js";
import {
    getDatabase,
    ref,
    set
} from "https://www.gstatic.com/firebasejs/9.5.0/firebase-database.js";

function connectToFirebase() {
    // Import the functions you need from the SDKs you need
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
  
}

function wirteParkData() {
    connectToFirebase();
    const db = getDatabase();
    let parkName = $("#park_name").val();
    for (var counter = 0; counter < parkRoute.length; counter++) {
        let route = parkRoute[counter].dest;
        alert(route);
        set(ref(db, 'parks/' + parkName), {
            [route] : ""
        });
    }
}
export {wirteParkData}; 