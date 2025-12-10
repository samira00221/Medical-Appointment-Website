<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
// Prevent browser cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile - Baho Hospital</title>
  <link rel="stylesheet" href="css/profile.css">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

  <div class="page-wrapper">
  <!-- Top Bar -->
  <div class="top-bar">
    <div class="top-bar-right" style="padding: 1em;">
      <a href="home.php" class="login-link">HOME</a>
      <a href="#" class="donate-link">DONATE</a>
      <a href="../src/controllers/Logout.php" class="logout-link">LOGOUT</a>
    </div>
  </div>

  <!-- Updated Profile Layout -->
  <div class="main-content">
    <!-- Left Side: Profile Info -->
    <div class="profile-sidebar">
      <img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic">
      <h2 id="user-name">Loading...</h2>
      <p id="user-email">Loading...</p>
      </div>

    <!-- Right Side: Appointments -->
    <div class="appointments-section">
      <h2>Upcoming Appointments</h2>
      <div class="appointments-table-wrapper">
      <table class="appointments-table">
        <thead>
          <tr>
      <th>Service</th>
      <th>Doctor</th>
      <th>Location</th>
      <th>Date</th>
      <th>Time</th>
    </tr>
  </thead>
  <tbody id="appointments-tbody">
    <!-- Rows will be populated here -->
  </tbody>
      </table>
      </div>
      <div class="appointments-actions" style="padding: 4rem 0 0 0;">

  <button class="btn-delete">Cancel Selected</button>
  <button class="btn-edit">Update Details</button>
</div>

    </div>
  </div>

  <footer id="contact">
        <p>Contact: info@baho.com | +250 780 0000</p>
        <p id="support">Support: support@baho.com</p>
    </footer>

   </div>
  


    <script>
      // Force page reload when user navigates back (bfcache)
      window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
          window.location.reload();
        }
      });
      async function loadUserInfo() {
      try {
        const response = await fetch('../src/controllers/getUserInfo.php');
        if (!response.ok) throw new Error('Network response was not ok');
        const user = await response.json();
        document.getElementById('user-name').textContent = user.name;
        document.getElementById('user-email').textContent = user.email;
      } catch (error) {
        document.getElementById('user-name').textContent = 'Error loading user info';
        document.getElementById('user-email').textContent = '';
        console.error('Fetch user info failed:', error);
      }
    }

    loadUserInfo();

    async function loadAppointments() {
  try {
    const response = await fetch('../src/controllers/getAppointments.php');
    if (!response.ok) throw new Error('Failed to fetch appointments');
    const appointments = await response.json();

    const tbody = document.getElementById('appointments-tbody');
    tbody.innerHTML = '';

    if (appointments.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;">No upcoming appointments</td></tr>';
      return;
    }

    appointments.forEach(app => {
      const row = document.createElement('tr');

      row.innerHTML = `
        <td>${app.service}</td>
        <td>${app.doctor}</td>
        <td>${app.location}</td>
        <td>${app.appointment_date}</td>
        <td>${app.appointment_time}</td>
      `;

      tbody.appendChild(row);
    });
  } catch (error) {
    console.error('Error loading appointments:', error);
  }
}

// Call it after user info loads or on page load
loadAppointments();


    </script>

</body>
</html>
