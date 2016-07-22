
<?php 
session_start();
require_once('includes/config.php');
require_once('includes/header.php');
require_once('includes/nav.php');
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}


$category_name = (isset($_POST['category_name'])) ?  trim($_POST['category_name']) : '';
$id =  (isset($_GET['id']))  ? 0 +intval($_GET['id']) : 0 + ((isset($_POST['id'])) ? intval($_POST['id']) : 0);



if($id) {

	if(isset($_POST)) {
		if($category_name != '' && $id !=0 ) {
			$stmt = $dbObject->prepare("UPDATE categories SET category_name=? WHERE category_id=?");
			$stmt->execute(array($category_name, $id));
		}
	}
	
	$stmt = $dbObject->prepare('SELECT * FROM categories WHERE category_id = :id');

	$stmt->bindValue(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$category_name = $row['category_name'];

	
} else {
	if(isset($_POST)) {
		if($category_name != '' ) {
			$stmt = $dbObject->prepare("INSERT INTO categories(category_name) VALUES (:category_name)");
			$stmt->bindValue(':category_name', $category_name, PDO::PARAM_STR);
			$stmt->execute();
		}
		//header('Location: categories.php');

	}
}



?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
 
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <input class="form-control" name="category_name" value="<?php echo $category_name; ?>">
											<input name="id" type="hidden" value="<?=$id?>">
                                            <p class="help-block"></p>
                                        </div>
                                       
                                        <button type="submit" class="myButtonSubmit">Save</button>
                                        <button type="reset" class="myButtonReset">Reset</button>
										<button type="reset" class="myButtonReturn" name="reset" onclick="location.href='categories.php'">Back</button> 
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
<?php 
require_once('includes/footer.php');
?>


