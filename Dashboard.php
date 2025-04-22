<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Used Cars for Sale</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; text-align: center; position: relative; }
        header { background-color: #007bff; color: white; padding: 20px 0; font-size: 24px; }
        .bookings-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #fff;
            color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            z-index: 20;
        }
        .bookings-btn:hover {
            background-color: #e0e0e0;
        }
        .car-list { display: flex; flex-direction: column; align-items: center; padding: 20px; }
        .car-card { display: flex; align-items: center; background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin: 15px; padding: 15px; width: 80%; cursor: pointer; transition: transform 0.3s ease; }
        .car-card:hover { transform: scale(1.02); }
        .car-card img { width: 200px; height: 150px; border-radius: 10px; margin-right: 20px; }
        .car-details { text-align: left; flex-grow: 1; }
        .car-details h2 { font-size: 20px; margin: 5px 0; color: #333; }
        .car-details p { font-size: 16px; margin: 5px 0; color: #555; }
        .separator { width: 80%; height: 1px; background-color: #ccc; margin: 10px 0; }
    </style>
</head>
<body>
    <button class="bookings-btn" onclick="window.location.href='bookings.php'">Bookings</button>
    <header>
        <h1>Used Cars for Sale</h1>
    </header>

    <main>
        <div class="car-list" id="carContainer"></div>
    </main>

    <script>
        // Updated car list with car_id matching cars_details table
        const cars = [
            { car_id: 1, title: "Honda City 2018", price: "₹6,50,000", km: "50,000 km", year: "2018", owner: "1st", fuel: "Petrol", img: "city1.jpg" },
            { car_id: 2, title: "Maruti Swift 2020", price: "₹5,80,000", km: "30,000 km", year: "2020", owner: "1st", fuel: "Petrol", img: "swift.jpg" },
            { car_id: 3, title: "Hyundai Creta 2019", price: "₹10,00,000", km: "40,000 km", year: "2019", owner: "1st", fuel: "Diesel", img: "creta.jpg" },
            { car_id: 4, title: "Toyota Innova 2017", price: "₹12,50,000", km: "60,000 km", year: "2017", owner: "2nd", fuel: "Diesel", img: "innova.jpg" },
            { car_id: 5, title: "Ford EcoSport 2019", price: "₹8,20,000", km: "35,000 km", year: "2019", owner: "1st", fuel: "Petrol", img: "ecosport.jpg" },
            { car_id: 6, title: "Volkswagen Polo 2021", price: "₹7,10,000", km: "20,000 km", year: "2021", owner: "1st", fuel: "Petrol", img: "polo.jpg" },
            { car_id: 7, title: "Kia Seltos 2020", price: "₹14,50,000", km: "25,000 km", year: "2020", owner: "1st", fuel: "Diesel", img: "selto1.jpg" },
            { car_id: 8, title: "Renault Duster 2021", price: "₹8,00,000", km: "15,000 km", year: "2021", owner: "1st", fuel: "Petrol", img: "du.jpg" },
            { car_id: 9, title: "Volkswagen Polo White 2018", price: "₹6,75,000", km: "55,000 km", year: "2018", owner: "2nd", fuel: "Petrol", img: "polo.jpg" },
            { car_id: 10, title: "Audi A4 2019", price: "₹13,00,000", km: "40,000 km", year: "2019", owner: "1st", fuel: "Diesel", img: "Audi A4.jpg" }
        ];

        function renderCars() {
            const container = document.getElementById("carContainer");
            cars.forEach(car => {
                const carDiv = document.createElement("div");
                carDiv.className = "car-card";
                carDiv.onclick = () => redirectToDetails(car.car_id);
                carDiv.innerHTML = `
                    <img src="${car.img}" alt="${car.title}">
                    <div class="car-details">
                        <h2>${car.title}</h2>
                        <p>Price: ${car.price}</p>
                        <p>Kilometers: ${car.km}</p>
                        <p>Year: ${car.year}</p>
                        <p>Owner: ${car.owner}</p>
                        <p>Fuel: ${car.fuel}</p>
                    </div>
                `;
                container.appendChild(carDiv);
                container.appendChild(document.createElement("div")).className = "separator";
            });
        }

        function redirectToDetails(car_id) {
            const car = cars.find(c => c.car_id === car_id);
            const queryString = `?car_id=${encodeURIComponent(car.car_id)}&title=${encodeURIComponent(car.title)}&price=${encodeURIComponent(car.price)}&km=${encodeURIComponent(car.km)}&year=${encodeURIComponent(car.year)}&owner=${encodeURIComponent(car.owner)}&fuel=${encodeURIComponent(car.fuel)}&img=${encodeURIComponent(car.img)}`;
            window.location.href = `car-details.php${queryString}`;
        }

        renderCars();
    </script>
</body>
</html>