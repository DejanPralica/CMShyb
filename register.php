<?php 
session_start();
require_once('includes/config.php');
require_once('includes/header.php');
//require_once('includes/nav.php');

if(isset($_POST['submit'])) {
	
	
$user_name = trim($_POST['user_name']);
$user_email =trim($_POST['user_email']);
$user_password =trim($_POST['user_password']);
//$user_registration_time = (isset($_POST['user_reg_time'])) ?  trim($_POST['user_reg_time']) : '';
$user_country =trim($_POST['user_country']);
$user_city =trim($_POST['user_city']);
$user_date_of_birth =trim($_POST['user_dob']);
$user_type = trim($_POST['user_type']);

if((!empty($user_name)) && !empty($user_password)){
 $stmt = $dbObject->prepare("SELECT count(user_name) as num FROM users WHERE user_name =:user_name");
 
    $stmt->bindValue(':user_name', $user_name);
  
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if($row['num'] > 0){
        echo "<h1 style='color: white'>"."Taj korisnik vec postoji!"."</h1>"; 
		} 
		else{
			
			$passwordHash = password_hash($user_password, PASSWORD_DEFAULT);

			$stmt = $dbObject->prepare("INSERT INTO users(user_name,user_password,user_email,user_registration_time,user_country,user_city,user_date_of_birth,user_type) VALUES ( :user_name, :user_password, :user_email,NOW(),:user_country,:user_city,:user_date_of_birth,:user_type )");
				//(user_id, user_name,user_email,user_registration_time,user_country,user_city,user_date_of_birth,user_type)
			$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$stmt->bindValue(':user_password', $passwordHash, PDO::PARAM_STR);
			$stmt->bindValue(':user_email', $user_email, PDO::PARAM_STR);
			//$stmt->bindValue(':user_registration_time', $user_registration_time, PDO::PARAM_STR);
			$stmt->bindValue(':user_country', $user_country, PDO::PARAM_STR);
			$stmt->bindValue(':user_city', $user_city, PDO::PARAM_STR);
			$stmt->bindValue(':user_date_of_birth', $user_date_of_birth, PDO::PARAM_STR);
			$stmt->bindValue(':user_type', $user_type, PDO::PARAM_STR);
			
			$stmt->execute();
			
			$stmt2 = $dbObject->prepare('SELECT * FROM users WHERE user_name=:user_name');
			$stmt2 -> bindValue(':user_name',$user_name,PDO::PARAM_STR);
			
			$stmt2->execute();
			
			$row = $stmt2->fetch(PDO::FETCH_ASSOC);
			
			$_SESSION['username'] = $row['user_name'];
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['bajo_ulogovan'] = true;
			header('Location: index.php');
}
}
}
?>	<div id="page-wrapper">
	  <div class="container">
<form class="form-horizontal" action='' method="POST"> 
    <div id="legend">
      <legend class="">Register</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="user_name">Username</label>
      <div class="controls">
        <input type="text" id="user_name" name="user_name" placeholder="" class="input-xlarge" required>
        <p class="help-block"></p>
      </div>
    </div>
	<div class="control-group">
      <!-- Password-->
      <label class="control-label" for="user_password">Password</label>
      <div class="controls">
        <input type="password" id="user_password" name="user_password" placeholder="" class="input-xlarge" required>
        <p class="help-block"></p>
      </div>
    </div>
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="user_email">E-mail</label>
      <div class="controls">
        <input type="email" id="user_email" name="user_email" placeholder="" class="input-xlarge" required>
        <p class="help-block"></p>
      </div>
    </div>
	<div class="control-group">
      <!-- Country -->
      <label class="control-label" for="user_country">Country</label>
      <div class="controls">
        <input type="text" id="user_country" name="user_country" placeholder="" class="input-xlarge" required>
        <p class="help-block"></p>
      </div>
    </div>
	<div class="control-group">
      <!-- City -->
      <label class="control-label" for="user_city">City</label>
      <div class="controls">
        <input type="text" id="user_city" name="user_city" placeholder="" class="input-xlarge" required>
        <p class="help-block"></p>
      </div>
    </div>
	<div class="control-group">
      <!-- Date of birth -->
      <label class="control-label" for="user_dob">Date of birth</label>
      <div class="controls">
        <input type="date" id="user_dob" name="user_dob" placeholder="" class="input-xlarge" required>
        <p class="help-block"></p>
      </div>
    </div>
	<div class="control-group">
      <!-- User type -->
      <label class="control-label" for="user_type">User type</label>
      <div class="controls">
        <input type="text" id="user_type" name="user_type" placeholder="type USER or ADMIN" class="input-xlarge" required>
        <p class="help-block"></p>
      </div>
    </div>
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
     <button type="submit" class="myButtonSubmit" name="submit"  >Save</button> </br></br>
	  <a href="login.php" class="myButtonIndex" > Return to login </a>
      </div>
    </div>
</form>
</div>
<?php 
require_once('includes/footer.php');
?>	