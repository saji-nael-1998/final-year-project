// adapted from https://www.codeply.com/go/mhkMGnGgZo/bootstrap-4-validation-example
function handleFormSubmit(event) {
    event.preventDefault();

}
function BDateValidation() {
    var val = document.getElementById('birthdate'),
      date = new Date(val.value),
      d1   = date.getTime(),
      d2   = new Date('1/1/1950').getTime(),
      d3   = new Date('1/1/2000').getTime();

   if (d1 > d2 || d1 < d3) {
       return true;
   }else{
       alert("date is not in valid range")
   }
}

function passValidate() {
   
    if (pass != confirmPass) {
        alert("Passwords do not match.");
        return false;
    }
    else
    alert("Passwords are matching.");
    return true;
}

function phonenumber(phone)
{
  var phoneno = /^\d{10}$/;
  if(phone.value.match(phoneno))
  {
      return true;
  }
  else
  {
     alert("Not valid Phone Number");
     return false;
  }
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

