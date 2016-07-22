<?php
session_start();
require_once('includes/config.php');
require_once('includes/header.php');
require_once('includes/nav.php');
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}

$nameErr = $lnameErr= $emailErr =$messageErr = "";
$name = $lname =$email = $message= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["name"])) {
    $nameErr = "Unesite ime";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Samo slova su dozvoljena za unos";
    }
  }
  
  if (empty($_POST["lname"])) {
    $lnameErr = "Unesite prezime";
  } else {
    $lname = test_input($_POST["lname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lnameErr = "Samo slova su dozvoljena za unos";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Unesite email";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Email adresa nije validna";
    }
  }
    
  if (empty($_POST["message"])) {
    $messageErr = "Unesite poruku";
  } else {
    $comment = test_input($_POST["message"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!--

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Kontakt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>

-->

<style>
.error {color: #FF0000;}
</style>
<body>

<div class="container">

<div class="page-header">
    <h1>Kontakt forma</h1>
</div>



<!-- Contact Form - START -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                
                <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                    <fieldset>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="fname" name="name" type="text" placeholder="Vaše ime" class="form-control"  value="<?php echo $name;?>">
                                 <span class="error"> <?php echo $nameErr; ?></span>
							
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="lname" name="lname" type="text" placeholder="Vaše  prezime" class="form-control" value="<?php echo $lname;?>">
                                 <span class="error"> <?php echo $lnameErr; ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="Email adresa " class="form-control" value="<?php echo $email;?>">
                                 <span class="error"> <?php echo $emailErr;?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <textarea class="form-control" id="message" name="message" placeholder="Unesite vašu poruku" rows="7">
                                  <?php if (isset($_POST["message"])) {
                                      echo htmlentities ($_POST['message']); }?>
                                </textarea>
                                <span class="error"> <?php echo $messageErr;?></span>
                             
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">Pošalji</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .header {
        color: #36A0FF;
        font-size: 27px;
        padding: 10px;
    }

    .bigicon {
        font-size: 35px;
        color: #36A0FF;
    }
</style>

<!-- Contact Form - END -->

</div>

<!--
</body>
</html>
-->
<?php 
require_once('includes/footer.php');
?>