window.onload = () => {
  const form = document.getElementById('plan-form');

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    const type = document.querySelector('input[name="type"]:checked').value;
    const name = document.getElementById('name').value;
    const department = document.getElementById('department').value;
    // TODO: owner = logged in user's username
    const owner = document.getElementById('owner').value;
    const busyness = document.getElementById('busyness').value;
    const credits = document.getElementById('credits').value;
    const description = document.getElementById('description').value;
    const requiredSkills = document.getElementById('requiredSkills').value;
    const aquiredSkills = document.getElementById('aquiredSkills').value;
    const contents = document.getElementById('contents').value;
    const examSynopsis = document.getElementById('examSynopsis').value;
    const bibliography = document.getElementById('bibliography').value;

    const formData = {
      type, name, department, owner, busyness, credits, description,
      requiredSkills, aquiredSkills, contents, examSynopsis, bibliography
    };

    fetch(
      SERVER_CONTROLLERS + 'create_plan.php',
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      })
      .then(response => {
        if (response.ok) {
          window.location.assign(CLIENT_COMPONENTS + 'listPlans/listPlans.html');
        } else {
          console.error("Failed to create plan");
        }
      })
      .catch(error => {
        console.error('Error:', error);
        console.error("Failed to create plan");
      });
  });
};

