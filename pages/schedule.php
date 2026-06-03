<!DOCTYPE html>
<!--
  Name: Amirah Almutairi
  Name: Rana Alzaharni
  Name: Rama Aseeri
  ID: 2205930
  ID: 2206360
  ID: 2206250
  Section: DAR
  Date: 2/4/2026
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule | Lensora Studio</title>
    <link rel="stylesheet" href="../global/main.css">
    <link rel="stylesheet" href="../global/print.css" media="print">
</head>

<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>
<a href="#main-content" class="skip-link">Skip to main content</a>
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Header_nav -->
<?php include '../includes/header_nav.php'; ?>
    <main id="main-content">

        <!-- Page heading -->
        <div class="container text-center mt-4">
            <h1>Book Your Session</h1>
            <p>Select your package, date, and time.</p>
        </div>

        <!-- Selected package -->
        <div class="container text-center mt-2">
            <h2 id="selected-package">Selected Package: —</h2>
        </div>

        <!-- Month selector -->
        <div class="container mt-4 text-center">
            <label for="month-select">Select Month:</label>
            <select id="month-select"></select>
        </div>

        <!-- Booking table -->
<div class="container mt-4">
    <div class="table-responsive print-table-area">
        <table class="booking-table">
            <thead id="table-head"></thead>
            <tbody id="schedule-body"></tbody>
        </table>
    </div>
</div>

        <!-- Booking form -->
        <div class="container" style="max-width:500px; margin-top:40px; margin-bottom:40px;">
            <h2 class="text-center">Complete Booking</h2>

            <form id="booking-form" class="form-panel">
                <div class="form-group">
                    <label for="selected-date">Date</label>
                    <input type="text" id="selected-date" readonly required>
                </div>

                <div class="form-group">
                    <label for="selected-time">Time</label>
                    <input type="text" id="selected-time" readonly required>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Confirm Booking</button>
            </form>
        </div>

    </main>

    <!-- Footer: contact and feedback -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Lensora Studio</h3>
                    <p>Photography and short-form video for people and brands who care about detail.</p>
                </div>

                <div class="footer-section">
                    <h3>Feedback</h3>
                    <p class="footer-feedback"><a href="feedback.html">Client feedback form</a></p>
                </div>

                <div class="footer-section">
                    <h3>Contact</h3>
                    <address class="footer-address">
                        Email: <a href="mailto:info@lensora.com">info@lensora.com</a><br>
                        Phone: <a href="tel:+966500000000">+966 50 000 0000</a><br>
                        Jeddah, Saudi Arabia
                    </address>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Lensora Studio. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const params = new URLSearchParams(window.location.search);
        const pkg = params.get("package");
        if (pkg) {
            document.getElementById("selected-package").textContent =
                "Selected Package: " + pkg.toUpperCase();
        }

        const monthSelect = document.getElementById("month-select");
        const tableHead = document.getElementById("table-head");
        const body = document.getElementById("schedule-body");

        const times = ["10:00 AM","12:00 PM","02:00 PM","04:00 PM","06:00 PM"];

        function initMonths() {
            const now = new Date();
            for (let i = 0; i < 4; i++) {
                const d = new Date(now.getFullYear(), now.getMonth() + i, 1);
                monthSelect.add(new Option(
                    d.toLocaleDateString("en-US", { month: "long", year: "numeric" }),
                    i
                ));
            }
        }

        function render() {
            const now = new Date();
            const offset = parseInt(monthSelect.value);
            const year = now.getFullYear();
            const month = now.getMonth() + offset;

            let dates = [];
            let d = new Date(year, month, 1);

            while (d.getMonth() === (month % 12)) {
                if ([0, 2, 4].includes(d.getDay())) {
                    if (offset === 0 && d < now) {
                        d.setDate(d.getDate() + 1);
                        continue;
                    }
                    dates.push(new Date(d));
                }
                d.setDate(d.getDate() + 1);
            }

            tableHead.innerHTML = `
                <tr>
                    <th>Time</th>
                    ${dates.map(date => `
                        <th>${date.toLocaleDateString("en-US", { weekday: "short" })}<br>${date.getDate()}</th>
                    `).join("")}
                </tr>
            `;

            body.innerHTML = times.map(time => `
                <tr>
                    <td>${time}</td>
                    ${dates.map(date => {
                        const available = Math.random() > 0.4;
                        return `
                            <td class="time-slot-cell ${available ? "available" : "booked"}"
                                data-date="${date.toISOString().split("T")[0]}"
                                data-time="${time}">
                                ${available ? "●" : "✕"}
                            </td>
                        `;
                    }).join("")}
                </tr>
            `).join("");
        }

        document.addEventListener("click", function(e) {
            const cell = e.target.closest(".time-slot-cell.available");
            if (!cell) return;

            document.querySelectorAll(".time-slot-cell.selected")
                .forEach(c => c.classList.remove("selected"));

            cell.classList.add("selected");

            document.getElementById("selected-date").value = cell.dataset.date;
            document.getElementById("selected-time").value = cell.dataset.time;
        });
        document.getElementById("booking-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const packageText = document.getElementById("selected-package")
        .textContent
        .replace("Selected Package: ", "")
        .trim();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const date = document.getElementById("selected-date").value.trim();
    const time = document.getElementById("selected-time").value.trim();

    // 🔴 VALIDATION FIX
    if (!packageText || packageText === "—") {
        alert("Please select a package first!");
        return;
    }

    if (!date || !time || !name || !email) {
        alert("Please fill all fields and select a time slot!");
        return;
    }

    fetch("../api/create-booking.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            package: packageText,
            date: date,
            time: time,
            name: name,
            email: email
        })
    })
    .then(async res => {
        const text = await res.text();
        console.log("RAW RESPONSE:", text);
        return JSON.parse(text);
    })
    .then(data => {

        if (data.status === "success") {
            alert("Booking saved successfully!");

            document.getElementById("booking-form").reset();
            document.getElementById("selected-date").value = "";
            document.getElementById("selected-time").value = "";

        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Server error while saving booking");
    });
});

initMonths();
render();
monthSelect.addEventListener("change", render);
    </script>
</body>
</html>