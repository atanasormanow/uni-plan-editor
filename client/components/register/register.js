// TODO put somewhere else and import
const server_url = 'localhost/myapp/server/api.php';

window.onload = () => {
  const registerForm = document.getElementById('register-form');

  registerForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const username = registerForm[0].value;
    const password = registerForm[1].value;

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
