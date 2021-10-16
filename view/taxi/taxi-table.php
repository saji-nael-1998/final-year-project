<?php
include('../page-content/header.php');
?>
<div class="container-fluid ">
    <div class="row d-flex justify-content-center">

        <div id="operator-registration" class="col-lg-6">
            <div>
                <div id="registration-header">
                    <img height="100" src="../../img/logo.png" alt="">
                    <h3>Taxi
                        <Table></Table>
                        <button type="button" class="btn btn-primary" onclick="viewTaxi(0)">Add Taxi</button>
                    </h3>
                </div>
                <table id="table" class="table table-sm">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Taxi id</th>
                        <th scope="col">Model</th>
                        <th scope="col">Year</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">End date</th>
                        <th scope="col">Option</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


            </div>
        </div>

    </div>
</div>
</main>

<script>
    $(function () {
        $.ajax({
            method: "GET",
            url: "../../controller/TaxiController.php",
        }).done(function (data) {
            var result = JSON.parse(data);
            for (var counter = 0; counter < result.length; counter++) {
                var details = "";
                details += "<td>" + (counter + 1) + "</td>";
                details += "<td>" + result[counter].taxi_id + "</td>";
                details += "<td>" + result[counter].model + "</td>";
                details += "<td>" + result[counter].year + "</td>";
                details += "<td>" + result[counter].capacity + "</td>";
                details += "<td>" + result[counter].end_date + "</td>";
                details += "<td>" + '<button type="button" class="btn btn-primary" onclick="viewTaxi(' + result[counter].taxi_id + ')" >View</button>'
                    + '<button type="button" class="btn btn-warning" onclick="deleteTaxi(' + result[counter].taxi_id + ')" >Delete</button>' + "</td>";
                $("tbody").append("<tr></tr>").append(details);
            }
        });
    });

    function viewTaxi(id){
        window.location = 'taxi-form.php?id=' + id;
    }
    function deleteTaxi(id) {
        $.ajax({
            url: '../../controller/TaxiController.php',
            type: 'get',
            data: {taxi_id: id, action: 'delete'},
            contentType: false,
            dataType: 'json',
            // dataType: 'json',
            success: function (data) {
                window.location = window.location;
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }


</script>




</body>


</html>