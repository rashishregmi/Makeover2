
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="logo-bg">
                <div class="logo-girl"></div>
                <span class="logo">Makeover</span>
            </div>
            <ul>
<<<<<<< HEAD:html/login.html
                <li><a href="./../html/Home.html" class="links">Home</a></li>
                <li><a href="./../html/About.html" class="links">About</a></li>
                <li><a href="./../html/Services.html" class="links">Service</a></li>
                <li><a href="./../html/login.html" class="links">Appointment</a></li>
                 
                <li><a href="./../html/login.html" class="links">Login</a></li>
=======
                <li><a href="Home.php" class="links">Home</a></li>
                <li><a href="About.php" class="links">About</a></li>
                <li><a href="Services.php" class="links">Service</a></li>
                <li><a href="Appointment.php" class="links">Appointment</a></li>
                 
                <li><a href="login.php" class="links">Login</a></li>
>>>>>>> 8ca4d71071275f1a27f518df2ed063f20b77999f:login.php
            </ul>
        </nav>
    </header>

    <div class="main-container">
        <div class="wrapper">
            <div class="form-box login">

                <h2>Login</h2>
                <div id="error-message" style="color: red;"></div>
                <form action="./php/login.php" method="POST" id="login-form">
                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="mail"></ion-icon>
                        </span>
                        <input type="email" id="email1" name="email1" required>
                        <label for="email1">Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <input type="password" id="password1" name="password1" required>
                        <label for="password1">Password</label>
                    </div>
                    <button type="submit" class="btn" id="btn1" name="btn1">Login</button>
                    <div class="login-register">
                        <p>Don't have an account?
                            <a href="#" class="register-link">Register</a>
                        </p>
                    </div>
                </form>
            </div>

            <div class="form-box register">
                
                <h2>Registration</h2>
                <div id="error-message2" style="color: red;"></div>

                <form action="./php/signup.php" method="POST" id="register-form">
                    
                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="mail"></ion-icon>
                        </span>
                        <input type="email" id="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <input type="password" id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                     
                    <button type="submit" class="btn" id="btn" name="btn">Register</button>
                    <div class="login-register">
                        <p>Already have an account?
                            <a href="#" class="login-link">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

     

    <script src="./js/login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
