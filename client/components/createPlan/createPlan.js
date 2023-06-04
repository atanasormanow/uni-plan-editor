let dependencies = {};

window.onload = () => {
  displayCheckboxes();
  handleJSONUpload();
  handlePlanCreation();

  fetch(SERVER_CONTROLLERS + 'get_all_plans.php')
    .then(response => response.json())
    .then(({ data }) => fillSelect(JSON.parse(data)))
    .catch(error => console.error('Error:', error));

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

function handleJSONUpload() {
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
}

function handlePlanCreation() {
  document.getElementById('plan-form').addEventListener('submit', (event) => {
    event.preventDefault();

    // TODO: use a map and a function to fill it
    const owner = localStorage.getItem('username');
    const type = document.querySelector('input[name="type"]:checked').value;
    const name = document.getElementById('name').value;
    const department = document.getElementById('department').value;
    const busyness = document.getElementById('busyness').value;
    const credits = document.getElementById('credits').value;
    const description = document.getElementById('description').value;
    const requiredSkills = document.getElementById('requiredSkills').value;
    const aquiredSkills = document.getElementById('aquiredSkills').value;
    const contents = document.getElementById('contents').value;
    const examSynopsis = document.getElementById('examSynopsis').value;
    const bibliography = document.getElementById('bibliography').value;

    const selectedMajors = document.querySelectorAll('input[name="majors"]:checked')
    const targetMajors = Array.from(selectedMajors).map(checkbox => checkbox.value);

    const selectedDeps = document.getElementById('dependencies').selectedOptions;
    const dependencies = Array.from(selectedDeps).map(option => option.value);

    const formData = {
      type, name, department, owner, busyness, credits, description,
      requiredSkills, dependencies, aquiredSkills, contents, examSynopsis, bibliography,
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
}

function fillSelect(plans) {
  const depSelect = document.getElementById('dependencies');

  plans.forEach(plan => {
    const option = document.createElement('option');
    option.value = plan.id;
    option.textContent = plan.name;

    depSelect.appendChild(option);
  });
}
