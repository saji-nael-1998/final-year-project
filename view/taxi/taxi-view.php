<?php

include('../page-content/header.php'); ?>
<div id="layoutSidenav_content">
    <main class="container-fluid col-lg-12 ">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div id="form-container" class="col-lg-6">
                    <div>
                        <div id="registration-header">
                            <img src="../../img/logo.png" alt="">
                            <h3>Taxi Info</h3>
                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Taxi Id:</td>
                                <td id="taxi_id"></td>
                            </tr>
                            <tr>
                                <td>Model:</td>
                                <td id="model"></td>
                            </tr>
                            <tr>
                                <td>Year:</td>
                                <td id="year"></td>
                            </tr>
                            <tr>
                                <td>Capacity:</td>
                                <td id="capacity"></td>
                            </tr>
                            <tr>
                                <td>licence end date:</td>
                                <td id="end_date"></td>
                            </tr>
                            <tr>
                                <td>licence photo:</td>
                                <td><img id="licence_photo" src="" alt="no Image"/></td>
                            </tr>
                            <tr>
                                <td id="edit-button"></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
    </main>
</div>
</div>
</body>
<script src="../../js/taxi/taxiTable.js"></script>
<script>
    $(function () {
        let searchParams = new URLSearchParams(window.location.search)
        if (searchParams.has('id')) {
            let id = searchParams.get('id');
            $.ajax({
                url: '../../controller/TaxiController.php',
                contentType: false,
                type: 'get',
                data: {id: id},
                dataType: 'json',
                success: function (data) {
                    if (data.status == 'success') {
                        $("#taxi_id").html(data.taxi_id);
                        $("#model").html(data.model);
                        $("#year").html(data.year);
                        $("#capacity").html(data.capacity);
                        $("#end_date").html(data.end_date);
                        $("#edit-button").html('<button type="button" class="btn btn-primary" onclick="editTaxi(\'' + data.taxi_id + '\')" >Edit</button>');
                        $("#licence_photo").attr("src", "../" + data.image_path);
                    } else {
                        window.location = window.location.href.replace(window.location.search, '')
                    }
                },
                error: function (jqXhr, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });
</script>

</html>
