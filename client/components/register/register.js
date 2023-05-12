// TODO: put the url prefix in some central place (like a file with constants)
const register_url = 'http://localhost/myapp/server/controller/user_register.php';

window.onload = () => {
  const registerForm = document.getElementById('register-form');

  registerForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const username = registerForm[0].value;
    const password = registerForm[1].value;

    fetch(
      register_url,
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
