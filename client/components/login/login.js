// TODO put somewhere else and import
const server_url = 'localhost/myapp/server/api.php';

window.onload = () => {
  const loginForm = document.getElementById('login-form');

  loginForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const username = loginForm[0].value;
    const password = loginForm[1].value;

    fetch(server_url, {
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
        if (data.success) {
          localStorage.setItem('username', username);
        } else {
          loginErrorMsg.textContent = data.message;
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });
}