<?php 
session_start();
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}
require_once('includes/config.php');
require_once('includes/header.php');
require_once('includes/nav.php');



$action = (isset($_GET['action'])) ?  trim($_GET['action']) : false;
$id =  (isset($_GET['id']))  ? 0 +intval($_GET['id']) : 0 ;

if( $action === 'delete') {

$stmt = $dbObject->prepare("DELETE FROM users WHERE user_id =:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

}
?>	

<div class="container">
  <h2>User grid</h2>
  <a href="useredit.php" class="myButtonAdd"> Add </a>
  <table class="table">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>User_email</th>
        <th>User_reg.time</th>
        <th>User_country</th>
        <th>User_city</th>
        <th>UserDOB</th>
        <th>User_type</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	  $stmt = $dbObject->query('SELECT * FROM users');
	  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
      <tr>
        <td><?php echo $row['user_id']?></td>
        <td><a href="profileview.php?id=<?=$row['user_id']?>"><?php echo $row['user_name']?></a></td>
        <td><?php echo $row['user_email']?></td>
        <td><?php echo $row['user_registration_time']?></td>
        <td><?php echo $row['user_country']?></td>
        <td><?php echo $row['user_city']?></td>
        <td><?php echo $row['user_date_of_birth']?></td>
        <td><?php echo $row['user_type']?></td>   
        <td><a href="useredit.php?id=<?php echo $row['user_id']; ?>" class="myButtonChange">Change</a> <a <a href="usergrid.php?action=delete&id=<?php echo $row['user_id']; ?>" class="myButtonDelete">Delete</a></td>   
      </tr>
	   <?php endwhile;?>
    
    </tbody>
  </table>
</div>

<?php 
require_once('includes/footer.php');
?>	