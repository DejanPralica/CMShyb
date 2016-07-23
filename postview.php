<?php 
session_start();
require_once('includes/config.php');
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}

require_once('includes/header.php');
require_once('includes/nav.php');

function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

$post_id =  (isset($_GET['id']))  ? 0 +intval($_GET['id']) : 0 + ((isset($_POST['id'])) ? intval($_POST['id']) : 0);


$category_array=array();
	$stmt = $dbObject->prepare('SELECT * FROM posts p, posts_has_categories pc WHERE p.post_id = pc.post_id and p.post_id=:id');	$stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$user_id = $row['user_id'];
	$post_name = $row['post_name'];
	$post_time = $row['post_time'];
	$post_topic = $row['post_topic'];
	$post_body = $row['post_body'];
	$post_image = $row['post_image'];
	array_push($category_array,$row['category_id']);}
	
	list($year, $month, $day)=explode("-",$post_time);

 function getMonth($d, $m, $y){
	$dateObj   = DateTime::createFromFormat('!m', $m);
	$monthName = $dateObj->format('F');
   return $d.". ".$monthName." ".$y;
	
}

?>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<style>
	.frame {
	  height: 95%; 
	  width: 100%; 
	  display: inline-block;
	  position: center;
	}

	img {
	  height: 250px;
	  width: 100%;
	  object-fit: contain;
	}
	</style>
	<script src="ckeditor/ckeditor.js"></script>
<br>
<br>
        <div id="page-wrapper">
             <div class="container">

			<div class="row">

            <!-- Blog Post Content Column -->
				<div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
					<h1><?php echo $post_name; ?></h1>

                <!-- Author -->
                <p class="lead">
				<?php $stmt1=$dbObject->prepare('SELECT user_name FROM users WHERE user_id=:user_id');
					$stmt1->bindValue(':user_id', $user_id, PDO::PARAM_INT);
						$stmt1->execute();
						$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
						$user_name = $row1['user_name'];?>
                    by <a href="profileview.php?id=<?php echo $user_id; ?>"><?php echo $user_name; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo getMonth($day, $month, $year); ?></p>

                <hr>
				<div class="frame">
					<div id="imgContainer">
                <!-- Preview Image -->
						<img class="img-responsive" src="<?php echo $post_image; ?>" onerror="this.src='includes/no_image.jpg'">
					</div>
				</div>
                <hr>

                <!-- Post Content -->
                <p ><?php echo $post_body; ?></p>
                <hr>

                <!-- Blog Comments -->

               
                                       <a href="postedit.php?id=<?php echo $post_id; ?>" class="myButtonChange">Change</a>	 
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                          

			<script>
                CKEDITOR.replace( 'post_body' );
           CKEDITOR.config.autoParagraph = false;
			function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    // .width(150)
                    // .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	 src="js/custom-file-input.js";
	 </script>
 <?php require_once("includes/footer.php"); ?>


