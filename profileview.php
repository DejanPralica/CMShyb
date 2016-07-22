<?php 
session_start();
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}
require_once('includes/config.php');
require_once('includes/header.php');
require_once('includes/nav.php');



$id =  (isset($_GET['id']))  ? 0 +intval($_GET['id']) : 0 + ((isset($_POST['id'])) ? intval($_POST['id']) : 0);


if($id) {

	
	$stmt = $dbObject->prepare('SELECT * FROM users WHERE user_id = :id');

	$stmt->bindValue(':id', $id, PDO::PARAM_INT);
	
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$user_name = $row['user_name'];
	$user_email = $row['user_email'];
	$user_registration_time = $row['user_registration_time'];
	$user_country = $row['user_country'];
	$user_city = $row['user_city'];
	$user_date_of_birth = $row['user_date_of_birth'];
	$user_type = $row['user_type'];

}

?>

<div class="container">   
      <div  class="form">
    		<form id="contactform" action="" method="post"> 
			
    			 <input name="id" type="hidden" value="<?=$id?>">
				 
					<p class="contact"><label>Username</label></p> 
					<input type="text" id="" name="" value="<?php echo $user_name; ?>" tabindex="2" readonly> 
					
					<p class="contact"><label>E-mail</label></p> 
					<input type="text" id="user_email" name="user_email" value="<?php echo $user_email; ?>" readonly> 

					<p class="contact"><label>Registration date</label></p> 
					<input type="date" id="user_reg_time" name="user_reg_time" value="<?php echo $user_registration_time; ?>" readonly> 

					<p class="contact"><label >Country</label></p> 
					<input type="text" id="user_country" name="user_country" value="<?php echo $user_country; ?>" readonly> 

					<p class="contact"><label >City</label></p> 
					<input type="text" id="user_city" name="user_city" value="<?php echo $user_city; ?>" readonly > <br>

					<p class="contact"><label >Date of birth</label></p> 
					<input type="date" id="user_dob" name="user_dob" value="<?php echo $user_date_of_birth; ?>" readonly > <br>

					<p class="contact"><label >User type</label></p> 
					<input type="text" id="user_type" name="user_type" value="<?php echo $user_type; ?>" readonly > <br>	

							
			</form> 
</div>      
</div>

<?php 
require_once('includes/footer.php');
?>

