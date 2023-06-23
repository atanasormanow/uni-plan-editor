window.onload = () => {
  displayCheckboxes();
  const planId = getPlanIdFromURL();

  // NOTO: idk if this is supposed to be here or in the "fetch"
  document
    .getElementById('plan-form')
    .addEventListener('submit', handleSubmit);

  Promise.all([
    fetch(
      SERVER_CONTROLLERS + 'get_plan.php?'
      + new URLSearchParams({ id: planId })
    ),
    fetch(SERVER_CONTROLLERS + 'get_all_plans.php')
  ])
    .then(responses => Promise.all(responses.map(r => r.json())))
    .then(data => {
      const editedPlan = data[0].data;
      const allPlans = JSON.parse(data[1].data);

      fillForm(editedPlan, allPlans);
    })
    .catch(error => console.error(error));
};

function handleSubmit(event) {
  event.preventDefault();

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

  // TODO: dependencies should be ids
  const selectedDeps = document.getElementById('dependencies').selectedOptions;
  const dependencies = Array.from(selectedDeps).map(option => option.value);

  const formData = {
    type, name, department, owner, busyness, credits, description,
    requiredSkills, dependencies, aquiredSkills, contents, examSynopsis,
    bibliography, targetMajors
  };

  sendEditPlanRequest(formData);
}

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

function fillForm(editedPlan, allPlans) {
  const form = document.getElementById('plan-form');

  form.type.value = editedPlan.type;
  form.name.value = editedPlan.name;
  form.department.value = editedPlan.department;
  form.busyness.value = editedPlan.busyness;
  form.credits.value = editedPlan.credits;
  form.description.value = editedPlan.description;
  form.requiredSkills.value = editedPlan.requiredSkills;
  form.aquiredSkills.value = editedPlan.aquiredSkills;
  form.contents.value = editedPlan.contents;
  form.examSynopsis.value = editedPlan.examSynopsis;
  form.bibliography.value = editedPlan.bibliography;

  fillSelect(editedPlan, allPlans);

  const targetMajors = editedPlan.targetMajors.split(',');
  const majorsCheckboxes = document.getElementById('target-majors');
  const checkboxInputs = majorsCheckboxes.querySelectorAll('input');
  for (let i = 0; i < checkboxInputs.length; i++) {
    if (targetMajors.includes(checkboxInputs[i].value)) {
      checkboxInputs[i].checked = true;
    }
  }

  if (editedPlan.type === "z") {
    document.getElementById("mandatory").checked = true;
  } else if (editedPlan.type === "i") {
    document.getElementById("optional").checked = true;
  }
}

function fillSelect(editedPlan, plans) {
  const dependencies = document.getElementById('dependencies');

  plans.forEach(plan => {
    if (editedPlan.planId !== plan.id) {
      const option = document.createElement('option');

      const majors =
        !plan.target_majors
          ? ''
          : ' (' + plan.target_majors.split(',').map(m => FMI_MAJORS_SHORT[m]).join(',') + ')';
      option.textContent = plan.name + majors;

      option.value = plan.id;
      option.selected = editedPlan.dependencies.includes(plan.id);

      dependencies.appendChild(option);
    }
  });
}

function sendEditPlanRequest(formData) {
  const planId = getPlanIdFromURL();

  fetch(
    SERVER_CONTROLLERS + 'edit_plan.php?'
    + new URLSearchParams({ id: planId }),
    {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData)
    })
    .then(response => {
      if (response.ok) {
        window.location.assign(CLIENT_COMPONENTS + 'listPlans/listPlans.html');
      } else {
        console.error("Failed to edit plan");
      }
    })
    .catch(error => {
      console.error('Error:', error);
      console.error("Failed to edit plan");
    });
}

function getPlanIdFromURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('id');
}
