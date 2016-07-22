<?php 
session_start();
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}
require_once('includes/config.php');
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
$category_array=array();


$post_name = (isset($_POST['post_name'])) ?  trim($_POST['post_name']) : '';
$post_topic = (isset($_POST['post_topic'])) ?  trim($_POST['post_topic']) : '';
$category_id = (isset($_POST['category_id'])) ?  trim($_POST['category_id']) : '';
$post_body = (isset($_POST['post_body'])) ?  $_POST['post_body'] : '';

$a =(isset($_POST['1']) ? $_POST['1']: NULL);
$a1 =(isset($_POST['2']) ? $_POST['2']: NULL);
$a2 =(isset($_POST['3']) ? $_POST['3']: NULL);
$a3 =(isset($_POST['4']) ? $_POST['4']: NULL);
$a4 =(isset($_POST['5']) ? $_POST['5']: NULL);
$a5 =(isset($_POST['6']) ? $_POST['6']: NULL);
$a6 =(isset($_POST['7']) ? $_POST['7']: NULL);
$a7 =(isset($_POST['8']) ? $_POST['8']: NULL);
$a8 =(isset($_POST['9']) ? $_POST['9']: NULL);
$a9 =(isset($_POST['10']) ? $_POST['10']: NULL);

array_push($category_array,$a, $a1, $a2, $a3,$a4, $a5, $a6, $a7, $a8, $a9 );

$category_array=array_filter($category_array); 


$post_id =  (isset($_GET['id']))  ? 0 +intval($_GET['id']) : 0 + ((isset($_POST['id'])) ? intval($_POST['id']) : 0);

$user_id=$_SESSION['user_id'];

if (isset($_FILES['image']))
{
	$name = $_FILES['image']['name'];
    $tmp  = $_FILES['image']['tmp_name'];
	
	if(file_exists("images/$name"))
     {
      echo'file is already present';
     }else{
	 move_uploaded_file($tmp, "images/$name");
	 }
	 $post_image="images/$name";
	$_SESSION['image']=$post_image;
} else{
	$post_image=NULL;
	}
	
	
if($post_id){
	if(isset($_POST)) {
		if($post_name != '' && $post_id !=0) {
			
			
			$stmt = $dbObject->prepare("UPDATE posts SET user_id=?, post_name=?, post_time=NOW(), post_topic=?, post_body=?, post_image=? WHERE post_id=?");
			$stmt->execute(array($user_id, $post_name, $post_topic, $post_body, $post_image, $post_id));
			
			foreach($category_array as $category_id){
			$stmt4 = $dbObject->prepare("UPDATE posts_has_categories(post_id, category_id) SET post_id=?, category_id=?");
			$stmt4->bindValue(1, $post_id, PDO::PARAM_INT);
			$stmt4->bindValue(2, $category_id, PDO::PARAM_STR);
			$stmt4->execute();
			}
			redirect('postedit.php');
		}
	}
	
	$stmt = $dbObject->prepare('SELECT * FROM posts p, posts_has_categories pc WHERE p.post_id = pc.post_id and p.post_id=:id');

	$stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$post_name = $row['post_name'];
	$post_topic = $row['post_topic'];
	$post_body = $row['post_body'];
	$post_image = $row['post_image'];
	array_push($category_array,$row['category_id']);}
	$_SESSION['image']=$post_image;
} else{
	if(isset($_POST)) {
		if($post_name != '' ) {
			
			$stmt5= $dbObject->prepare('SELECT  count(post_name) as num FROM posts WHERE post_name=?');
			$stmt5->bindValue(1,$post_name, PDO::PARAM_STR);
			$stmt5->execute();
			 $row = $stmt5->fetch(PDO::FETCH_ASSOC);
			 
			 
			if($row['num'] > 0){
			?>
			<div class='col-lg-offset-4 col-md-offset-4' style="color: red"><h3>Taj naslov vec postoji!</h3></div>
			<?php			
			} elseif(empty($category_array)){
				?>
				<div class='col-lg-offset-4 col-md-offset-4' style="color: red"><h2>Unesi kategoriju!</h2></div>
			<?php	
			}
			else{
			
			$stmt = $dbObject->prepare("INSERT INTO posts(user_id, post_name, post_time, post_topic, post_body, post_image) VALUES (:user_id, :post_name, NOW(), :post_topic, :post_body,:post_image )");
			$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':post_name', $post_name, PDO::PARAM_STR);
			$stmt->bindValue(':post_topic', $post_topic, PDO::PARAM_STR);
			$stmt->bindValue(':post_body', $post_body, PDO::PARAM_STR);
			$stmt->bindValue(':post_image', $post_image, PDO::PARAM_STR);
			$stmt->execute();
			
			$stmt1= $dbObject->prepare('SELECT * FROM posts WHERE post_name=?');
			$stmt1->bindValue(1, $post_name, PDO::PARAM_STR);
			$stmt1->execute();
			$row2 = $stmt1->fetch(PDO::FETCH_ASSOC);
			$post_id = $row2['post_id'];
			
			foreach($category_array as  $category_id){
			$stmt4 = $dbObject->prepare("INSERT INTO posts_has_categories(post_id, category_id) VALUES (:post_id, :category_id)");
			$stmt4->bindValue(':post_id', $post_id, PDO::PARAM_INT);
			$stmt4->bindValue(':category_id', $category_id, PDO::PARAM_INT);
			$stmt4->execute();
			}
			
			redirect('postedit.php');
		}
	
}
}
}




