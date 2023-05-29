window.onload = function() {
  document
    .getElementById("create-plan-button")
    .addEventListener('click', (_event) => {
      window.location.assign(CLIENT_COMPONENTS + 'createPlan/createPlan.html');
    });

  fetch(SERVER_CONTROLLERS + 'get_all_plans.php')
    .then(response => response.json())
    .then(({ data }) => displayPlans(JSON.parse(data)))
    .catch(error => console.error('Error:', error));
};

function addColumn(toRow, textContent, className) {
  const column = document.createElement('td');
  column.textContent = textContent;
  column.className = className;
  toRow.appendChild(column);
}

function displayPlans(plans) {
  const plansList = document.getElementById('plans-list');

  // TODO: abstract get requests in function with callback for success/failure
  // TODO: abstract anchor creation under 'td'
  plans.forEach(plan => {
    const row = document.createElement('tr');
    const columnApender = addColumn.bind(this, row);

    columnApender(plan.name, 'plan-name');
    columnApender(plan.owner, 'plan-owner');

    const deleteCell = document.createElement('td');
    const deleteAnchor = document.createElement('a');
    deleteAnchor.textContent = 'Изтрий';
    deleteAnchor.href =
      CLIENT_COMPONENTS
      + 'delete_plan.php?'
      + new URLSearchParams({ id: plan.id });
    deleteCell.appendChild(deleteAnchor);
    row.appendChild(deleteCell);

    const editCell = document.createElement('td');
    const editAnchor = document.createElement('a');
    editAnchor.textContent = 'Редактирай';
    editAnchor.href =
      CLIENT_COMPONENTS
      + 'editPlan/editPlan.html?'
      + new URLSearchParams({ id: plan.id });
    editCell.appendChild(editAnchor);
    row.appendChild(editCell);

    const viewCell = document.createElement('td');
    const viewAnchor = document.createElement('a');
    viewAnchor.textContent = 'PDF';
    viewAnchor.href =
      SERVER_CONTROLLERS
      + 'get_pdf.php?'
      + new URLSearchParams({ id: plan.id });
    viewCell.appendChild(viewAnchor);
    row.appendChild(viewCell);

    const exportCell = document.createElement('td');
    const exportAnchor = document.createElement('a');
    exportAnchor.textContent = 'JSON';
    exportAnchor.style.textDecoration = 'underline';
    exportAnchor.style.color = 'blue';
    exportAnchor.style.cursor = 'pointer';
    exportAnchor.addEventListener('click', exportJSON);
    exportCell.appendChild(exportAnchor);
    row.appendChild(exportCell);

    plansList.appendChild(row);
  });
}

function exportJSON() {
  fetch(
    SERVER_CONTROLLERS
    + 'get_plan.php?'
    + new URLSearchParams({ id: plan.id })
  )
    .then(response => response.json())
    .then(data => {
      const jsonData = JSON.stringify(data);
      const blob = new Blob([jsonData], { type: 'application/json' });

      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.download = 'data.json';

      link.click();

      URL.revokeObjectURL(link.href);
    })
    .catch(error => {
      console.error('Error:', error);
      console.error('Failed to fetch JSON data.');
    });
}
