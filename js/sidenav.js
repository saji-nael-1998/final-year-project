function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

function close() {
    for (i = 0; i < dropdown.length; i++) {

        dropdown[i].classList.remove("active");
        var dropdownContent = dropdown[i].nextElementSibling;

        dropdownContent.style.display = "none";

    }
}

for (i = 0; i < dropdown.length; i++) {

    dropdown[i].addEventListener("click", function () {
        close();
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}