?>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<style>
	.frame {
	  height: 170px; 
	  width: 150px; 
	  display: inline-block;
	  position: center;
	}

	img {
	  height: 100%;
	  width: 100%;
	  object-fit: contain;
	}
	</style>
	<script src="ckeditor/ckeditor.js"></script>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Post</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                 
                        <!--div class="panel-heading">
                            Type in your new blog post!
                        </div-->
                        <div class="panel-body">
                            <div class="row">
                                
                                    <form  method="post"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Naslov</label>
                                            <input name="post_name" class="form-control" value="<?=$post_name?>">
                                            <p class="help-block"></p>
                                        </div>
										<div class="form-group">
                                            <label>Tema</label>
                                            <input name="post_topic" class="form-control" value="<?=$post_topic?>">
                                            <p class="help-block"></p>
                                        </div>
										<div class="form-group">
                                            <label>Kategorije</label></br>
											<div class="row">
											<div class="col-md-3 col-lg-3">
												 <input type="checkbox" name="1" value="1" <?php if(in_array(1, $category_array)){echo "checked";} ?>> Vijesti<br>
												 <input type="checkbox" name="2" value="2" <?php if(in_array(2, $category_array)){echo "checked";} ?>> Crna Hronika<br>
												 <input type="checkbox" name="3" value="3" <?php if(in_array(3, $category_array)){echo "checked";} ?>> Svijet<br>
												 <input type="checkbox" name="4" value="4" <?php if(in_array(4, $category_array)){echo "checked";} ?>> Ekonomija<br>
												 <input type="checkbox" name="5" value="5" <?php if(in_array(5, $category_array)){echo "checked";} ?>> Kultura<br>
											 </div>
											 <div class="col-md-3 col-lg-3">
												 <input type="checkbox" name="6" value="6" <?php if(in_array(6, $category_array)){echo "checked";} ?>> Sport<br>
												 <input type="checkbox" name="7" value="7" <?php if(in_array(7, $category_array)){echo "checked";} ?>> Zanimljivosti<br>
												 <input type="checkbox" name="8" value="8" <?php if(in_array(8, $category_array)){echo "checked";} ?>> Zdravlje i ljepota<br>
												 <input type="checkbox" name="9" value="9" <?php if(in_array(9, $category_array)){echo "checked";} ?>> Showbiz<br>
												 <input type="checkbox" name="10" value="10" <?php if(in_array(10, $category_array)){echo "checked";} ?>> Ostalo<br>
											<!--input name="category_name" class="form-control" value="<?=$category_name?>"-->
											</div>
											</div>
											
											  <p class="help-block"></p>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        
										<div class="col-lg-12">
                                        <div class="form-group">
                                            <label>New post</label></p>
                                            <textarea name="post_body" id="post_body" class="form-control" rows="16"><?php echo htmlentities($post_body);?></textarea>
                                        </div>
                                 </div>
									
                                        <div class="form-group">
                                            <label><h3>Upload photo</h3></label>
											
                                           <div class="row">
                                           <div class="col-lg-2 col-md-2">
												<input type="file" name="image" id="image" class="inputfile inputfile-3"  onchange="readURL(this);" style="display:none" accept="image/*"/>
												<label for="image"><span><h4>Choose a file...</h4></span></label>
												</div>
												<div class="col-lg-2 col-md-2">
														<div class="frame">
															<div id="imgContainer">
																<!--img id="blah" src="<?php if(isset($_SESSION['image'])){echo $_SESSION['image'];}else{ echo"";}?>" onerror="this.src='includes/no_image.jpg'" /-->
																<img id="blah" src="<?php echo $post_image?>" onerror="this.src='includes/no_image.jpg'" />
															</div>
													</div>
													</div>
											</div>
                                        </div>
										
                                        <button type="submit" class="myButtonSubmit" name="submit"  >Sacuvaj</button>	 
										<button type="reset" class="myButtonReset" name="reset" onclick="location.href='postedit.php'">Reset</button> 	 
										<button type="reset" class="myButtonReturn" name="return" onclick="location.href='forms.php'">Nazad</button> 	
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                          

			<script>
			
			
			//CKEDITOR
                CKEDITOR.replace( 'post_body' );
           CKEDITOR.config.autoParagraph = false;
		   
		   //Slika u frame-u
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


