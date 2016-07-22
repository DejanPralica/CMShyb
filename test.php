

<?php

require_once("includes/config.php");
/*     //Vrijeme-------------------------------------------


		$stmt = $dbObject->prepare('SELECT * FROM posts');
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$post_time = $row['post_time'];	
//echo $post_time;
			list($year, $month, $day)=explode("-",$post_time);
			
			echo $year;
			echo"<hr>";
			echo $month;
			echo"<hr>";
			echo $day;
			echo"<hr>";

$dateObj   = DateTime::createFromFormat('!m', $month);
$monthName = $dateObj->format('F');



function getMonth($d, $m, $y){
	$dateObj   = DateTime::createFromFormat('!m', $m);
	$monthName = $dateObj->format('F');
   return $d.". ".$monthName." ".$y;
	
}
echo getMonth($day, $month, $year)
//-------------------------------------------------------------
*/

// Query in query------------------------------------------------------------
/*
$category_id=4;
$stmt=$dbObject->prepare("SELECT post_name FROM posts WHERE post_id IN (SELECT post_id FROM posts_has_categories WHERE category_id=?) ");
$stmt->bindValue(1, $category_id, PDO::PARAM_INT);
$stmt->execute();
//$name=$row['post_name'];

var_dump($name);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo $row['post_name'];
}
*/
//-----------------------------------------------------------------------------------------------


?>
<link rel="stylesheet" href="css/font-awesome.min.css">
<div class="row">
	<?php $stmt1=$dbObject->prepare('SELECT * FROM categories');
	$stmt1->execute();
			while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>
	<div class="col-lg-1"><?=$row1['category_name']?></div>
<?php endwhile;?>
	</div>

<i class="fa fa-newspaper-o fa-5x"></i>





















