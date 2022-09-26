// // Validate the username field

// vars
let form = document.getElementById("regForm");
let regEmail = document.getElementById("registerEmail");
let pass1 = document.getElementById("registerPassword");
let pass2 = document.getElementById("registerRepeatPassword");
let firstName = document.getElementById("firstName");
let secondName = document.getElementById("secondName");
let thirdName = document.getElementById("thirdName");
let lastName = document.getElementById("lastName");
let telNum = document.getElementById("telNum");
let dobReg = document.getElementById("dobReg");
let test = document.getElementById("test");
let taken = document.getElementById("taken");
let logoutBtn = document.getElementById("logoutBtn");
// verification functions

// function to check if field empty
const isRequired = (value) => (value === "" ? false : true);

// function to verify email
const isEmailValid = (email) => {
  const re =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
};
// function to verify password
const isPasswordSecure = (password) => {
  const re = new RegExp(
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
  );

  return re.test(password);
};
// function to check if age is above 16
const isOfAge = (dob) => {
  let currentDate = new Date();
  let currentYear = currentDate.getFullYear();
  let dobDate = new Date(dob);
  let bdYear = dobDate.getFullYear();

  let age = currentYear - bdYear;

  return age > 16;
};

// function to verify if name is text
const isText = (inputName) => {
  const re = new RegExp("^[A-Za-z]*");
  return re.test(inputName);
};
// function to verify phone number
const isNum = (inputName) => {
  const re = new RegExp("\\d{14}");
  return re.test(inputName);
};

// function to show error
const showError = (input, message) => {
  // get the form-field element
  const formField = input.parentElement;
  // add the error class
  formField.classList.remove("success");
  formField.classList.toggle("error");

  // show the error message
  const error = formField.querySelector("small");
  error.textContent = message;
};

// function to show success
const showSuccess = (input) => {
  // get the form-field element
  const formField = input.parentElement;

  // remove the error class
  formField.classList.remove("error");
  formField.classList.toggle("success");

  // hide the error message
  const error = formField.querySelector("small");
  error.textContent = "";
};

// function to check if name is text
const checkName = (nameInput) => {
  let valid = false;
  const usernameval = nameInput.value.trim();

  if (!isRequired(usernameval)) {
    showError(nameInput, "Name cannot be blank.");
  } else if (!isText(usernameval)) {
    showError(nameInput, `Name must be only text.`);
  } else {
    showSuccess(nameInput);
    valid = true;
  }
  return valid;
};
// function to validate phone
const checkPhone = () => {
  let valid = false;
  const phoneTrimmed = telNum.value.trim();
  if (!isRequired(phoneTrimmed)) {
    showError(telNum, "Phone cannot be blank.");
  } else if (!isNum(phoneTrimmed)) {
    showError(telNum, "Phone must be only numbers and 14 digits.");
  } else {
    showSuccess(telNum);
    valid = true;
  }
  return valid;
};

// function to check date
const checkDob = () => {
  let valid = false;
  const dobVal = dobReg.value;
  if (!isRequired(dobVal)) {
    showError(dobReg, "Date of birth cannot be blank.");
  } else if (!isOfAge(dobVal)) {
    showError(dobReg, "You should be over the age of 16.");
  } else {
    showSuccess(dobReg);
    valid = true;
  }
  return valid;
};

// function to validate email
const checkEmail = () => {
  let valid = false;
  const emailTrimmed = registerEmail.value.trim();
  if (!isRequired(emailTrimmed)) {
    showError(registerEmail, "Email cannot be blank.");
  } else if (!isEmailValid(emailTrimmed)) {
    showError(registerEmail, "Email is not valid.");
  } else {
    showSuccess(registerEmail);
    valid = true;
  }
  return valid;
};

// function to validate password
const checkPassword = () => {
  let valid = false;

  const passwordTrimmed = registerPassword.value.trim();

  if (!isRequired(passwordTrimmed)) {
    showError(registerPassword, "Password cannot be blank.");
  } else if (!isPasswordSecure(passwordTrimmed)) {
    showError(
      registerPassword,
      "Password must has at least 8 characters that include at least 1 lowercase character, 1 uppercase characters, 1 number, and 1 special character in (!@#$%^&*)"
    );
  } else {
    showSuccess(registerPassword);
    valid = true;
  }

  return valid;
};

// function to confirm password
const checkConfirmPassword = () => {
  let valid = false;
  // check confirm password
  const confirmPassword = registerRepeatPassword.value.trim();
  const passwordTrimmed = registerPassword.value.trim();

  if (!isRequired(confirmPassword)) {
    showError(registerRepeatPassword, "Please enter the password again");
  } else if (passwordTrimmed !== confirmPassword) {
    showError(registerRepeatPassword, "Confirm password does not match");
  } else {
    showSuccess(registerRepeatPassword);
    valid = true;
  }

  return valid;
};

form.addEventListener("submit", (e) => {
  //   let fullname =
  //     firstName.value.trim() +
  //     " " +
  //     secondName.value.trim() +
  //     " " +
  //     thirdName.value.trim() +
  //     " " +
  //     lastName.value.trim();
  e.preventDefault();
  //   console.log(firstName);
  //   return;

  if (
    checkName(firstName) &&
    checkName(secondName) &&
    checkName(thirdName) &&
    checkName(lastName) &&
    checkEmail() &&
    checkPhone() &&
    checkDob() &&
    checkPassword() &&
    checkConfirmPassword()
  ) {
    // console.log(fullname);
    const data = new URLSearchParams();
    for (const p of new FormData(form)) {
      data.append(p[0], p[1].trim());
    }
    // emailOut logoutBtn
    fetch("http://localhost/register-system/includes/signup.inc.php", {
      method: "POST",
      //   headers: {
      //     "Content-Type": "application/JSON",
      //     "Access-Control-Allow-Origin": "*",
      //   },
      body: data,
      //   body: `email=${regEmail.value.trim()}&tel=${telNum.value.trim()}&pass=${pass1.value.trim()}&dob=${dobReg.value.trim()}&fullname=${fullname}`,
    })
      .then((response) => response.json())
      //   the res is the piece of info that is spitted out of the php file "echo it"
      //   .then((res) => console.log(res));
      .then((res) => {
        if (res == "The email already exist") {
          taken.innerHTML = res;
        } else {
          location.href = `http://localhost/register-system/${res}`;

          localStorage.setItem("email", regEmail.value.trim());
        }
      });
    //   .then((res) => (taken.innerHTML = res));
  }
});
