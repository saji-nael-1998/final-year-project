<?php

include('../page-content/header.php'); ?>
<div id="layoutSidenav_content">
    <!--Main Section-->
    <!--Registration Form -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="container px-5 my-5">
                        <div class="card bg-light">
                            <div class="card-header">
                                <h3>Add Taxi</h3>
                                <h5>Please fill the fields with correct data.</h5>
                            </div>
                            <!-- from here -->
                            <form class="card-body" novalidate="" action="" method="" id="taxiForm">
                                <div>
                                    <div class="feild-box">
                                        <div class="form-group">
                                            <label class="h6 form-control-label" for="taxi_id">Taxi ID<abbr
                                                        class="text-danger"
                                                        title="This is required">*</abbr></label>
                                            <input type="text" class="form-control" name="taxi_id" id="taxi_id"
                                                   pattern="[a-zA-Z0-9'-'\s]*" required>
                                            <div class="valid-feedback">looks goods</div>
                                            <div class="invalid-feedback">Please enter Taxi id. This
                                                field
                                                is required
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="h6 form-control-label" for="model">Model<abbr
                                                        class="text-danger"
                                                        title="This is required">*</abbr></label>
                                            <input type="text" class="form-control" name="model" id="model"
                                                   pattern="[a-zA-Z'-'\s]*" required>
                                            <div class="valid-feedback">looks goods</div>
                                            <div class="invalid-feedback">Please enter Taxi model. This
                                                field
                                                is required
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="h6 form-control-label" for="year">Taxi year</label>
                                            <input type="number" class="form-control" name="year" id="year"
                                                   pattern="[0-9]{4}" required>
                                            <div class="valid-feedback">looks goods</div>
                                            <div class="invalid-feedback">Please enter taxi year. This
                                                field
                                                is required
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="h6 form-control-label" for="capacity">Capacity</label>
                                            <input type="number" class="form-control" name="capacity" id="capacity"
                                                   pattern="[0-9]{2}" required>
                                            <div class="valid-feedback">looks goods</div>
                                            <div class="invalid-feedback">Please enter Capacity. This
                                                field
                                                is required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feild-box">
                                        <!--                                        <div class="form-group">-->
                                        <!--                                            <label class="h6 form-control-label" for="driver_name">Driver name<abbr-->
                                        <!--                                                        class="text-danger"-->
                                        <!--                                                        title="This is required">*</abbr></label>-->
                                        <!--                                            <input type="text" class="form-control" name="driver_name"-->
                                        <!--                                                   id="driver_name"-->
                                        <!--                                                   pattern="[a-zA-Z'-'\s]*" required>-->
                                        <!--                                            <div class="valid-feedback">looks good</div>-->
                                        <!--                                            <div class="invalid-feedback">Please enter driver name. This-->
                                        <!--                                                field-->
                                        <!--                                                is required-->
                                        <!--                                            </div>-->
                                        <!--                                        </div>-->
                                        <div class="form-group">
                                            <label class="h6 form-control-label" for="end_date">License end
                                                date<abbr
                                                        class="text-danger"
                                                        title="This is required">*</abbr></label>
                                            <input type="date" class="form-control" name="end_date"
                                                   id="end_date"
                                                   required>
                                            <div class="valid-feedback">looks good</div>
                                            <div class="invalid-feedback">Please enter end date. This
                                                field
                                                is required
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="feild-box">
                                    <div class="form-group">
                                        <label class="h6 form-control-label" for="license_photo">license
                                            photo<abbr
                                                    class="text-danger"
                                                    title="This is required">*</abbr></label>
                                        <input type="file" class="form-control" name="license_photo"
                                               id="license_photo"
                                               pattern="[a-zA-Z'-'\s]*" required>
                                        <div class="valid-feedback">looks good</div>
                                        <div class="invalid-feedback">Please upload a photo of the license. This
                                            field
                                            is required
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="feild-box">
                                        <div>
                                            <button type="submit" class="btn btn-secondary">Send Form
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            `
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
    </main>

</div>
</div>
</body>
<script src="../../css/framework/bootstrap.min.js" crossorigin="anonymous"/>
<script src="../../js/addTaxi.js"></script>
<script src="../../css/framework/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

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
                error: function (jqXhr, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });
    $('#taxiForm').submit(function (event) {
        event.preventDefault()
        var vForm = $(this);
        if (vForm[0].checkValidity() === false) {
            event.stopPropagation()
        } else {
            const data = new FormData(event.target);
            let searchParams = new URLSearchParams(window.location.search)
            if (searchParams.has('id')) {
                let id = searchParams.get('id');
                data.append('taxi_id', id)
                data.append('action', 'update')
            } else {
                data.append('action', 'add')
            }
            $.ajax({
                url: '../../controller/TaxiController.php',
                contentType: false,
                type: 'post',
                dataType: 'json',
                data: data,
                processData: false,
                success: function (data) {
                    alert(data.message);
                },
                error: function (jqXhr, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
        vForm.addClass('was-validated');
    });
</script>
</html>
