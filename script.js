function validation() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  var emailError = document.getElementById("emailError").value;
  var passwordError = document.getElementById("passwordError").value;

  var emailReg = document.getElementById("emailError").value;
  var passwordReg = document.getElementById("passwordError").value;

  var isValid = true;

  var emailReg = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  var passReg =
    /^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@.#$!%?&])[A-Za-z\d@.#$!%?&]{8,15}$/;

  if (emailReg.test(email)) {
    // console.log("Valid Email");
    emailError.style.display = none;
  } else if (!emailReg.test(email)) {
    // console.log("Invalid email");
    emailError.style.display = "block";
    isValid = false;
  }

  if (passReg.test(passwod)) {
    // console.log("Valid Password");
    passwordError.style.display = none;
  } else if (!passwordReg.test(password)) {
    // console.log("Invalid Password");
    passwordError.style.display = "block";
    isValid = false;
  }

  return isValid;
}
