document.addEventListener('DOMContentLoaded', () => {
  const input = document.querySelector('.global-search-input');
  const container = document.getElementById('doctors-container');

  const doctors = [
    {
      name: "Miranda Bailey, MD",
      specialty: "Cardiology",
      photo: "../images/miranda.jpg",
      phone: "+250 790 123 456",
      services: [
        "Hypertension Management",
        "Cardiac Emergencies",
        "Cardiovascular Health Promotion"
      ]
    },
    {
      name: "Ashley Kanimba, MD",
      specialty: "Internist",
      photo: "../images/ashley.jpg",
      phone: "+250 788 234 000",
      services: [
        "Chronic Disease Management",
        "Preventive Health Screenings",
        "Comprehensive Adult Care"
      ]
    },
    {
      name: "Oscar Mboo, MD",
      specialty: "Family medicine",
      photo: "../images/oscar.jpg",
      phone: "+250 790 890 001",
      services: [
        "Diabetes, Hypertension, and Asthma Care",
        "Lifestyle Counseling & Risk Reduction"
      ]
    },
    {
      name: "Arthur King, MD",
      specialty: "Colon and Rectal Surgery",
      photo: "../images/arthur.jpg",
      phone: "+250 780 110 090",
      services: [
        "Diagnosis and Surgical Removal of Tumors",
        "Management of Inflammatory Bowel Diseases",
        "Treatment of Hemorrhoids, Fistulas, and Fissures"
      ]
    }

  ];

  function displayDoctors(filteredDoctors) {
    container.innerHTML = "";

    if (filteredDoctors.length === 0) {
      container.innerHTML = "<p>No matching doctors found.</p>";
      return;
    }

    filteredDoctors.forEach(doc => {
      const card = document.createElement("div");
      card.className = "doctor-card";
      card.innerHTML = `
        <img src="${doc.photo}" alt="${doc.name}" class="doctor-photo" style="width:100px; height:100px; border-radius: 50%; object-fit: cover;">
        <div class="doctor-details" style="flex:1;">
          <div class="doctor-header" style="display:flex; justify-content: space-between; align-items: center;">
            <div class="doctor-info">
              <h3 style="margin:0;">${doc.name}</h3>
              <p class="primary-specialty" style="color: #0077b6; margin: 4px 0;">${doc.specialty}</p>
            </div>
            <a href="#" class="btn-book-appointment" style="background:#0077b6; color:#fff; padding: 8px 12px; border-radius: 4px; text-decoration:none;">Book Appointment</a>
          </div>
          <div class="doctor-specialties" style="margin-top: 10px;">
            <h4>Services</h4>
            <ul>
              ${doc.services && doc.services.length > 0
                ? doc.services.map(s => `<li>${s}</li>`).join('')
                : '<li>No services listed</li>'
              }
            </ul>
          </div>
          <div class="doctor-contact" style="margin-top:10px; display: flex; align-items: center; gap: 5px; color:#333;">
            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512" fill="#0077b6">
              <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
            </svg>
            <span>${doc.phone}</span>
          </div>
        </div>
      `;
      container.appendChild(card);
    });
  }

  // Show all doctors by default
  displayDoctors(doctors);

  // Filter as user types
  input.addEventListener('input', () => {
    const query = input.value.trim().toLowerCase();

    if (query.length < 2) {
      displayDoctors(doctors); // Show all again if query is short
      return;
    }

    const results = doctors.filter(d =>
      d.name.toLowerCase().includes(query) ||
      d.specialty.toLowerCase().includes(query) ||
      (d.services && d.services.some(s => s.toLowerCase().includes(query)))
    );

    displayDoctors(results);
  });
});


