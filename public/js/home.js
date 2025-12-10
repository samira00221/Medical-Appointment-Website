document.addEventListener('DOMContentLoaded', () => {
  const appointmentModal = document.getElementById('appointment-modal');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const appointmentForm = document.getElementById('appointmentForm');

  const triggerButtons = document.querySelectorAll('.btn-book-appointment, .appointment-btn, #open-appointment-top, .book-from-card');
  const serviceSelect = document.getElementById('service');
  const doctorSelect = document.getElementById('doctor');
  const doctorWarning = document.getElementById('doctor-warning');
  const dateInput = document.getElementById('appointment-date');
  const timeSelect = document.getElementById('appointment-time');
  const dateTimeWrapper = document.getElementById('date-time-wrapper');

  const allTimeSlots = ["09:00", "11:00", "14:00", "16:00"];

  const services = [
    "Hypertension Management",
    "Cardiac Emergencies",
    "Cardiovascular Health Promotion",
    "Chronic Disease Management",
    "Preventive Health Screenings",
    "Comprehensive Adult Care",
    "Diabetes, Hypertension, and Asthma Care",
    "Lifestyle Counseling & Risk Reduction",
    "Diagnosis and Surgical Removal of Tumors",
    "Management of Inflammatory Bowel Diseases",
    "Treatment of Hemorrhoids, Fistulas, and Fissures"
  ];

  const doctors = [
    {
      name: "Miranda Bailey, MD",
      services: [
        "Hypertension Management",
        "Cardiac Emergencies",
        "Cardiovascular Health Promotion"
      ]
    },
    {
      name: "Ashley Kanimba, MD",
      services: [
        "Chronic Disease Management",
        "Hypertension Management",
        "Preventive Health Screenings",
        "Comprehensive Adult Care"
      ]
    },
    {
      name: "Oscar Mboo, MD",
      services: [
        "Diabetes, Hypertension, and Asthma Care",
        "Lifestyle Counseling & Risk Reduction"
      ]
    },
    {
      name: "Arthur King, MD",
      services: [
        "Diagnosis and Surgical Removal of Tumors",
        "Management of Inflammatory Bowel Diseases",
        "Treatment of Hemorrhoids, Fistulas, and Fissures"
      ]
    }
  ];

// Make appointment modal show
document.querySelector('.appointment-btn').addEventListener('click', function (e) {
  e.preventDefault();
 document.getElementById('appointment-modal').classList.remove('hidden');
});

// Close modal
document.getElementById('closeModalBtn').addEventListener('click', function () {
  document.getElementById('appointment-modal').classList.add('hidden');
});




function showError(inputElement, message) {
    const error = document.createElement("div");
    error.className = "error-message";
    error.style.color = "red";
    error.style.fontSize = "0.9em";
    error.style.marginTop = "4px";
    error.textContent = message;

    inputElement.parentNode.insertBefore(error, inputElement.nextSibling);
}



  function populateServices() {
    serviceSelect.innerHTML = '<option value="">Select a service</option>';
    services.forEach(service => {
      const option = document.createElement('option');
      option.value = service;
      option.textContent = service;
      serviceSelect.appendChild(option);
    });
  }

  function populateDoctorsByService(service, preselectedDoctor = "") {
    doctorSelect.innerHTML = '<option value="">Select a doctor</option>';
    doctors.forEach(doc => {
      if (doc.services.includes(service)) {
        const option = document.createElement('option');
        option.value = doc.name;
        option.textContent = doc.name;
        if (doc.name === preselectedDoctor) option.selected = true;
        doctorSelect.appendChild(option);
      }
    });
    doctorSelect.disabled = false;
  }

  function autofillUser() {
  fetch('../src/controllers/getUserInfo.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('User not logged in or not found.');
      }
      return response.json();
    })
    .then(user => {
      document.getElementById('fullname').value = user.name;
      document.getElementById('email').value = user.email;
    })
    .catch(error => {
      console.error('Error fetching user info:', error);
      // Optionally show a message or redirect to login
    });
}
document.getElementById('doctor').addEventListener('change', checkAvailability);
document.getElementById('appointment-date').addEventListener('change', checkAvailability);

