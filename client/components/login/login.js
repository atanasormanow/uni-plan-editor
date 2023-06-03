window.onload = () => {
  const loginForm = document.getElementById('login-form');

  loginForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const username = loginForm[0].value;
    const password = loginForm[1].value;
    const errorMsg = document.getElementById('error-message');

    fetch(SERVER_CONTROLLERS + 'user_login.php',
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          username,
          password
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'SUCCESS') {
          localStorage.setItem('username', username);
          window.location.assign(CLIENT_COMPONENTS + 'listPlans/listPlans.html');
        } else {
          console.error("Failed to login user")
          errorMsg.textContent = data.message;
          errorMsg.style.display = 'block';
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });
}
