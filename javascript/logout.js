let logoutBtn = document.getElementById("logoutBtn");
let emailOut = document.getElementById("emailOut");

logoutBtn.addEventListener("click", (e) => {
  e.preventDefault();
  fetch("http://localhost/register-system/includes/logout.inc.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `logout=1`,
  })
    .then((response) => response.text())

    .then((res) => {
      if (res == "register.html") {
        location.href = `http://localhost/register-system/${res}`;
      }
    });
});
