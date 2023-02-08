window.onload = () => {
  getDatabases()
    .then(databases => {
      databases.forEach(db => {
        addElement(db);
      });
    })
    .catch((errorMessage) => {
      console.log(errorMessage);
    })
}

async function getDatabases() {
  const response = await fetch(
    "../../../server/api.php",
    { method: "GET" }
  );
  return await response.json();
}

function addElement(dbName) {
  const newDt = document.createElement("dt");
  const dtContent = document.createTextNode(dbName); // TODO: not sure

  newDt.appendChild(dtContent);

  const dl = document.getElementById("databases-dl");
  dl.appendChild(newDt);
}
