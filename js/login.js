$('#login-form').submit(function (event) {
  event.preventDefault();
  //fetch values from the form fields
  email = $('#inputEmail').val();
  password = $('#inputPassword').val();
  //prepare data for get request
  let data = "email=" + email + "&" + "password=" + password;
  //create ajax request 
  $.ajax(
    {
      type: 'GET',
      url: '../controller/Login.php',
      data: data,
      success: function (data) {
        alert(data);
      }
    }
  );
});