<?php 
session_start();
require_once('includes/config.php');
require_once('includes/header.php');
//require_once('includes/nav.php');




	if(isset($_POST['username']) && isset($_POST['password']))
	{
	
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
	
		
		
			$stmt = $dbObject->prepare('SELECT user_id, user_name, user_password FROM users WHERE user_name = :username');
			$stmt->bindParam(':username', $username);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if(count($row) > 0){
				
				$validPassword = password_verify($password, $row['user_password']);
				
				if($validPassword ){
					$_SESSION['username'] = $row['user_name'];
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['bajo_ulogovan'] = true;
				header('location:index.php');
				exit;
			}else{
				echo "<h1 style='color: white'>"."Incorrect login name or password. Please try again."."</h1>"; 
					
			}
		}
	}
?>	

<div class="container">
<div class="row">
    <div class="col-lg-4 col-md-4 col-lg-offset-3 col-md-offset-3">
		  <form class="form-signin" method="post">
			<h2 class="form-signin-heading" style='color: white'>Please sign in</h2>
			<label for="inputEmail" class="sr-only">Username</label>
			<input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus></p>
			<label for="password" class="sr-only">Password</label>
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required></p>
			</div> 
			  </div> 
			  <div class="row">
			<div class="col-lg-1 col-md-4 col-lg-offset-3 col-md-offset-3">
			<button class="btn btn-lg btn-success " name="submit" type="submit">Sign in</button>
			</div> 
			</div> 
		  </form>
    
   
	</br>
	</br>
	<div class="row">
		<div class="col-lg-offset-3 col-md-offset-3">
			<a href="register.php" class="myButtonFind"> Register </a>
		 </div>  
	</div> 
	</br>
	</br>
	<div class="row">
		<div class="col-lg-offset-3 col-md-offset-3">
			<a href="" onclick="myFunction()"> Forgot password? </a>
		 </div>  
	</div> 
	</div> 
	

	<script>
function myFunction() {
    alert("HAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHA!!!");
}
</script>
<?php 
require_once('includes/footer.php');
?>	