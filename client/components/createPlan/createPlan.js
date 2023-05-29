window.onload = () => {
  displayCheckboxes();

  document.getElementById('upload-json-form').addEventListener('submit', (event) => {
    event.preventDefault();

    const file = document.getElementById('file-input').files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = (event) => {
        // TODO: validate json fields
        const jsonData = event.target.result;
        fetch(
          SERVER_CONTROLLERS + 'create_plan.php',
          {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: jsonData
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
      };

      reader.readAsText(file);
    }

  })

  document.getElementById('plan-form').addEventListener('submit', (event) => {
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
    const targetMajors =
      Array.from(document.querySelectorAll('input[name="majors"]:checked'))
        .map(checkbox => checkbox.value);

    const formData = {
      type, name, department, owner, busyness, credits, description,
      requiredSkills, aquiredSkills, contents, examSynopsis, bibliography,
      targetMajors
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

function displayCheckboxes() {
  const checkboxContainer = document.getElementById('target-majors');

  for (const key in FMI_MAJORS) {
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.name = 'majors';
    checkbox.value = key;

    const label = document.createElement('label');
    label.textContent = FMI_MAJORS[key];
    label.appendChild(checkbox);

    checkboxContainer.appendChild(label);
  }
}

