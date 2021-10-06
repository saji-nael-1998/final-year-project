// adapted from https://www.codeply.com/go/mhkMGnGgZo/bootstrap-4-validation-example
function handleFormSubmit(event) {
    event.preventDefault();

}
$('#bootstrapForm').submit(function (event) {
    event.preventDefault()
    // make selected form variable
    var vForm = $(this);
    /*
    If not valid prevent form submit
    https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/checkValidity
    */
    if (vForm[0].checkValidity() === false) {
        event.stopPropagation()
    } else {
            //create json
            const data = new FormData(event.target);

            const formJSON = Object.fromEntries(data.entries());

            const results  = JSON.stringify(formJSON, null, 2);
            console.log(results);
            $.ajax({
                url: '../../',
                dataType: 'json',
                type: 'post',
                contentType: 'application/json',
                data: results,
                processData: false,
                success: function( data, textStatus, jQxhr ){
                   alert(data);
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });

    }
    // Add bootstrap 4 was-validated classes to trigger validation messages
    vForm.addClass('was-validated');
});

