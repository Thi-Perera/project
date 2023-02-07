<?php
// sessione per entrare come un utente unico.
session_start();
if (!isset($_SESSION['loggato3']) || $_SESSION['loggato3'] !== true) {
	 header("location: account-page.html");
	 exit;
}
else{

}


?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Account page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

	</head>
	<body>

        <div class="container">
            <div class="navbar2">
                <div class="col">
					<a class="navbar-brand" href="home.php">Libri Perera<span>Books - Comics - Gadjets</span></a>
				</div>
                <nav>
                    <ul id="MenuItems">

                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
>
                    </ul>
                </nav>
            </div>
        </div>


	<!---account page--->
    <div class="account-page">
        <div class="container">
            <div class="row">
                
                <div class="col-2">
                  <div class="form-container">
                    <div class="form-btn">
                        <span onclick="login()">Login</span>
                        <span onclick="register()">Register</span>
                        <hr id="Indicator">
                    </div>
                    
                    <form id="LoginForm" action="login.php" method="POST">
                        <input type="text" name="username" id="username" placeholder="Username" required>
                        <input type="password"  name="password"  id="password" placeholder="Password" required>
                        
                        <button type="submit" class="btn">Login</button>
                        <a href="">Recupera password</a>
                    </form>

                    <form id="RegForm" action="registeradmin.php" method="POST">
                        <input type="text" name="username" id="username" placeholder="Username" required>
                        <input type="email" name="email" id="email" placeholder="Email" required>
                        <input type="password"  name="password"  id="password" placeholder="Password" required>

                        <button type="submit" class="btn">Register</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    

    

    <!---js for toggle form-->
    <script>

    var LoginForm = document.getElementById("LoginForm");
    var RegForm = document.getElementById("RegForm");
    var Indicator = document.getElementById("Indicator");

        function login(){

            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        }
        function register(){

            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";
}
    </script>

    </body>
    
    </html>

 