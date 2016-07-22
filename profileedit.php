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
$user_name = (isset($_POST['user_name'])) ?  trim($_POST['user_name']) : '';
$user_email = (isset($_POST['user_email'])) ?  trim($_POST['user_email']) : '';
$user_password = (isset($_POST['user_password1'])) ?  trim($_POST['user_password1']) : '';
$user_registration_time = (isset($_POST['user_reg_time'])) ?  trim($_POST['user_reg_time']) : '';
$user_country = (isset($_POST['user_country'])) ?  trim($_POST['user_country']) : '';
$user_city = (isset($_POST['user_city'])) ?  trim($_POST['user_city']) : '';
$user_date_of_birth = (isset($_POST['user_dob'])) ?  trim($_POST['user_dob']) : '';
$user_type = (isset($_POST['user_type'])) ?  trim($_POST['user_type']) : '';

if($id) 
{

	if(isset($_POST)) {
		if((isset($_POST['user_password1'])) && (isset($_POST['user_password2']))){
		if($_POST['user_password1']==$_POST['user_password2'])
		{
		
			if($user_name != '' &&  $id !=0 ) {
				
				$passwordHash = password_hash($user_password, PASSWORD_DEFAULT);
				
				$stmt = $dbObject->prepare("UPDATE users SET user_name=?, user_password=?, user_email=?, user_registration_time=?, user_country=?, user_city=?, user_date_of_birth=?, user_type=? WHERE user_id=?");
				$stmt->execute(array($user_name, $passwordHash, $user_email, $user_registration_time, $user_country, $user_city, $user_date_of_birth, $user_type,  $id));
			}
		} 
		else
		{
			//echo "Sifre nisu jednake!!";
			?>
		<div style="margin-left:40%; color:red">
		<h4>Sifre nisu jednake!!</h4>
		</div>
		<?php
			
		}
		//echo "Podaci uspjesno promjenjeni!!";
		?>
		<div style="margin-left:40%; color:green">
		<h4>Podaci uspjesno promjenjeni!!</h4>
		</div>
		<?php
	}	
	}

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
					<input type="text" id="user_name" name="user_name" value="<?php echo $user_name; ?>" tabindex="2" required> 
					
					<p class="contact"><label>New password</label></p> 
					<input type="password" id="user_password1" name="user_password1" value="" tabindex="2" > 
					
					<p class="contact"><label>retype new password</label></p> 
					<input type="password" id="user_password2" name="user_password2" value="" tabindex="2" > 

					<p class="contact"><label>E-mail</label></p> 
					<input type="text" id="user_email" name="user_email" value="<?php echo $user_email; ?>" > 

					<p class="contact"><label>Registration date</label></p> 
					<input type="date" id="user_reg_time" name="user_reg_time" value="<?php echo $user_registration_time; ?>"> 

					<p class="contact"><label >Country</label></p> 
					<input type="text" id="user_country" name="user_country" value="<?php echo $user_country; ?>"> 

					<p class="contact"><label >City</label></p> 
					<input type="text" id="user_city" name="user_city" value="<?php echo $user_city; ?>"  > <br>

					<p class="contact"><label >Date of birth</label></p> 
					<input type="date" id="user_dob" name="user_dob" value="<?php echo $user_date_of_birth; ?>"  > <br>

					<p class="contact"><label >User type</label></p> 
					<input type="text" id="user_type" name="user_type" value="<?php echo $user_type; ?>"  > <br>	

				
				<button type="submit" class="myButtonSubmit" name="submit"  >Save</button>	 </br></br>
				<a href="index.php" class="myButtonReturn"> Index </a>				
			</form> 
</div>      
</div>

<?php 
require_once('includes/footer.php');
?>

