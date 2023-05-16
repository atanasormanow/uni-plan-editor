window.onload = function() {
  document
    .getElementById("create-plan-button")
    .addEventListener('click', (_event) => {
      window.location.replace(CLIENT_COMPONENTS + 'createPlan/createPlan.html');
    });

  fetch(SERVER_CONTROLLERS + 'get_all_plans.php')
    .then(response => response.json())
    .then(({ data }) => displayPlans(JSON.parse(data)))
    .catch(error => console.error('Error:', error));
};

function addColumn(toRow, textContent, className) {
  const column = document.createElement('td');
  column.className = className;
  column.textContent = textContent;
  toRow.appendChild(column);
}

function displayPlans(plans) {
  const plansList = document.getElementById('plans-list');

  plans.forEach(plan => {
    const row = document.createElement('tr');
    const columnApender = addColumn.bind(this, row);

    columnApender(plan.name, 'plan-name');
    columnApender(plan.description);
    columnApender(plan.owner);

    const viewCell = document.createElement('td');
    const anchor = document.createElement('a');
    anchor.textContent = 'View';
    anchor.href = SERVER_CONTROLLERS + 'get_pdf.php?' + new URLSearchParams({ id: plan.id });
    viewCell.appendChild(anchor);

    row.appendChild(viewCell);

    plansList.appendChild(row);
  });
}
