function viewTaxi(id) {
    window.location = 'taxi-view.php?id=' + id;
}
function editTaxi(id) {
    window.location = 'taxi-form.php?id=' + id;
}

function deleteTaxi(id) {
    $.ajax({
        url: '../../controller/TaxiController.php',
        type: 'GET',
        data: {taxi_id: id, action: 'delete'},
        contentType: false,
        dataType: 'json',
        success: function (data) {
            window.location = '';
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}