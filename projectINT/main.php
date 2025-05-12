<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Residence Finder</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      color: #333;
      line-height: 1.6;
    }

    .header {
      text-align: center;
      padding: 2rem 1rem;
      font-size: 2rem;
      font-weight: bold;
      background-color: #003366;
      color: white;
    }

    .hero {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      padding: 1rem;
    }

    .residence-img {
      width: 300px;
      height: 200px;
      background-size: cover;
      background-position: center;
      border-radius: 10px;
      position: relative;
      cursor: pointer;
      overflow: hidden;
    }

    .residence-img span {
      position: absolute;
      bottom: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.5);
      color: #fff;
      padding: 0.5rem;
      text-align: center;
      font-weight: bold;
    }

    .search-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 2rem 1rem;
      gap: 1rem;
    }

    .search-input {
      padding: 0.8rem 1rem;
      width: 60%;
      border-radius: 20px;
      border: 1px solid #aaa;
      font-size: 1rem;
    }

    .search-button {
      background-color: #003366;
      color: white;
      padding: 0.8rem 2rem;
      border-radius: 25px;
      font-size: 1rem;
      border: none;
      cursor: pointer;
    }

    .search-button:hover {
      background-color: #002244;
    }

    .residence-options {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 1.5rem;
      margin: 2rem;
    }

    .res-card {
      width: 250px;
      background-color: #eee;
      border-radius: 10px;
      text-align: center;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .res-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }

    .res-card .card-actions {
      padding: 1rem;
    }

    .res-card button {
      margin: 0.3rem;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 20px;
      background-color: #003366;
      color: white;
      cursor: pointer;
    }

    .res-card button:hover {
      background-color: #004d99;
    }

    .caption-section {
      max-width: 900px;
      margin: 2rem auto;
      padding: 1rem;
      text-align: center;
    }

    .caption-section h2 {
      color: #003366;
    }

    .caption-section p {
      font-size: 1rem;
      color: #444;
    }

    .footer {
      background-color: #003366;
      color: white;
      text-align: center;
      padding: 1.5rem 1rem;
      margin-top: 2rem;
    }

    /* Popup Modal */
    #residences-popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      border: 1px solid #ccc;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      border-radius: 8px;
      width: 90%;
      max-width: 600px;
    }

    #residences-popup h3 {
      margin-top: 0;
      color: #003366;
      margin-bottom: 1rem;
    }

    #residences-list {
      list-style: none;
      padding: 0;
    }

    #residences-list li {
      padding: 0.5rem 0;
      border-bottom: 1px solid #eee;
    }

    #residences-list li:last-child {
      border-bottom: none;
    }

    #popup-close-btn {
      background-color: #ddd;
      color: #333;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 1rem;
    }

    #popup-close-btn:hover {
      background-color: #ccc;
    }

    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }
  </style>
</head>
<body>

  <div class="header">Student Residence Finder</div>

  <div class="hero">
    <div class="residence-img" onclick="window.location.href='Building54Gal.html';" style="background-image: url('eMalahleni.jpg');">
      <span>Building 54</span>
    </div>
    <div class="residence-img" onclick="window.location.href='corridorGal.html';" style="background-image: url('corridor.jpg');">
      <span>Corridor Hill</span>
    </div>
    <div class="residence-img" onclick="window.location.href='khayalethuGal.html';" style="background-image: url('khayalethu.png');">
      <span>Khayalethu</span>
    </div>
    <div class="residence-img" onclick="window.location.href='privateGal.html';" style="background-image: url('private1.jpg');">
      <span>Private Rooms</span>
    </div>
  </div>
  <div class="search-section">
  <h2 style="color: #cc0000;">Registration Closing Countdown</h2>
  <p id="countdown" style="font-size: 1.2rem; color: #003366; font-weight: bold;"></p>
</div>

  <div class="search-section">
    <input type="text" class="search-input" id="search-term" placeholder="Search available residences..." />
    <button class="search-button" onclick="searchResidenceMaps()">Search Maps</button>
  </div>

  <div class="residence-options">
    <div class="res-card">
      <img src="eMalahleni.jpg" alt="Building 54 Residence">
      <div class="card-actions">
        <button onclick="showInfo('Building 54')">More Info</button>
        <button onclick="window.location.href='building54.html'">Reserve Room</button>
      </div>
    </div>
    <div class="res-card">
      <img src="corridor.jpg" alt="Corridor Hill">
      <div class="card-actions">
        <button onclick="showInfo('Corridor Hill')">More Info</button>
        <button onclick="window.location.href='corridorHill.php'">Reserve Room</button>
      </div>
    </div>
    <div class="res-card">
      <img src="khayalethu.png" alt="Khayalethu">
      <div class="card-actions">
        <button onclick="showInfo('Khayalethu')">More Info</button>
        <button onclick="window.location.href='khayalethu.php'">Reserve Room</button>
      </div>
    </div>
    <div class="res-card">
      <img src="private1.jpg" alt="Private Rooms">
      <div class="card-actions">
        <button onclick="showInfo('Private Rooms')">More Info</button>
        <button onclick="window.location.href='private.html'">Reserve Room</button>
      </div>
    </div>
  </div>

  <div class="caption-section">
    <h2>Find Your Perfect Student Home</h2>
    <p>Browse student residences located near campus, offering affordable, modern, and secure living spaces.</p>

    <h2>Compare & Choose</h2>
    <p>Use our tools to compare residences by price, amenities, and room types.</p>

    <h2>Need Help?</h2>
    <p>Contact our team or visit our <a href="#">FAQ page</a> for answers and policies.</p>
  </div>

  <!-- Modal Popup -->
  <div id="residences-popup">
    <h3>Residence Information</h3>
    <ul id="residences-list"></ul>
    <button id="popup-close-btn" onclick="closePopup()">Close</button>
  </div>
  <div id="overlay"></div>

  <div class="footer">
    <p>&copy; 2025 Student Residence Finder. All rights reserved.</p>
    <small>Contact us: <a href="mailto:support@studentresidence.com" style="color: #fff;">support@studentresidence.com</a></small>
  </div>

  <script>
    function showInfo(resName) {
      const list = document.getElementById('residences-list');
      list.innerHTML = `<li><strong>${resName}</strong><br>Includes kitchen, study area, WiFi, 24/7 security and more.</li>`;
      document.getElementById('residences-popup').style.display = 'block';
      document.getElementById('overlay').style.display = 'block';
    }

    function closePopup() {
      document.getElementById('residences-popup').style.display = 'none';
      document.getElementById('overlay').style.display = 'none';
    }

    async function searchResidenceMaps() {
      const searchTerm = document.getElementById('search-term').value.toLowerCase();
      alert('Searching maps for: ' + searchTerm);
      // Implement API/map logic here
    }
   
  // Set your target date (YYYY-MM-DDTHH:MM:SS format)
  const deadline = new Date("2025-06-15T23:59:59").getTime(); // Change date as needed

  const countdownElement = document.getElementById("countdown");

  const timer = setInterval(() => {
    const now = new Date().getTime();
    const distance = deadline - now;

    if (distance <= 0) {
      clearInterval(timer);
      countdownElement.innerHTML = "⚠️ Registration is now closed.";
      countdownElement.style.color = "#cc0000";
    } else {
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);
      countdownElement.innerHTML = `⏳ Registration closes in ${days}d ${hours}h ${minutes}m ${seconds}s`;
    }
  }, 1000);


  </script>
</body>
</html>
