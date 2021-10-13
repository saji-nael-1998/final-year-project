<?php
include('../page-content/header.php');
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">

                <div id="operator-registration" class="col-lg-6">
                    <div>
                        <div id="registration-header">
                            <img src="../../img/logo.png" alt="">
                            <h3>Operator Registration </h3>
                        </div>
                        <table id="table" class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">BirthData</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>

                       
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php
    include_once('../page-content/footer.php');
    ?>
</div>
</div>


<script src="../../css/framework/bootstrap.min.js" crossorigin="anonymous">
</script>
<script src="../../css/framework/jquery.min.js"></script>
<script src="../../js/operator/getOperator.js"></script>


</body>


</html>