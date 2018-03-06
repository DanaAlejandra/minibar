<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modulo MiniBar</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
    <!-- bootstrap theme-->
    <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="main.css"> 
</head>

<style type="text/css">

.img {
  height: 120px; 
  width: 120px; 
  display: block;
}

</style>
<body>
<div class="container">
        <div class="card card-container">
             <img id="profile-img img" class="" src="img/logohotel.jpg"/>
            <p id="profile-name" class="profile-name-card"></p>
             <form class="form-signin" method="post" action="validar_login.php">          
                <input type="text" id="user" name="user" class="form-control" placeholder="Usuario"  required autofocus>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Clave" required>
                <button id="go" class="btn btn-lg btn-primary btn-block btn-signin " type="submit">Login</button>
            </form> <!-- /form -->
        </div> <!-- /card-container -->
    </div> <!-- /container -->
</body>

</html>