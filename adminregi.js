// Function to open admin setup popup
function openAdminPopup() {
    var popup = document.getElementById("admin-popup");
    popup.style.display = "block";
}

// Function to close admin setup popup
function closeAdminPopup() {
    var popup = document.getElementById("admin-popup");
    popup.style.display = "none";
}

// Function to setup admin credentials
function setupAdminCredentials() {
    var username = document.getElementById("admin-username").value;
    var password = document.getElementById("admin-password").value;

    fetch('setupAdmin.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            username: username,
            password: password
        })
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Display response message
        closeAdminPopup(); // Close popup after setting up admin credentials
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
