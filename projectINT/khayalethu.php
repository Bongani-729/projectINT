<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Khayalethu Residence</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      color: #333;
    }
    .header, .footer {
      background-color: #003366;
      color: white;
      text-align: center;
      padding: 1.5rem;
    }
    .residence-img {
      width: 300px;
      height: 200px;
      background: url('khayalethu.png') center/cover no-repeat;
      border-radius: 10px;
      margin: 2rem auto 1rem;
    }
    .info-section {
      max-width: 800px;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      margin: 2rem auto;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    h3 {
      color: #003366;
    }
    ul {
      list-style: disc;
      padding-left: 1.5rem;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    input, select {
      padding: 0.7rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }
    button {
      background-color: #003366;
      color: white;
      padding: 0.75rem;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #00509e;
    }
    iframe {
      width: 100%;
      height: 450px;
      border: none;
      border-radius: 10px;
      margin-top: 2rem;
    }
  </style>
</head>
<body>

  <div class="header">Khayalethu Residence</div>

  <div class="residence-img"></div>

  <div class="info-section">
    <p><strong>Khayalethu residence</strong> is a privately-managed residence for <strong>TUT students</strong> with easy access to campus.</p>
    <h3>Accommodation Details:</h3>
    <ul>
      <li><strong>Double-sharing rooms</strong> only</li>
      <li><strong>Single rooms</strong> available</li>
    </ul>

    <h3>Rules & Amenities:</h3>
    <ul>
      <li>Fridge not provided; students may bring their own</li>
      <li>Microwave provided; students may bring their own</li>
      <li><strong>Free hourly transport</strong> to/from TUT</li>
    </ul>

    <h3>Capacity:</h3>
    <ul>
      <li><strong>Total beds</strong>: 150</li>
      <li><strong>Female</strong>: 75 | <strong>Male</strong>: 75 | <strong>Other/Reserved</strong>: 400</li>
    </ul>
  </div>

  <div class="info-section">
    <h3>Book Your Room</h3>
    <form id="room-booking-form">
      <input type="text" id="name" placeholder="Full Name" required>
      <input type="email" id="email" placeholder="Email Address" required>
      <select id="room-type" required>
        <option value="">Select Room Type</option>
        <option value="male">Male Room</option>
        <option value="female">Female Room</option>
      </select>
      <button type="submit">Reserve Room</button>
    </form>
  </div>

  <div class="info-section" id="room-info">
    <h3>Live Room Availability:</h3>
    <ul>
      <li>Total Available: <span id="total">Loading...</span></li>
      <li>Male Rooms: <span id="male">Loading...</span></li>
      <li>Female Rooms: <span id="female">Loading...</span></li>
      <li>Unavailable: <span id="unavailable">Loading...</span></li>
    </ul>
  </div>

  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3589.880152929684!2d29.209636599999985!3d-25.87342160000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1eeaed4792b5cabf%3A0xb19b5fc6c99607f7!2sKhayalethu%20Student%20Residences!5e0!3m2!1sen!2sza!4v1746261893589!5m2!1sen!2sza" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  <div class="footer">
    <p>© 2025 Khayalethu Residence | All Rights Reserved</p>
    <small>Designed by Your Team Name</small>
  </div>

  <script>
    function fetchRooms() {
      fetch('get_rooms.php?residence=khayalethu')
        .then(res => res.json())
        .then(data => {
          document.getElementById('total').textContent = data.total_available ?? 0;
          document.getElementById('male').textContent = data.male_available ?? 0;
          document.getElementById('female').textContent = data.female_available ?? 0;
          document.getElementById('unavailable').textContent = data.total_unavailable ?? 0;
        })
        .catch(err => console.error('Fetch error:', err));
    }

    document.getElementById('room-booking-form').addEventListener('submit', function(e) {
      e.preventDefault();

      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const type = document.getElementById('room-type').value;
      const residence = 'khayalethu'; // ✅ Fixed

      fetch('book_room.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&type=${type}&residence=${residence}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          alert(`Success! Room reserved until ${data.checkoutDate} (10 AM)`);
          fetchRooms();
        } else {
          alert(data.message || 'Booking failed.');
        }
      })
      .catch(error => {
        console.error('Booking error:', error);
        alert('An error occurred during booking.');
      });
    });

    fetchRooms();
  </script>
</body>
</html>
