<?php
include('../page-content/header.php') ?>

<div id="content">
    <div class="container-fluid">
        <div class="row">
            <!--form section-->
            <div class="col-lg-4">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Park Name</label>
                        <input type="text" class="form-control" name="park_name" id="park_name" placeholder="Park Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Park Location</label>
                        <input type="text" class="form-control" name="park_location" id="park_location" placeholder="Park Location">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <!--operator section -->
        </div>
        <div class="row mt-4">
             <div class="col-lg-6 mt-4">
                <div class="table-responsive-lg px-2">
                    <table id="operator-table" class="table-striped table-dark" style="width:100%;">
                        <thead>
                            <tr>
                                <th>FName</th>
                                <th>LName</th>
                                <th>Email</th>
                                <th>ID</th>
                                <th>Option</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <div class="col-lg-6 mt-4">
                <div class="table-responsive-lg px-2">
                    <table id="route-table" class="table-striped table-dark" style="width:100%">
                        <thead>
                            <tr>
                            <th>Source</th>
                                <th>Distention</th>
                                <th>Option</th>
                    
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="../../js/park/getOperator.js"></script>
<script src="../../js/park/getRoutes.js"></script>
</body>

</html>