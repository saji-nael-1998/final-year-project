<?php
include('../page-content/header.php') ?>

<div id="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">

            <div id="form-container" class="col-lg-6">

                <div id="registration-header">
                    
                    <img id="operator_img"  alt="">
                  
                    <div id="msg" class="alert alert-danger alert-dismissible fade ">
                        <strong>Alert!</strong> <span></span>
                    </div>
                </div>
                <form id="profile-from" action="">
                    <div class="container-fluid">
                        <div class="row">
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
                                    <input  type="date" class="form-control" id="birthdate" min="1960-01-01" max="1999-12-31" name="birthdate" aria-describedby="emailHelp">

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
                                <input type="submit" value="update">
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
<script src="../../js/operator/getOperatorData.js"></script>
<script src="../../js/operator/updateOperator.js"></script>
</body>

</html>