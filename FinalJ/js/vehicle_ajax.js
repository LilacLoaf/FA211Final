// When the user clicks a View link, load vehicle details via AJAX

document.addEventListener("click", function(e) {
    if (e.target.classList.contains("view-vehicle")) {
        e.preventDefault();

        let vehicleId = e.target.dataset.id;

        fetch(`/FA211Final/Final/vehicleajax/get/${vehicleId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let v = data.vehicle;

                    document.getElementById("vehicle-details").innerHTML = `
                        <h3>Vehicle Details (Loaded with AJAX)</h3>
                        <ul>
                            <li><strong>ID:</strong> ${v.id}</li>
                            <li><strong>Brand:</strong> ${v.brand}</li>
                            <li><strong>Model:</strong> ${v.model}</li>
                            <li><strong>License Plate:</strong> ${v.licensePlate}</li>
                            <li><strong>Status:</strong> ${v.status}</li>
                        </ul>
                    `;
                } else {
                    document.getElementById("vehicle-details").innerHTML =
                        "<p>Vehicle not found.</p>";
                }
            });
    }
});
