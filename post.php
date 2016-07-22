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
.frame {
  height: 95%; 
  width: 100%; 
  display: inline-block;
  position: center;
}

img {
  height: 220px;
  width: 100%;
  object-fit: contain;
}
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
$category_id =  (isset($_GET['id']))  ? 0 +intval($_GET['id']) : 0 ;

if($category_id){
	$stmt=$dbObject->prepare("SELECT * FROM posts WHERE post_id IN (SELECT post_id FROM posts_has_categories WHERE category_id=?) ");
$stmt->bindValue(1, $category_id, PDO::PARAM_INT);
$stmt->execute();
	
}else{
	$stmt=$dbObject->prepare('SELECT * FROM posts');
$stmt->execute();
	
}
?>

<div class="container" >

    <div id="products" class="row list-group" >
		<div class="row">
			<?php $stmt1=$dbObject->prepare('SELECT * FROM categories');
					$stmt1->execute();
						while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) :?>
						<div class="col-lg-1 bla" active>
							<a  style="color: white" href="post.php?id=<?=$row1['category_id']?>"><?=$row1['category_name']?></a>
						</div>
						<?php endwhile;?>
		</div>
	
			
			
		
	</div>
	</br>
	<?php
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
				<div class="frame">
					<div id="imgContainer">
						<img class="group list-group-image" src="<?php echo $row['post_image']; ?>"  onerror="this.src='includes/no_image.jpg'"/>
					</div>
				</div>
				
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                        <center><?php echo $row['post_name']; ?></center></h4></br>
                    <p class="group inner list-group-item-text">
                   <p><?php $striped=strip_tags($row['post_body']); echo  substr($striped,0, 190)."...";?></p>
					</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <a class="btn btn-md btn-link" href="postview.php?id=<?php echo $row['post_id']; ?>">Continue reading...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php endwhile;?>
      
	
		
		
    </div>
</div>
	
<?php 
require_once('includes/footer.php');
?>