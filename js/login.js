var isLogged =sessionStorage.getItem("isLogged");
if (!isLogged) {
  location.replace("https://www.w3schools.com")
}else{
  function saveUser(email, password) {
    // Store
    sessionStorage.setItem("email", email);
    sessionStorage.setItem("isLogged", true);
  }
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
          if (data === '1') {
            saveUser(email);
          } else {
            alert('sasssji');
          }
        }
      }
    );
  });
}

