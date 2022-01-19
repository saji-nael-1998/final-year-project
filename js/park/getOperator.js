  $(document).ready(function() {
        var park_id = location.search.slice(1).split("&")[0].split("=")[1]
           
        $('#operator-table').DataTable({
            ajax: {
                url: '../../controller/ParkController.php?getOperator=all&park_id=5',
                dataSrc: 'data'
            },

            columns: [{
                    "data": "FName"
                }, {
                    "data": "MName"
                }, {
                    "data": "email"
                }, {
                    "data": "ID"
                },
                {
                    "data": "user_id",

                    render: function(data, type, row) {
                        var btn = '';
                       /* let link = "operator.php?getOperator=" + data;
                        btn += "<button class='btn btn-info'><a href='" + link + "'>view</a> </button>";*/
                        let deleteLink = "../../controller/OperatorController.php?deleteOperator=" + data;
                        btn += "<button class='ml-1 btn btn-danger'><a style='display:block;width:100%;height:100%' href='" + deleteLink + "'>delete</a> </button>";
                        return btn;
                    }
                }
            ]
        });
    });