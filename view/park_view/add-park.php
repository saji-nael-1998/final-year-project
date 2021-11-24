<?php
include('../page-content/header.php') ?>


<div id="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">

            <div id="form-container" class="col-lg-6">

                <div id="registration-header">
                    <img src="../../img/logo.png" alt="">
                    <h3>Park Registration </h3>
                    <div id="msg" class="alert alert-danger alert-dismissible fade hide">
                        <strong>Alert!</strong> <span></span>
                    </div>
                </div>
                <form id="registration" action="">
                    <div class="container-fluid">
                        <div class="row">
                            <h5 style="padding-left: 15px;"><Strong>Park Details :</Strong></h5>
                        </div>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Park Name *</label>
                                    <input type="text" class="form-control" id="park_name" name="park_name">

                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Street *</label>
                                    <input type="text" class="form-control" id="street" name="street">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>City *</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <h5 style="padding-left: 15px;"><Strong>Park Route :</Strong></h5>
                        </div>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Source *</label>
                                    <input type="text" class="form-control" id="src" name="src">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Destination *</label>
                                    <input type="text" class="form-control" id="dest" name="dest">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <button style="margin: 10px 0;" type="button" id="addRoute"  class="btn btn-primary">add</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Source</th>
                                                <th>Destination</th>
                                                <th>Option</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <input type="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>

    </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script>
   
</script>
<script type="module" src="../../js/firebase/addPark.js"></script>
<script type="module" src="../../js/park/add-park.js"></script>
<script>
    
</script>
</body>

</html>