function checkAvailability() {
  const doctor = document.getElementById('doctor').value;
  const date = document.getElementById('appointment-date').value;

  if (!doctor || !date) return;

  fetch(`../src/api/check_availability.php?doctor=${doctor}&date=${date}`)
    .then(response => response.json())
    .then(data => {
      const timeSelect = document.getElementById('appointment-time');

      // If fully booked, make time select readonly or disable it
      if (data.fullyBooked) {
        alert("No available slots for this doctor on this date.");
        timeSelect.innerHTML = '';
        timeSelect.disabled = true;
        return;
      }

      // Populate available time slots
      timeSelect.disabled = false;
      timeSelect.innerHTML = '';
      data.availableSlots.forEach(slot => {
        const option = document.createElement('option');
        option.value = slot;
        option.textContent = slot;
        timeSelect.appendChild(option);
      });
    });
}



  triggerButtons.forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();

      appointmentForm.reset(); // ✅ Reset FIRST
      autofillUser();   

      appointmentModal.classList.remove('hidden');  // Add this
      populateServices();


      doctorSelect.innerHTML = '<option value="">Select a doctor</option>';
      doctorSelect.disabled = true;
      doctorWarning.style.display = 'none';
      dateInput.disabled = true;
      timeSelect.disabled = true;
      timeSelect.innerHTML = '<option value="">Select time</option>';
      if (dateTimeWrapper) dateTimeWrapper.style.display = "none";

      const doctorName = btn.dataset.doctor;
      if (doctorName) {
        const doctorObj = doctors.find(d => d.name === doctorName);
        if (doctorObj) {
          serviceSelect.value = doctorObj.services[0];
          populateDoctorsByService(doctorObj.services[0], doctorName);
          dateInput.disabled = false;
          timeSelect.disabled = true;
          if (dateTimeWrapper) dateTimeWrapper.style.display = "block";
        }
      }

      //appointmentModal.classList.remove('hidden');
    });
  });

  // Check for success message on page load
  


  serviceSelect.addEventListener("change", function () {
    const serviceSelected = this.value !== "";
    if (serviceSelected) {
      doctorSelect.disabled = false;
      doctorWarning.style.display = "none";
      populateDoctorsByService(this.value);
    } else {
      doctorSelect.disabled = true;
      doctorWarning.style.display = "block";
    }
    dateInput.value = "";
    dateInput.disabled = true;
    timeSelect.innerHTML = '<option value="">Select time</option>';
    timeSelect.disabled = true;
    if (dateTimeWrapper) dateTimeWrapper.style.display = "none";
  });

  doctorSelect.addEventListener("click", () => {
    if (!serviceSelect.value) {
      doctorWarning.style.display = "block";
    }
  });

  doctorSelect.addEventListener("change", () => {
    if (doctorSelect.value !== "") {
      dateInput.disabled = false;
      timeSelect.disabled = true;
      if (dateTimeWrapper) dateTimeWrapper.style.display = "block";
    } else {
      dateInput.disabled = true;
      timeSelect.disabled = true;
      if (dateTimeWrapper) dateTimeWrapper.style.display = "none";
    }
    dateInput.value = "";
    timeSelect.innerHTML = '<option value="">Select time</option>';
  });

  dateInput.addEventListener("change", () => {
    const doctor = doctorSelect.value;
    const date = dateInput.value;
    if (!doctor || !date) return;

    fetch(`../src/api/check_availability.php?doctor=${encodeURIComponent(doctor)}&date=${date}`)
      .then(res => res.json())
      .then(data => {
        timeSelect.innerHTML = '<option value="">Select time</option>';

        if (!data || data.error) {
      alert(data.error || "Error fetching availability");
      timeSelect.disabled = true;
      return;
      }

        if (data.fullyBooked) {
          alert("This doctor is fully booked on this date. Please choose another date.");
          timeSelect.disabled = true;
          dateInput.value = "";
          return;
        } 
        if (Array.isArray(data.availableSlots)) {
          timeSelect.disabled = false;
          data.availableSlots.forEach(slot => {
            const option = document.createElement("option");
            option.value = slot;
            option.textContent = `${slot} - ${getSlotEnd(slot)}`;
            timeSelect.appendChild(option);
          });
        } else {
          console.error("availableSlots is not an array:", data.availableSlots);
      timeSelect.disabled = true;
        }
      })
      .catch(err => {
        console.error("Error fetching availability:", err);
        timeSelect.innerHTML = '<option value="">Error loading times</option>';
        timeSelect.disabled = true;
      });
  });

  function getSlotEnd(start) {
    const [h, m] = start.split(":").map(Number);
    const endHour = h + 2;
    return `${String(endHour).padStart(2, '0')}:${m === 0 ? '00' : m}`;
  }

  closeModalBtn.addEventListener('click', () => {
    appointmentModal.classList.add('hidden');
  });

  window.addEventListener('click', e => {
    if (e.target === appointmentModal) {
      appointmentModal.classList.add('hidden');
    }
  });

  if (!appointmentForm) return;


  appointmentForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Re-enable all fields before collecting values
    appointmentForm.querySelectorAll('input, select, textarea').forEach(el => el.disabled = false);

    // Safely get field values
    const fullname = document.getElementById('fullname')?.value.trim() || '';
    const email = document.getElementById('email')?.value.trim() || '';
    const gender = document.querySelector('input[name="gender"]:checked')?.value || '';
    const insurance = document.getElementById('insurance')?.value.trim() || '';
    const visitedBefore = document.querySelector('input[name="visited_before"]')?.checked ? 1 : 0;
    const chronicDisease = document.querySelector('input[name="chronic_disease"]')?.checked ? 1 : 0;
    const specialNeeds = document.querySelector('input[name="special_needs"]')?.checked ? 1 : 0;
    const location = document.getElementById('location')?.value.trim() || '';
    const service = document.getElementById('service')?.value.trim() || '';
    const doctor = document.getElementById('doctor')?.value.trim() || '';
    const date = document.getElementById('appointment-date')?.value.trim() || '';
    const time = document.getElementById('appointment-time')?.value.trim() || '';

    const emailError = document.getElementById('email-error');
    const nameError = document.getElementById('fullname-error');

    let hasError = false;

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      emailError.textContent = 'Please enter a valid email (e.g., user@example.com)';
      hasError = true;
      scrollToAndFocus('email');
    } else {
      emailError.textContent = '';
    }

    // Name validation
    const namePattern = /^[A-Za-z\s]+$/;
    if (!namePattern.test(fullname)) {
      nameError.textContent = 'Please enter a valid full name (letters only)';
      hasError = true;
      scrollToAndFocus('fullname');
    } else {
      nameError.textContent = '';
    }

    // Required fields check
    if (!fullname || !email || !service || !doctor || !date || !time || !gender || !insurance || !location) {
      alert("Please fill in all required fields.");
      hasError = true;
    }

    // Future date check
    const selectedDate = new Date(date);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    if (selectedDate <= today) {
      alert("Please select a future appointment date.");
      hasError = true;
    }

    // Time slot check
    const allowedSlots = ["09:00", "11:00", "14:00", "16:00"];
    if (!allowedSlots.includes(time)) {
      alert("Please select a valid appointment time.");
      hasError = true;
    }

    // Log for debugging
    console.log("Form values:", {
      fullname, email, gender, insurance, visitedBefore,
      chronicDisease, specialNeeds, location, service, doctor, date, time
    });

    if (hasError) return;

    // Submit via fetch
    fetch("/Final Project/src/controllers/BookAppointment.php", {
      method: "POST",
      body: new FormData(appointmentForm)
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert("Appointment booked successfully!");
          appointmentModal?.classList.add("hidden");
          appointmentForm.reset();
        } else {
          showInlineError(data.message || "Something went wrong");
        }
      })
      .catch(error => {
        console.error("Submission error:", error);
        alert("Something went wrong. Please try again later.");
      });
  });



// Optional helper to scroll to a field with error
function scrollToAndFocus(id) {
    const el = document.getElementById(id);
    if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        el.focus();
    }
}


  populateServices();
});
