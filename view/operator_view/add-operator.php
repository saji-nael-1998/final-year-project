<?php
include('../page-content/header.php');
$parts = explode("\\", __DIR__);
$path = "";
foreach ($parts as $part) {
    $path .= $part . "\\";
    if ($part == "final_year_project") {
        break;
    }
}
str_replace("\\", "/", $path);
include($path . "model/park.php");

?>

<div id="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">

            <div id="form-container" class="col-lg-6">

                <div id="registration-header">
                    <img src="../../img/logo.png" alt="">
                    <h3>Operator Registration </h3>
                    <div id="msg" class="alert alert-danger alert-dismissible fade ">
                        <strong>Alert!</strong> <span></span>
                    </div>
                </div>
                <form id="registration" action="">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <label>Park *</label>
                                <div class="w-100">
                                    <select name="park_id" id="park_id" class="form-select col" size="3" aria-label="size 3 select example">
                                        <?php

                                        $park = new Park();
                                        $arr = json_decode($park->getAllRecord(), true);
                                        $size = count($arr['data']);

                                        for ($counter = 0; $counter < $size; $counter++) {
                                            $park_id = $arr['data'][$counter]['park_id'];
                                            echo "<option value='$park_id'>" . $arr['data'][$counter]['park_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>First Name *</label>
                                    <input type="text" class="form-control" id="FName" name="FName" aria-describedby="emailHelp">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Mid Name</label>
                                    <input type="text" class="form-control" id="MName" name="MName" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Last Name *</label>
                                    <input type="text" class="form-control" id="LName" name="LName" aria-describedby="emailHelp">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>ID *</label>
                                    <input type="text" class="form-control" id="ID" name="ID" aria-describedby="emailHelp">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Birthdate*</label>
                                    <input type="date" class="form-control" id="birthDate" min="1960-01-01" max="1999-12-31" name="birthDate" aria-describedby="emailHelp">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Profile Picture *</label>
                                    <input type="file" class="form-control" id="imagePath" name="imagePath" aria-describedby="emailHelp">

                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone*</label>
                                    <input type="text" class="form-control" id="phoneNO" name="phoneNO" aria-describedby="emailHelp">

                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="text" class="form-control" id="pass" name="pass" aria-describedby="emailHelp">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Confirm Password*</label>
                                    <input type="text" class="form-control" id="CPass" name="CPass" aria-describedby="emailHelp">

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
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="../../js/operator/addOperator.js"></script>
</body>

</html>