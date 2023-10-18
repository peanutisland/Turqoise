<!DOCTYPE html>
<html>
<script src="scripts/loginPopUp.js"></script>
    <?php
        include('scripts/sessionStart.php');
        include('scripts/databaseSetUp.php');
        include('scripts/badLogin.php');
        include('scripts/formLoginDefault.php');
        if (isset($_COOKIE['loggedInCookie'])){
            $loggedIn = $_COOKIE['loggedInCookie'];
            } else {
                $loggedIn = 0;
            }
            
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Hammersmith+One&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"/>
        <link href="./css/main.css" rel="stylesheet"/>
        <link rel="Services" href="services.php">
        <title>Turquoise Dental Services</title>
        
    </head>
    
    <body class="body2">
        <!--This is navbar-->
        <nav class="navbar">
            <ul>
                <li class="Logo"><a href="#home">Turquoise</a></li>
            </ul>
            <ul class="nav-right">
                <li class="nav-right2"><a href="#">Home</a></li>
                <li class="nav-right2"><a href="services.php">Services</a></li>
                <li>
                    <?php if ($loggedIn == 0) {
                    // User is not logged in
                    echo '<button onclick="showLoginPopup()" id="loginButton" class="login-button" >Login</button>';
                } else {
                    // User is logged in
                    echo '<button onclick="logoutAndReload()" id="logoutButton" class="login-button" >Logout</button>';
                }
                ?>      
                </li>
            </ul>
          </nav>
        <!--This is hero-->
        <div class="hero">
            <div>
                <img src="images/Doctor 1.png" class="doctor1">
            </div>
            <div class="hero-text">
                <h1>ACHIEVE A BRIGHT AND HEALTHY SMILE TODAY!</h1>
                <p>At Turquoise Dental Centre, we are committed to providing exceptional dental care in a warm and friendly environment. Our experienced team of professionals is dedicated to helping you achieve optimal oral health and a beautiful smile.</p>
                <button class="button-top" onclick="window.location.href ='services.php'">Book Now</button>
            </div>
         </div>

         <!--This is about us-->
        <div class="about">
        <h1 class="titleAboutus">WHAT THEY SAID ABOUT US</h1>
         
            <div class="aboutus">
                
                <div class="card">
                    <div class="card-image">
                        <img src="images/Person A.png" alt="Profile image" style="width: 250px; height: 250px;">
                    </div>
                    <p class="name">I'm so grateful for Dr Jane. They made me feel at ease, and the personalized treatment was exceptional. I no longer dread going to the dentist!</p>
                </div>

                <div class="card2">
                    <div class="card-image">
                        <img src="images/Person B.png" alt="Profile image" style="width: 250px; height: 250px;">
                    </div>
                    <p class="name">Dr Mark transformed my smile! The team was professional, kind, and the results exceeded my expectations. Thank you!</p>
                </div>

                <div class="card3">
                    <div class="card-image">
                        <img src="images/Person C.png" alt="Profile image" style="width: 250px; height: 250px;">
                    </div>
                    <p class="name">Dr John is the best! They understood my dental anxiety and made me feel comfortable throughout. Trustworthy and highly recommended!</p>
                </div>
            </div>
        </div>

         <!--This is our services-->
            <div class="ourservices">
                <h1 class="ourservices1">OUR SERVICES</h1>
                <div class="column1">
                    <div class="row1">
                        <div class="isi1">
                            <img src="images/Checkup.png" style="width: 150px; height: 150px;" >
                        </div>
                        <div class="isi2">
                            <h2>Dental Check Up</h2>
                            <p>Essential for maintaining good oral health. During these visits, the dentist examines your teeth and gums, checks for any signs of dental issues, and provides preventive care, such as dental cleanings.</p>
                        </div>
                    </div>
                    <div class="row2">
                        <div class="isi3">
                            <img src="images/Whitening.png" style="width: 150px; height: 150px;" >
                        </div>
                        <div class="isi4">
                            <h2>Teeth Whitening</h2>
                            <p>Enhance the appearance of your smile. Professional teeth whitening procedures can effectively remove stains and discoloration, giving you a brighter smile.</p>
                        </div>
                    </div>
                </div>
                <div class="column2">
                    <div class="row3">
                        <div class="isi5">
                            <img src="images/Surgery.png" style="width: 150px; height: 150px;" >
                        </div>
                        <div class="isi6">
                            <h2>Dental Surgery</h2>
                            <p>Essential for maintaining good oral health. During these visits, the dentist examines your teeth and gums, checks for any signs of dental issues, and provides preventive care, such as dental cleanings.</p>
                        </div>
                    </div>
                    <div class="row4">
                        <div class="isi7">
                            <img src="images/Consultation.png" style="width: 150px; height: 150px;" >
                        </div>
                        <div class="isi8">
                            <h2>Got Questions?</h2>
                            <p>Enhance the appearance of your smile. Professional teeth whitening procedures can effectively remove stains and discoloration, giving you a brighter smile.</p>
                            <a href = "services.php" class="button-bottom">Book Here</a>
                        </div>
                    </div>
                </div>
            </div>

        <!--This is our specialist-->
        <div class="specialist">
            <h1 class="ourspecialist">OUR SPECIALIST</h1>
                <div class="column3">
                    <div class="row5">
                        <img src="images/Doctor 2.png" alt="" class="doctors">
                        <h2>Dr Mark</h2>
                        <p>Oral Pathologists</p>
                    </div>
                    <div class="row6">
                        <img src="images/Doctor 3.png" alt="" class="doctors">
                        <h2>Dr John</h2>
                        <p>Orthodontist</p>
                    </div>
                    <div class="row7">
                        <img src="images/Doctor 4.png" alt="" class="doctors">
                        <h2>Dr Jane</h2>
                        <p>Prosthodontist</p>
                    </div>
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
        <div>
            <script>
                function logoutAndReload() {
            // Delete the loggedInCookie
            document.cookie = "loggedInCookie=0; expires=" + new Date((new Date()).getTime() + 3600 * 1000).toUTCString() + "; path=/";
            document.cookie = "loginId=0; expires=" + new Date((new Date()).getTime() + 3600 * 1000).toUTCString() + "; path=/";
            document.cookie = "loginAdmin=0; expires=" + new Date((new Date()).getTime() + 3600 * 1000).toUTCString() + "; path=/";

            location.reload(); // Reload the page
        }
            </script>
        </div>
        
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