let formLog = document.getElementById("signForm");
let email = document.getElementById("loginName");
let pass = document.getElementById("loginPassword");
let err = document.getElementById("err");

formLog.addEventListener("submit", (e) => {
  e.preventDefault();

  fetch("http://localhost/register-system/includes/login.inc.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `email="${email.value.trim()}"&pass="${pass.value.trim()}"`,
  })
    .then((response) => response.text())

    .then((res) => {
      if (res == "home.html") {
        location.href = `http://localhost/register-system/${res}`;
      } else {
        taken.innerHTML = res;
      }
    });
});
