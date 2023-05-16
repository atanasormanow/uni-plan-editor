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
      .then(data => {
        console.log(data);
        if (data.status == 'SUCCESS') {
          window.location.assign(CLIENT_COMPONENTS + 'listPlans/listPlans.html');
        } else {
          console.error("Failed to create plan");
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });
}
