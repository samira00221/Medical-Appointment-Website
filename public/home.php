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
    <title>Baho Hospital Appointment Portal</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/appointment.css">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="js/main.js" defer></script>
    <script src="js/search.js" defer></script>
    <script src="js/home.js" defer></script>


</head>
<body>
        <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-bar-right">
            <a href="#" class="donate-link">DONATE</a>
            <div class="language-menu-wrapper">
                    <div class="language-toggle">
                <span class="language-label">ENG</span>
                <span class="down-arrow">&#9662;</span> <!-- ▼ -->
                </div>
                    <div class="language-menu-options">
                <a href="#">Eng</a>
                <a href="#">Fr</a>
                    </div>
                </div>
                
  <div class="user-menu-wrapper">

    <img src="../images/user-icon.png" alt="User Menu" class="user-icon">

    <div class="user-menu-options">
    <a href="profile.php">My Profile</a>
    <a href="../src/controllers/Logout.php">Logout</a>
    </div>

    </div>
        </div>
    </div>
    <!-- Main Header -->
    <header class="main-header">
        <div class="logo-area">
        <img src="../images/BA.png" alt="Baho Hospital Logo" class="logo-img">
    </div>
        <nav>
            <ul class="main-nav">
                <li><a href="index.html">HOME</a></li>
                <li><a href="#search">SERVICES</a></li>
                <li><a href="#doctor-section">FIND A DOCTOR</a></li>
                <li><a href="#contact">CONTACT</a></li>
            </ul>
        </nav>
        <a href="#" class="appointment-btn">Make an Appointment</a>
    </header>
    <div id="search" class="global-search-wrapper">
        <form class="global-search-form" action="#" method="get">
            <input type="text" name="q" placeholder="Search for services, doctors..." class="global-search-input">
        </form>
        </div>
    <div id="search-results" class="search-results"></div>
    <main>
        
    <section id="doctor-section" class="doctor-section">
         <h2 class="doctors-section">Our Doctors</h2>

         <div id="doctors-container" class="card-row">

            <div class="doctor-cards">
                <div class="doctor-card">
        <img src="../images/miranda.jpg" alt="Dr. Miranda Bailey" class="doctor-photo">

        <div class="doctor-details">

            <div class="doctor-header">
                <div class="doctor-info">
                    <h3>Miranda Bailey, MD</h3>
                    <p class="primary-specialty">Cardiologist</p>
                </div>
                <a href="#" class="btn-book-appointment" data-doctor="Miranda Bailey, MD">Book Appointment</a>
            </div>

            <div class="doctor-specialties">
                <h4>Specialties</h4>
                <ul>
                    <li>Hypertension Management</li>
                    <li>Cardiac Emergencies</li>
                    <li>Cardiovascular Health Promotion</li>
                </ul>
            </div>

            <div class="doctor-contact">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                </svg>
                <span>+250 788 123 456</span>
            </div>
            
        </div>
    </div>
                <div class="doctor-card">
        <img src="../images/ashley.jpg" alt="Dr. Ashley Kanimba" class="doctor-photo">

        <div class="doctor-details">

            <div class="doctor-header">
                <div class="doctor-info">
                    <h3>Ashley Kanimba, MD</h3>
                    <p class="primary-specialty">Internist</p>
                </div>
                <a href="#" class="btn-book-appointment" data-doctor="Ashley Kanimba, MD">Book Appointment</a>
            </div>

            <div class="doctor-specialties">
                <h4>Specialties</h4>
                <ul> 
                    <li>Chronic Disease Management</li>
                    <li>Preventive Health Screenings</li>
                    <li>Comprehensive Adult Care</li>
                </ul>
            </div>

            <div class="doctor-contact">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                </svg>
                <span>+250 788 234 000</span>
            </div>
            
        </div>
    </div>
                <div class="doctor-card">
                    <img src="../images/oscar.jpg" alt="Dr. Oscar Mboo" class="doctor-photo">
                    <div class="doctor-details">
                        <div class="doctor-header">
                             <div class="doctor-info">
                                <h3>Oscar Mboo, MD</h3>
                                <p class="primary-specialty">Family medicine</p>
                             </div>
                                <a href="#" class="btn-book-appointment" data-doctor="Oscar Mboo, MD">Book Appointment</a>
                         </div>
                    <div class="doctor-specialties">
                             <h4>Specialties</h4>
                        <ul> 
                          <li>Diabetes, Hypertension, and Asthma Care</li>
                          <li>Lifestyle Counseling & Risk Reduction</li>
                        </ul>
                    </div>

            <div class="doctor-contact">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                </svg>
                <span>+250 790 890 001</span>
            </div>
        </div>
    </div>
            <div class="doctor-card">
         <img src="../images/arthur.jpg" alt="Dr. Arthur King" class="doctor-photo">

        <div class="doctor-details">

            <div class="doctor-header">
                <div class="doctor-info">
                    <h3>Arthur King, MD</h3>
                    <p class="primary-specialty">Colon and Rectal Surgery</p>
                </div>
                <a href="#" class="btn-book-appointment" data-doctor="Arthur King, MD">Book Appointment</a>
            </div>

            <div class="doctor-specialties">
                <h4>Specialties</h4>
                <ul> 
                    <li>Diagnosis and Surgical Removal of Tumors</li>
                    <li>Management of Inflammatory Bowel Diseases (IBD)</li>
                    <li>Treatment of Hemorrhoids, Fistulas, and Fissures</li>
                </ul>
            </div>

            <div class="doctor-contact">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                </svg>
                <span>+250 780 110 090</span>
            </div>
            
            
        
    </div>
            <!-- Add more cards similarly -->
    </div>
    </div>
    </div>
    </section>
    </main>
    <footer id="contact">
        <p>Contact: info@baho.com | +250 780 0000</p>
        <p id="support">Support: support@baho.com</p>
    </footer>
            <!-- Appointment Modal -->
