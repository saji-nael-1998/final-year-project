
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  let email = getCookie("email");
  let password = getCookie("password");
  if (email != "") {
    $('#inputEmail').val(email);
    $('#inputPassword').val(password);
  }
}
function isLogged() {
  let isLogged = getCookie("isLogged");
  if (isLogged != "") {
    sessionStorage.setItem("email", getCookie("email"));
    location.replace('index.html');

  }

}

checkCookie();
isLogged();
function saveUser(email) {
  // Store
  sessionStorage.setItem("email", email);
  sessionStorage.setItem("isLogged", true);
}
function saveUserOnBrowser(email, password) {
  document.cookie = "email=" + email + ";";
  document.cookie = "password=" + password + ";";
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
          if ($("#inputRememberPassword").prop("checked")) {
            setCookie("email", email, 365);
            setCookie("password", $('#inputPassword').val(), 365);
          }
          setCookie("isLogged", true, 365);
          location.replace('index.html');
        } else {
          alert('worng email/password');
        }
      }
    }
  );
});


