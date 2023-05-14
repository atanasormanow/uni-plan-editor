const getAllPlansURL = 'http://localhost/myapp/server/controller/get_all_plans.php';

window.onload = function() {
  document
    .getElementById("create-plan-button")
    .addEventListener('click', (_event) => {
      window.location.replace('http://localhost/myapp/client/components/createPlan/createPlan.html');
    });

  fetch(getAllPlansURL)
    .then(response => response.json())
    .then(data => displayPlans(JSON.parse(data.data)))
    .catch(error => console.error('Error:', error));
};

function displayPlans(plans) {
  console.log(plans);
  const plansList = document.getElementById('plans-list');

  plans.forEach((plan) => {
    const row = document.createElement('tr');

    const idCell = document.createElement('td');
    idCell.textContent = plan.id;
    row.appendChild(idCell);

    const nameCell = document.createElement('td');
    nameCell.className = 'plan-name';
    nameCell.textContent = plan.name;
    row.appendChild(nameCell);

    const descriptionCell = document.createElement('td');
    descriptionCell.textContent = plan.description;
    row.appendChild(descriptionCell);

    const ownerCell = document.createElement('td');
    ownerCell.textContent = plan.owner;
    row.appendChild(ownerCell);

    plansList.appendChild(row);
  });
}
