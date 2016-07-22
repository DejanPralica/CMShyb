<?php 
session_start();
require_once('includes/config.php');
require_once('includes/header.php');
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}

require_once('includes/nav.php');

$stmt3=$dbObject->prepare('SELECT visit FROM visits');
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$numVisit=$row3['visit'];
$numVisit++;

$stmt4=$dbObject->prepare('UPDATE visits SET visit=? WHERE visit_id=?');
$stmt4->execute(array($numVisit, 1));
?>




            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Statistics
                        </h1>
                        <!--ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol-->
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                       <i class="fa fa-file-text-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
									<?php $stmt1=$dbObject->prepare('SELECT count(post_id) as num from posts');
											$stmt1->execute();
											$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);?>
                                        <div class="huge"><?php echo $row1['num']?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="post.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                     <i class="fa fa-bars fa-5x" ></i>  
                                    </div>
                                    <div class="col-xs-9 text-right">
									<?php $stmt=$dbObject->prepare('SELECT count(category_id) as num from categories');
											$stmt->execute();
											$row = $stmt->fetch(PDO::FETCH_ASSOC);?>
                                        <div class="huge"><?php echo $row['num']?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i> 
                                    </div>
                                    <div class="col-xs-9 text-right">
									<?php $stmt2=$dbObject->prepare('SELECT count(user_id) as num from users');
											$stmt2->execute();
											$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);?>
                                        <div class="huge"><?php echo $row2['num']?></div>
                                        <div>Number of users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="usergrid.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-hashtag fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
									<?php $stmt5=$dbObject->prepare('SELECT visit from visits');
											$stmt5->execute();
											$row5 = $stmt5->fetch(PDO::FETCH_ASSOC);?>
                                        <div class="huge"><?php echo $row5['visit']?></div>
                                        <div>Visits</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" onclick="myFunction()">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!--div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div >textic neki ili slika</div>
                            </div>
                        </div>
                    </div>
                </div-->
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

<script>
function myFunction() {
    alert("Da, to je tacan broj... ");
}
</script>

<?php 
require_once('includes/footer.php');
?>		
		
		

