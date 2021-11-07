$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {

        $('#sidebar').toggleClass('active');
        var classList = document.getElementById('sidebar').className.split(/\s+/);
        if (classList.includes('active')) {
            console.log(1);
            $("#main").removeClass("col-lg-10 ");
            $("#main").removeClass("col-md-8 ");
            $("#main").addClass("col-lg-12");
            $("#sidebar-container").fadeOut(0);
        } else {
            console.log(2);
            $("#main").removeClass("col-lg-12");
            $("#main").addClass("col-lg-10");
            $("#main").addClass("col-md-8 ");
            $("#sidebar-container").fadeIn(0);
        }
     

    });
    $('#closeSideBar').on('click', function () {
       
        $('#sidebar').toggleClass('active');
        var classList = document.getElementById('sidebar').className.split(/\s+/);
        if (classList.includes('active')) {
            console.log(1);
            $("#main").removeClass("col-lg-10 ");
            $("#main").removeClass("col-md-8 ");
            $("#main").addClass("col-lg-12");
            $("#sidebar-container").fadeOut(0);
        } else {
            console.log(2);
            $("#main").removeClass("col-lg-12");
            $("#main").addClass("col-lg-10");
            $("#main").addClass("col-md-8 ");
            $("#sidebar-container").fadeIn(0);
        }
     


    });
});