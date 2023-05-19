window.onload = () => {
  displayCheckboxes();
  const form = document.getElementById('plan-form');
  fillForm(form);

  const planId = getPlanIdFromURL();

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
    const targetMajors =
      Array.from(document.querySelectorAll('input[name="majors"]:checked'))
        .map(checkbox => checkbox.value);

    const formData = {
      type, name, department, owner, busyness, credits, description,
      requiredSkills, aquiredSkills, contents, examSynopsis, bibliography,
      targetMajors
    };

    fetch(
      SERVER_CONTROLLERS + 'edit_plan.php?' + new URLSearchParams({ id: planId }),
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

function getPlanIdFromURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('id');
}

function fillForm(form) {
  planId = getPlanIdFromURL();

  fetch(
    SERVER_CONTROLLERS + 'get_plan.php?' + new URLSearchParams({ id: planId })
  )
    .then(response => response.json())
    .then(({ data }) => {
      const editedPlan = data;

      form.type.value = editedPlan.type;
      form.name.value = editedPlan.name;
      form.department.value = editedPlan.department;
      form.owner.value = editedPlan.owner;
      form.busyness.value = editedPlan.busyness;
      form.credits.value = editedPlan.credits;
      form.description.value = editedPlan.description;
      form.requiredSkills.value = editedPlan.requiredSkills;
      form.aquiredSkills.value = editedPlan.aquiredSkills;
      form.contents.value = editedPlan.contents;
      form.examSynopsis.value = editedPlan.examSynopsis;
      form.bibliography.value = editedPlan.bibliography;

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

    })

}
