<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Basic PHP and MySQL application using PHP Data Object and Bootstarp 4">
    <meta name="author" content="Sok Kimsoeurn">
    <link rel="icon" href="images/favicon.png">

    <title>Products Admin page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
    <!-- Start Navabar-->
    <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../accountadminprivato.php"><i class="fa fa-code">Register </i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
  
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../logout.php">Logout <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Hero Image -->
    <div class="hero-image">
        <div class="hero-text">
            <h1>Admin Page</h1>
            <p>Add/Edit/delete products</p>
            <button onclick="location.href='../home.php'" class="btn btn-danger btn-lg"><i class="fa fa-book"></i> Libriperera Home</button>
        </div>
    </div>
    <!-- End Hero Image -->