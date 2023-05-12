window.onload = () => {
  document.getElementById("planForm").addEventListener("submit", function(event) {
    // TODO: read and refine based on register.js
    event.preventDefault();

    // Get form values
    var title = document.getElementById("title").value;
    var owner = document.getElementById("owner").value;
    var description = document.getElementById("description").value;

    // Create plan object
    var plan = {
      title: title,
      owner: owner,
      description: description
    };

    // Send POST request
    fetch("YOUR_POST_URL", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(plan)
    })
      .then(function(response) {
        if (response.ok) {
          console.log("Plan created successfully");
          // Additional actions after plan creation
        } else {
          console.error("An error occurred while creating the plan");
          // Additional error handling
        }
      })
      .catch(function(error) {
        console.error("An error occurred:", error);
        // Additional error handling
      });
  });
}
