<!DOCTYPE html>
<html lang="en">
<script src="scripts/loginPopUp.js"></script>
    <?php
        session_start();
        include('scripts/timeClashAlert.php');
        include('scripts/badLogin.php');
        include('scripts/formLoginDefault.php');
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Hammersmith+One&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"/>
    <link rel="H" href="services.html">
    <title>Turquoise Dental Services</title>
    <div>
    <?php
        if (isset($_COOKIE['loggedInCookie'])){
        $loggedIn = $_COOKIE['loggedInCookie'];
        } else {
            $loggedIn = 0;
        }
        ?>
    </div>
</head>
<body class="body1">
    <!--This is navbar-->
    <nav class="navbar">
        <ul>
            <li class="Logo"><a href="index.php">Turquoise</a></li>
        </ul>
        <ul class="nav-right">
            <li class="nav-right2"><a href="index.php">Home</a></li>
            <li class="nav-right2"><a href="#about">Services</a></li>
            <li><?php if ($loggedIn == 0) {
                    // User is not logged in
                    echo '<button onclick="showLoginPopup()" id="loginButton" class="login-button" >Login</button>';
                } else {
                    // User is logged in
                    echo '<button onclick="logoutAndReload()" id="logoutButton" class="login-button" >Logout</button>';
                }
        ?></li>
            <!--<li><a href="#" class="login-button">Log In</a></li> -->
        </ul>
    </nav>
    <!--This is content-->
    <div class="services">
        <div class="container1">
            <h1>Discover a New Era of Dental Care:</h1>
            <p>One Click at a Time: Book Your Appointment Today</p>

        </div>
        <div class="container2">
            <h4>Appointment Form</h4>
            <br><br>
            <form action="scripts/timeClashCheck.php" method="POST" onsubmit="return validateForm()">
                <label id="name1" for="name">Name:</label><br>
                <input type="text" id="name" name="name" placeholder="Your name" value="<?php echo htmlspecialchars($formName) ?>" required><br><br>
                
                <label id="name1"for="phone">Phone:</label><br>
                <input type="tel" id="phone" name="phone" placeholder="Your phone number"value="<?php echo htmlspecialchars($formPhone) ?>" required><br><br>
                
                <label id="name1"for="email">Email:</label><br>
                <input type="email" id="email" name="email" placeholder="Your email"value="<?php echo htmlspecialchars($formEmail) ?>" required><br><br>

                <label id="name1"for="dentist">Dentist:</label><br>
                <select id="dentist" name="dentist" required></select>

                <div id="dentist-availability"></div><br>

                <label id="name1"for="date">Appointment Date:</label><br>
                <input type="date" id="date" name="date" required><br><br>
                
                <label id="name1" for="time">Appointment Time:</label><br>
                <input type="time" id="time" name="time" required><br><br>
                
                <label id="name1" for="details">Details:</label><br>
                <textarea id="details" name="details"></textarea><br><br>
                
                <input id="book1"type="submit" value="Book Now">
            </form>
        </div>
    </div>
    <div id="login-popup">
            <form id="login-form" action="scripts/login.php" method="POST" style="background-color: white ; border-radius : 16px">
                <p> Log In </p>
                <p class="login-text">Name</p>
                <input type="text" placeholder="Name" name="loginName" required>
                <p class="login-text">Password</p>
                <input type="password" placeholder="Password" name="loginPassword" required>
                <input type="hidden" name="page" value="1"><br>
                <input type="submit" value="Login">
                <button onclick="hideLoginShowRegistration()" class="button_register">Register</button><br>
                <button onclick="hideLoginPopup()" class="button_close">Close</button>
            </form>
        </div>

        <div id="register-popup">
            <form id="register-form" action="scripts/register.php" method="POST">
                <p>Register</p>
                <p class="register-text">Name</p>
                <input type="text"  placeholder="Name" name="regName"required>
                <p class="register-text">Password</p>
                <input type="password"  placeholder="Password" name="regPassword" required>
                <p class="register-text">Phone Number</p>
                <input type="tel"  placeholder="Phone Number" name="regPhone" required>
                <p class="register-text">Email</p>
                <input type="email"  placeholder="Email" name="regEmail" required>
                <input type="hidden" name="page" value="1">
                <input type="submit" value="Register"><br>
                <button class="button_close" onclick="hideRegistrationPopup()">Close</button>
            </form>
        </div>
<div class="bookTable">
    <?php
    if ($loggedIn == 1){
        include('scripts/existingBookings.php');
    }
    ?>
