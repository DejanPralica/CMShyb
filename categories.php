<?php 
session_start();
include('includes/config.php');
include('includes/header.php');
include('includes/nav.php');

if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}

$action = (isset($_GET['action'])) ?  trim($_GET['action']) : false;
$id =  (isset($_GET['id']))  ? 0 +intval($_GET['id']) : 0 ;

if( $action === 'delete') {

$stmt = $dbObject->prepare("DELETE FROM categories WHERE category_id =:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

}
?>



<div class="container">
  <h2>Categories</h2>
  
  
  <a href="cattegoryedit.php" class="myButtonAdd"> Add </a>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	  $stmt = $dbObject->query('SELECT * FROM categories');
	  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
      <tr>
        <td><?php echo $row['category_id']; ?></td>
        <td><?php echo $row['category_name']; ?></td>
        <td> <a href="cattegoryedit.php?id=<?php echo $row['category_id']; ?>" class="myButtonChange">Change</a> <a <a href="categories.php?action=delete&id=<?php echo $row['category_id']; ?>" class="myButtonDelete">Delete</a></td>
        
      </tr>
	 <?php endwhile;?>
    
    </tbody>
  </table>
</div>
<?php 
include('includes/footer.php');
?>	