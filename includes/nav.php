
  <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo " ".$_SESSION['username'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profileedit.php?id=<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php if (basename($_SERVER['PHP_SELF'])=="index.php") {echo "active";} else {echo "noactive";}?>">
                        <a href="index.php"><i class="fa fa-home"></i>Index</a>
                    </li>
                    <li class="<?php if (basename($_SERVER['PHP_SELF'])=="forms.php") {echo "active";} else {echo "noactive";}?>">
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i>Post grid</a>
                    </li>	
					<li class="<?php if ((basename($_SERVER['PHP_SELF'])=="upis.php") || (basename($_SERVER['PHP_SELF'])=="ispis.php")) {echo "active";} else {echo "noactive";}?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#colap"><i class="fa fa-fw fa-arrows-v"></i>File editing<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="colap" class="collapse">
                            <li>
                                <a href="upis.php">Input into file</a>
                            </li>
                            <li>
                                <a href="ispis.php">CSV print</a>
                            </li>
                        </ul>
                    </li>						
                    <li class="<?php if ((basename($_SERVER['PHP_SELF'])=="post.php") || (basename($_SERVER['PHP_SELF'])=="post2.php")) {echo "active";} else {echo "noactive";}?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Post (2 varijante)<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="post.php">Post 1</a>
                            </li>
                            <li>
                                <a href="post2.php">Post 2</a>
                            </li>
                        </ul>
                    </li>		
					<li class="<?php if (basename($_SERVER['PHP_SELF'])=="categories.php") {echo "active";} else {echo "noactive";}?>">
                        <a href="categories.php"><i class="fa fa-fw fa-edit"></i>Categories</a>
                    </li>				
					<li class="<?php if (basename($_SERVER['PHP_SELF'])=="usergrid.php") {echo "active";} else {echo "noactive";}?>">
                        <a href="usergrid.php"><i class="fa fa-fw fa-edit"></i>User grid</a>
                    </li>	
					<li class="<?php if (basename($_SERVER['PHP_SELF'])=="editor.php") {echo "active";} else {echo "noactive";}?>">
                        <a href="editor.php"><i class="fa fa-fw fa-edit"></i>Picture editor</a>
                    </li>	
					<li class="<?php if (basename($_SERVER['PHP_SELF'])=="kalkulator.php") {echo "active";} else {echo "noactive";}?>">
                        <a href="kalkulator.php"><i class="fa fa-fw fa-edit"></i>Calculator</a>
                    </li>
					<li class="<?php if (basename($_SERVER['PHP_SELF'])=="weather.php") {echo "active";} else {echo "noactive";}?>">
                        <a href="weather.php"><i class="fa fa-fw fa-edit"></i>Weather</a>
                    </li>						
                    <!--li class="<?php if (basename($_SERVER['PHP_SELF'])=="") {echo "active";} else {echo "noactive";}?>">
                        <a href="#"><i class="fa fa-fw fa-file"></i>Statistika članaka po broju riječi</a>
                    </li-->
                    <li class="<?php if (basename($_SERVER['PHP_SELF'])=="contact.php") {echo "active";} else {echo "noactive";}?>">
                        <a href="contact.php"><i class="fa fa-fw fa-dashboard"></i>Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
		
<div id="page-wrapper">
	
 