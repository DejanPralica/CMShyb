<?php 
session_start();
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}
require_once('includes/config.php');
require_once('includes/header.php');
require_once('includes/nav.php');

?>
<style>
p{
	overflow:hidden;
	object-fit: contain;
}

div.bla
{ 
	text-align:center; 
border:1px solid white; 
height: 40px; 
display: flex;
align-items: center;
justify-content: center;
background: #FF4500
 }
</style>


<?php

$stmt=$dbObject->prepare('SELECT * FROM posts');
$stmt->execute();

?>
    <div class="container">
	<div class="row">
			<?php $stmt1=$dbObject->prepare('SELECT * FROM categories');
					$stmt1->execute();
						while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) :?>
						<div class="col-lg-1 blah" >
							<a  style="color: white" href="post.php?id=<?=$row1['category_id']?>"><?=$row1['category_name']?></a>
						</div>
						<?php endwhile;?>
		</div>
	
      <!-- Example row of columns -->
      <div class="row">
	  <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="col-md-4">
          <h2><?php echo $row['post_name']; ?></h2>
          <p><?php $striped=strip_tags($row['post_body']); echo  substr($striped,0, 190)."...";?></p>
          <p><a class="btn btn-primary" href="postview.php?id=<?php echo $row['post_id']; ?>" role="button">Read more... </a></p>
        </div>
		 <?php endwhile;?>
		
      </div>
<?php 
require_once('includes/footer.php');
?>