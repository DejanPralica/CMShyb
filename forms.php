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

		$stmt1 = $dbObject->prepare("DELETE FROM posts_has_categories WHERE post_id =:id");
		$stmt1->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt1->execute();
		
		$stmt = $dbObject->prepare("DELETE FROM posts WHERE post_id =:id");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

}







?>

<div class="container">
  <h2>Post grid</h2>
  <a href="postedit.php" class="myButtonAdd"> Add </a>
  <table class="table">
    <thead>
      <tr>
        <th>Post ID</th>
        <th>User</th>
        <th>Time of post</th>
        <th>Post name</th>
        <th>Categories</th>
        <th>Action</th>
      </tr>
    </thead>
	<?php 
	  $stmt = $dbObject->query('SELECT * FROM posts p  left join users u on u.user_id=p.user_id');
	  
	  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
      <tr>
        <td><?php echo $row['post_id']?></td>
        <td><a href="profileview.php?id=<?php echo $row['user_id']; ?> "><?php echo $row['user_name']?></a></td>
        <td><?php echo $row['post_time']?></td>
        <td><a href="postedit.php?id=<?php echo $row['post_id']; ?> "><?php echo $row['post_name']?></td>  
        <td><?php 
		
		$catstm = $dbObject->query('SELECT * FROM categories WHERE category_id IN (
			SELECT category_id FROM posts_has_categories WHERE post_id = '.$row['post_id'].'
		) ');
		
		while($row2 = $catstm->fetch(PDO::FETCH_ASSOC)) : ?>
		
			<a href="cattegoryedit.php?id=<?php echo $row2['category_id']; ?> "><?php echo $row2['category_name']." |"?></a>
		<?php endwhile;?>
		
		</td>  
        <td><a href="postedit.php?id=<?php echo $row['post_id']; ?>" class="myButtonChange">Change</a> <a <a href="forms.php?action=delete&id=<?php echo $row['post_id']; ?>" class="myButtonDelete">Delete</a></td>   
      </tr>
	   <?php endwhile;?>


<?php 
require_once('includes/footer.php');
?>