</div>
<script>
        const dentistSelect = document.getElementById("dentist");
        const dateInput = document.getElementById("date");
        const submitButton = document.getElementById("submitButton");
        const dentistAvailability = document.getElementById("dentist-availability");

        // Load dentists from XML file
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "scripts/dentists.xml", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const xml = xhr.responseXML;
                const dentists = xml.getElementsByTagName("dentist");
                
                for (let i = 0; i < dentists.length; i++) {
                    const name = dentists[i].getElementsByTagName("name")[0].textContent;
                    const availableDays = dentists[i].getElementsByTagName("availableDays")[0].textContent;
                    
                    const option = document.createElement("option");
                    option.value = name;
                    option.dataset.availableDays = availableDays;
                    option.textContent = name;
                    dentistSelect.appendChild(option);
                }
                updateAvailability();
            }
        };
        xhr.send();

        dentistSelect.addEventListener("change", updateAvailability);
        dateInput.addEventListener("change", updateAvailability);

        function updateAvailability() {
            const selectedDentist = dentistSelect.value;
            const availableDays = dentistSelect.options[dentistSelect.selectedIndex].dataset.availableDays.split(",").map(Number);

            dentistAvailability.textContent = `Available days for ${selectedDentist}: ${getWeekdays(availableDays)}`;
        }

        function getWeekdays(days) {
            const weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            return days.map(day => weekdays[day]).join(", ");
        }

        dentistSelect.addEventListener("change", checkAvailability);
        dateInput.addEventListener("change", checkAvailability);

        function checkAvailability() {
            const selectedDentist = dentistSelect.value;
            const selectedDate = new Date(dateInput.value);
            const availableDays = dentistSelect.options[dentistSelect.selectedIndex].dataset.availableDays.split(",").map(Number);

            const selectedDay = selectedDate.getDay(); // Sunday is 0, Monday is 1, and so on.

            if (availableDays.includes(selectedDay)) {
                submitButton.disabled = false; // Enable form submission
            } else if (dateInput.value !== "") {
                const message = `${selectedDentist} is not available on ${selectedDate.toDateString()}`;
                alert(message);
                dateInput.value = ""; // Clear selected date
                submitButton.disabled = true; // Disable form submission
            }
        }

        function logoutAndReload() {
            // Delete the loggedInCookie
            document.cookie = "loggedInCookie=0; expires=" + new Date((new Date()).getTime() + 3600 * 1000).toUTCString() + "; path=/";
            document.cookie = "loginId=0; expires=" + new Date((new Date()).getTime() + 3600 * 1000).toUTCString() + "; path=/";
            document.cookie = "loginAdmin=0; expires=" + new Date((new Date()).getTime() + 3600 * 1000).toUTCString() + "; path=/";

            // Clear the form default values
            document.getElementById("name").value = "";
            document.getElementById("phone").value = "";
            document.getElementById("email").value = "";

            location.reload(); // Reload the page
        }
        function validateForm() {
            // Get the values entered by the user
            var nameInput = document.getElementById("name").value;
            var phoneInput = document.getElementById("phone").value;
            var emailInput = document.getElementById("email").value;
            var dentistInput = document.getElementById("dentist").value;
            var dateInput = document.getElementById("date").value;
            var timeInput = document.getElementById("time").value;
            var detailsInput = document.getElementById("details").value;

            // Perform validation checks
            if (nameInput === "") {
            alert("Please enter your name.");
            return false; // Prevent form submission
            }

            if (phoneInput === "") {
            alert("Please enter your phone number.");
            return false; // Prevent form submission
            }

            if (emailInput === "") {
            alert("Please enter your email.");
            return false; // Prevent form submission
            }

            if (dentistInput === "") {
            alert("Please select a dentist.");
            return false; // Prevent form submission
            }

            if (dateInput === "") {
            alert("Please select an appointment date.");
            return false; // Prevent form submission
            }

            if (timeInput === "") {
            alert("Please select an appointment time.");
            return false; // Prevent form submission
            }

            // Additional validation checks for each input
            // ...

            // If all checks pass, allow form submission
            return true;
        }
    </script>
    <!--This is Footer-->
    <footer>
        <div class="footer-section">
            <div class="left-footer">
                <h2 class="Logo">Turquoise</h2>
                <a href="#"><img href="https://www.example.com" src="images/instagram.png" alt="ig"style="width: 40px; height: 40px;"></a>
                <a href="#"><img href="https://www.example.com" src="images/facebook.png" alt="facebook" style="width: 40px; height: 40px; margin-left: 10px;"></a>
                <a href="#"><img href="https://www.example.com" src="images/mail.png" alt="email" style="width: 40px; height: 40px; margin-left: 10px;"></a>
            </div>

            <div class="right-footer">
                <h2 class="Logo">Contact Us</h2>
                <p>turquoise.appointment@gmail.com</p>
                <p>https://turquoise.appointment.com</p>
                <p>+60139745285</p>
            </div>
        </div>
    </footer>
</body>
</html>