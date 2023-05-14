import { SERVER_CONTROLLERS } from "../../modules/constants";

window.onload = () => {
  const planForm = document.getElementById('plan-form');

  planForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const name = planForm[0].value;
    // TODO: get owner by sending the current user's username, then find the id
    const owner = planForm[1].value;
    const description = planForm[2].value;

    fetch(
      SERVER_CONTROLLERS + 'create_plan.php',
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          name,
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
