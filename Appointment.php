<?php
include('../connection.php');
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="./../css/appoint.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div class="logo-bg">
                <div class="logo-girl"></div>
                <span class="logo">
                    Makeover
                </span>
            </div>
            <ul>
                <li><a href="../Home.php" class="links">Home</a></li>
                <li><a href="../About.php" class="links">About</a></li>
                <li><a href="../Services.php" class="links">Service</a></li>
                <li><a href="../Appointment.php" class="links">Appointment</a></li>
                 
                <li><a href="../login.php" class="links" id="logout-link3" class="logoutc" style="padding-right: 32px;" >Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="heading-container">
        <h1 class="common-heading">Appointment</h1>
    </div>

    <main class="main-container">
        <div class="appointment-container">
            <h2>Book your Appointment</h2>

            <form id="appointment-form" action="../php/submit_appointment.php" method="post">



 
                <div class="form-row">

                    <input type="text" id="firstname" class="input-field" placeholder="First Name" name="firstname" required>

                    <div class="form-group">

                        <input type="text" id="lastname" class="input-field" placeholder="Last Name" name="lastname" required>
                    </div>

                </div>
 
                <div class="contact">
                    <input type="tel" id="contact" class="input-field contact-input" placeholder="Contact Number" name="contact" pattern="[9][87]\d{8}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>

               


                <div class="check-row-container">

                 <div>
                    <ul class="check-row">

                        <li>
                            <input type="checkbox" id="haircut" name="topics[]" value="Haircut">
                            <label for="haircut">Haircut</label>
                        </li>

                        <li>
                            <input type="checkbox" id="hair-colouring" name="topics[]" value="Hair Colouring">
                            <label for="hair-colouring">Hair Colouring</label>
                        </li>

                        <li>
                            <input type="checkbox" id="smoothening" name="topics[]" value="Smoothening">
                            <label for="smoothening">Smoothening</label>
                        </li>

                    </ul>

                 </div>
                 <ul class="check-row">
                    <li>
                        <input type="checkbox" id="threading" name="topics[]" value="Threading">
                        <label for="threading">Threading</label>
                    </li>

                    <li>
                        <input type="checkbox" id="bridal-makeup" name="topics[]" value="Bridal Makeup">
                        <label for="bridal-makeup">Bridal Makeup</label>

                    </li>


                    <li>
                        <input type="checkbox" id="skin-therapy" name="topics[]" value="Skin Therapy">
                        <label for="skin-therapy">Skin Therapy</label>
                    </li>

                </ul>

                 <div>
<ul class="check-row">
                            <li>
                        <input type="checkbox" id="nail-extension" name="topics[]" value="Nail Extension">
                        <label for="nail-extension">Nail Extension</label>
                    </li>

            
                    <li>
                        <input type="checkbox" id="manicure-pedicure" name="topics[]" value="Manicure and Pedicure">
                        <label for="manicure-pedicure">Manicure and Pedicure</label>
                    </li>

                    </ul>
                 </div>

                </div>
                <div class="timeflex">
                
                
                <div class="calendar-container">
                 
                    <input type="date" name="myCalender" id="myCalender" value="">
                </div>
                
                
                <div class="time-container">
                    <input type="time" name="myDate" id="timeInput" value="" min="10:00" max="18:00" required>
                </div>

                <button type="submit" id="bookButton" class="btn">Book Appointment</button>
            </div>
                
                
            </form>
        </div> 
    </main>



    <div class="footer-container">
        <footer>
            <div class="box-container">

                <div class="box1">
                    <div class="box1-heading">
                        MAKEOVER
                    </div>


                    <div class="box1-info">

                        Manigram,Tilottama-5, Nepal <br>
                        Phone: 9811592861, 9826479062 <br>
                        Email: <a class="gmail"
                            href="mailto:rashish.regmi100@gmail.com">rashish.regmi100@gmail.com</a><br> <br>

                    </div>

                    <div class="box1-heading">
                        OPENING HOUR
                    </div>


                    <div class="box1-info">
                        Sunday-Saturday: 10AM-7PM

                    </div>
                </div>


                <div class="box2">
                    <span class="box2-heading">
                        FOLLOW-US
                    </span>

                    <div class="social-media">
                        <ul>
                            <li><a href="https://www.facebook.com/rashish.regmi" target="_blank"><img class="fb"
                                        src="./../images/Facebook-logo.png" alt="Facebook" style="height: 2rem;
                         width: 1.9rem;"></a></li>
                            <li><a href="https://www.instagram.com/regmirashish" target="_blank"><img
                                        src="./../images/logo-instagram.png" alt="Instagram"
                                        style="height: 2.2rem; position: relative; bottom: 0.1rem;"></a></li>
                            <li><a href="https://twitter.com/rashishregmi" target="_blank"><img
                                        src="./../images/logo-twitter.png" alt="Twitter"></a></li>
                            <li><a href="https://www.linkedin.com/in/rashish-regmi-09925724a/" target="_blank"><img
                                        src="./../images/linkedin-logo.png" alt="LinkedIn"></a></li>
                        </ul>
                    </div>
                    <div class="copyright">&copy; 2023 Makeover.com</div>
                </div>
        </footer>
    </div>
    <script src="../js/appoint.js"></script>
</body>

</html>