<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Car Details</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f8f9fa; text-align: center; }
    header { background-color: #007bff; color: white; padding: 20px; }
    .car-details, .booking-form { background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin: 20px auto; padding: 20px; width: 90%; max-width: 500px; }
    input, button { padding: 10px; margin-top: 10px; width: 100%; border-radius: 5px; border: 1px solid #ccc; }
    button { background-color: #007bff; color: white; cursor: pointer; }
    button:hover { background-color: #0056b3; }
    img { width: 100%; border-radius: 10px; }
  </style>
</head>
<body>

<header><h1>Car Details</h1></header>

<div class="car-details">
  <img id="car-img" src="" alt="Car Image">
  <h2 id="car-title"></h2>
  <p><strong>Price:</strong> <span id="car-price"></span></p>
  <p><strong>Kilometers:</strong> <span id="car-km"></span></p>
  <p><strong>Year:</strong> <span id="car-year"></span></p>
  <p><strong>Owner:</strong> <span id="car-owner"></span></p>
  <p><strong>Fuel:</strong> <span id="car-fuel"></span></p>
  <p><strong>Location:</strong> GoCars, Manna Junction Near SBI Bank, Thaliparamba, Kannur</p>
  <p><strong>Contact No:</strong> 9207426213</p>
</div>

<div class="booking-form">
  <form action="car-details_process.php" method="POST" id="booking-form">
    <input type="hidden" name="car_id" id="form-car-id">
    <label for="date">Preferred Date</label>
    <input type="date" name="preferred_date" id="date" required>
    <label for="phone">Contact Number</label>
    <input type="tel" name="contact_number" id="phone" placeholder="Enter your phone number" required>
    <button type="submit">Book Your Test Drive</button>
  </form>
</div>

<script>
  const params = new URLSearchParams(window.location.search);
  const carId = params.get("car_id");

  if (!carId) {
    alert("Error: No car selected. Please select a car from the dashboard.");
    window.location.href = "dashboard.php";
  } else {
    document.getElementById("car-title").textContent = params.get("title");
    document.getElementById("car-price").textContent = params.get("price");
    document.getElementById("car-km").textContent = params.get("km");
    document.getElementById("car-year").textContent = params.get("year");
    document.getElementById("car-owner").textContent = params.get("owner");
    document.getElementById("car-fuel").textContent = params.get("fuel");
    document.getElementById("car-img").src = params.get("img");
    document.getElementById("form-car-id").value = carId;
  }

  // Set min date to tomorrow
  const dateInput = document.getElementById("date");
  const today = new Date();
  const tomorrow = new Date(today);
  tomorrow.setDate(tomorrow.getDate() + 1);
  const formattedTomorrow = tomorrow.toISOString().split('T')[0];
  dateInput.min = formattedTomorrow;

  // Validate date on form submission
  const form = document.getElementById("booking-form");
  form.addEventListener("submit", function(event) {
    const selectedDate = new Date(dateInput.value);
    const selectedDateOnly = selectedDate.setHours(0, 0, 0, 0);
    const minDateOnly = tomorrow.setHours(0, 0, 0, 0);

    if (selectedDateOnly < minDateOnly) {
      event.preventDefault();
      alert("Please select a date starting from tomorrow. Today and past dates are not allowed.");
    }
  });
</script>

</body>
</html>
