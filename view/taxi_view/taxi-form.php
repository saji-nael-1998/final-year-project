<?php

include('../page-content/header.php'); ?>
<div id="content">

    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div id="form-container" class="col-lg-6">
                <div>
                    <div id="registration-header">
                        <img src="../../img/logo.png" alt="">
                        <h3>Taxi Registration</h3>
                    </div>
                    <form id="registration" action="">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="taxi_id">Taxi Id *</label>
                                        <input type="text" class="form-control" id="plate_no" name="plate_no">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="model">Model *</label>
                                        <input type="text" class="form-control" id="brand" name="brand">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="year">Year*</label>
                                        <input type="number" class="form-control" id="car_year" name="car_year">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="capacity">Capacity *</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="license_photo">Licence</label>
                                        <input type="file" class="form-control" id="license_photo" name="license_photo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="end_date">Licence end date *</label>
                                        <input type="date" class="form-control" id="reqistration_date" name="reqistration_date" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="../../js/taxi/addTaxi.js"></script>
<script>
    $(function() {
        let searchParams = new URLSearchParams(window.location.search)
        if (searchParams.has('id')) {
            let id = searchParams.get('id');
            $.ajax({
                url: '../../controller/TaxiController.php',
                contentType: false,
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $("input[name='taxi_id']").val(data.taxi_id);
                        $("input[name='taxi_id']").prop('disabled', true);
                        $("input[name='model']").val(data.model);
                        $("input[name='year']").val(data.year);
                        $("input[name='capacity']").val(data.capacity);
                        $("input[name='end_date']").val(data.end_date);
                        $("input[name='license_photo']").removeAttr('required');
                        
                    } else {
                        window.location = window.location.href.replace(window.location.search, '')
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });
</script>

</html>