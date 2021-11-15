<?php

include('../page-content/header.php'); ?>
<div class="container-fluid ">
    <div id="content">
        <div class="table-responsive-lg px-2">
            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">Taxi id</th>
                    <th scope="col">Model</th>
                    <th scope="col">Year</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">registration date</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
</main>
<script src="../../js/taxi/taxiTable.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            ajax: {
                url: '../../controller/TaxiController.php',
                dataSrc: 'data'
            },
            columns: [{
                "data": "taxi_id"
            }, {
                "data": "brand"
            }, {
                "data": "car_year"
            }, {
                "data": "capacity"
            }, {
                "data": "reqistration_date"
            },
                {
                    render: function (data, type, row) {
                        var btn = '';
                        btn += "<button class='btn btn-info'><a href='taxi-view.php?id=" + row.taxi_id + "'>view</a> </button>";
                        btn += '<button type="button" class="btn btn-warning" onclick="deleteTaxi(\'' + row.taxi_id + '\')" >Delete</button>';
                        return btn;
                    }
                }
            ]
        });
    });
</script>
</body>
</html>