<div id="appointment-modal" class="appointment-modal hidden" role="dialog" aria-modal="true" aria-labelledby="appointment-title">
  <div class="appointment-modal-content">
    
    <!-- Close Button -->
    <button type="button" id="closeModalBtn" class="close-btn" aria-label="Close appointment form">&times;</button>

    <h2 id="appointment-title">Book an Appointment</h2>
    
    <form id="appointmentForm" method="POST" action="../src/controllers/BookAppointment.php">
      
      <!-- Fullname -->
        <label for="fullname">Full Name:<span style="color:red">*</span></label>
        <input type="text" id="fullname" name="fullname" placeholder="Full Name" autocomplete="name" required>
        <small id="fullname-error" class="error-message"></small>

        <!-- Email -->
        <label for="email">Email:<span style="color:red">*</span></label>
        <input type="email" id="email" name="email" placeholder="Email (e.g., user@example.com)" autocomplete="email" required>
        <small id="email-error" class="error-message"></small>

      <!-- Gender Identity -->
      <fieldset>
        <legend>Gender Identity <span style="color:red">*</span></legend>
        <label><input type="radio" name="gender" value="Female"> Female</label>
        <label><input type="radio" name="gender" value="Male"> Male</label>
        <label><input type="radio" name="gender" value="Non-binary"> Non-binary</label>
      </fieldset>

      <!-- Insurance -->
      <label for="insurance">Insurance Provider <span style="color:red">*</span></label>
      <select id="insurance" name="insurance" required>
        <option value="">Select insurance</option>
        <option value="RAMA">RAMA</option>
        <option value="MMI">MMI</option>
        <option value="Mediplan">Mediplan</option>
        <option value="None">None</option>
      </select>

      <!-- Checkboxes -->
      <div class="checkbox-group">
        <label><input type="checkbox" name="visited_before"> I’ve been treated at this hospital before</label><br>
        <label><input type="checkbox" name="chronic_disease"> I have a chronic disease</label><br>
        <label><input type="checkbox" name="special_needs"> I have special needs</label>
      </div>

      <!-- Location -->
      <label for="location">Preferred Location <span style="color:red">*</span></label>
      <select id="location" name="location" required>
        <option value="">Select a branch</option>
        <option value="Kigali">Main Branch – Kigali</option>
        <option value="Rubavu">Small Branch – Kacyiru</option>
      </select>

      <!-- Service & Doctor -->
      <label for="service">Choose a Service <span style="color:red">*</span></label>
      <select id="service" name="service" required>
        <option value="">Select a service</option>
        <!-- Populated dynamically -->
      
      </select>
      <small id="service-warning" class="warning-text" style="color: red"></small>

      <label for="doctor">Choose a Doctor <span style="color:red">*</span></label>
      <select id="doctor" name="doctor" required disabled>
        <option value="">Select a doctor</option>
      </select>

      <!-- Warning if service not selected -->
      <p id="doctor-warning" style="color: red; display: none;">Please select a service first.</p>

      <!-- Date -->
      <label for="appointment-date">Preferred Date <span style="color:red">*</span></label>
      <input type="date" id="appointment-date" name="appointment_date" required disabled>

      <!-- Time Slot -->
      <label for="appointment-time">Preferred Time <span style="color:red">*</span></label>
      <select id="appointment-time" name="appointment_time" required disabled>
        <option value="">Select time</option>
      </select>

      <!-- Reason -->
      <label for="reason">Reason for Visit:</label>
      <textarea name="message" id="reason" rows="3" placeholder="Describe your concern or request (optional)..."></textarea>

      <!-- Submit Buttons -->
      <button type="submit">Confirm Appointment</button>
    </form>
  </div>
</div>



<!-- ========== Trigger Buttons (examples) ========== -->
<!-- Add these somewhere in your layout -->
<!--button id="open-appointment-top">Book Appointment</button
Or, on each doctor card: -->
<!-- <button class="book-from-card" data-doctor="Dr. Miranda Bailey">Book Appointment</button> -->

    <script>
      // Force page reload when user navigates back (bfcache)
      window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
          window.location.reload();
        }
      });
    </script>

</body>
</html>

