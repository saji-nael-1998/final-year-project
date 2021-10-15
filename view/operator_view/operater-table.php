<?php
include('../page-content/header.php');
?>



<div class="container-fluid ">
    <div class="row d-flex justify-content-center">

        <div id="operator-registration" class="col-lg-6">
            <div>
                <div id="registration-header">
                    <img height="100" src="../../img/logo.png" alt="">
                    <h3>Operator <Table></Table>
                    </h3>
                </div>
                <table id="table" class="table table-sm">
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

                    </tbody>
                </table>


            </div>
        </div>

    </div>
</div>
</main>




<script>
    $(function() {

        $.ajax({
            method: "GET",
            url: "../../controller/OperatorController.php?getOperator=1",
        }).done(function(data) {
            var result = JSON.parse(data);
            console.log(result[0].operatorID);
            for (var counter = 0; counter < result.length; counter++) {
                var details="";
                details+="<td>"+(counter+1)+"</td>";
                details+="<td>"+result[counter].FName+"</td>";
                details+="<td>"+result[counter].LName+"</td>";
                details+="<td>"+result[counter].birthDate+"</td>";
                details+="<td>"+result[counter].ID+"</td>";
                details+="<td>"+result[counter].phoneNO+"</td>";
                details+="<td>"+'<button type="button" class="btn btn-primary">View</button>'+"</td>";
                $("tbody").append("<tr></tr>").append(details);

            }
          
        });

    });
</script>


</body>


</html>