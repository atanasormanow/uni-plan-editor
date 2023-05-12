// TODO: put the url prefix in some central place (like a file with constants)
const createPlanURL = 'http://localhost/myapp/server/controller/create_plan.php';

window.onload = () => {
  const planForm = document.getElementById('plan-form');

  planForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const title = registerForm[0].value;
    const owner = registerForm[1].value;
    const description = registerForm[2].value;

    fetch(
      createPlanURL,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          title,
          owner,
          description
        })
      })
      .then(response => response.json())
      // TODO: do something on success, maybe redirect to "allPlans"
      // .then(data => {
      //   if (data.success) {
      //     localStorage.setItem('username', username);
      //   } else {
      //     console.error("Failed to register user")
      //     // loginErrorMsg.textContent = data.message;
      //   }
      // })
      .catch(error => {
        console.error('Error:', error);
      });
  });
}
