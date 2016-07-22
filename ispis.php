   <?php
// ini_set('session.save_path',getcwd(). '/temp');
session_start();
require_once("includes/config.php");
require_once("includes/header.php");
//var_dump($_SESSION);
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}?>
	<div class="no-print">
		<?php
			require_once("includes/nav.php");
		?>
	</div>
	<div id="page-wrapper">
<?php
if (isset($_FILES['csv_file']))
{
    $uploadName = $_FILES['csv_file']['name'];
    $uploadTmp  = $_FILES['csv_file']['tmp_name'];
    $greska     = $_FILES['csv_file']['error'];
    //$uploadName = preg_replace("#[^a-z0-9.]#i","",$uploadName); //uklanja SPACES
    if (!$uploadTmp)
    { 
        echo ("Odaberi file");
    }
    else
    { 
        if (file_exists("uploads/$uploadName"))
        {
            $uploadNameParts = explode(".", $uploadName);
            /*
            $zadnjiElement = count($uploadNameParts)-1;
            $ext= $uploadNameParts[$zadnjiElement];
            */
            $ext             = end($uploadNameParts);
            $ime             = basename($uploadName, "." . $ext);
            $uploadName      = $ime . mt_rand(0, 100) . "." . $ext;
            move_uploaded_file($uploadTmp, "uploads/$uploadName");
            //$_SESSION['ime'][] <==> $_SESSION['ime'] = array();
            $_SESSION['ime'] = $uploadName;
            //header("Location: ispis.php");
        }
        else
        { 
            move_uploaded_file($uploadTmp, "uploads/$uploadName");
            $_SESSION['ime'] = $uploadName;
            //header("Location: tabela.php");
        }
        // OBRADA CSV-A ZA ISPIS
        if (isset($_SESSION['ime']))
        {
            $sadrzajFajla    = file_get_contents("uploads/" . $_SESSION['ime']);
     
            $sadrzajFajlaNiz = explode("\n", $sadrzajFajla);
		//prvi
			
			 $files=file("uploads/".$_SESSION['ime']);
			 
		//drugi
			  
			$file1=fopen("uploads/".$_SESSION['ime'],"r");
				if(isset($file1))
				   { 
					  while (!feof($file1))
					  { 
						 $fileNiz[] = fgets($file1); 
					  } 
						fclose($file1);
					}
        }
    }
}
?>	

	 <div class="container" >
		<div class="hidden-print">
		<form class="form-signin" method="post" enctype="multipart/form-data">
			<input type="file" name="csv_file">
				<input type="submit" name="button" value="Upisi" onclick=true>
			</div>
		</form>
	<h3><b>Tabela 1:</b></h3>	
		<table class="table">
			<thead>
				<tr>
					<th>Broj</th>
					<?php if(isset($sadrzajFajlaNiz)){
						$poljaZaNslov = explode(";", $sadrzajFajlaNiz[0]);
						foreach ($poljaZaNslov as $polje)
					{
					?>
					<th><?php echo $polje; ?> </th>
					<?php
					}
					?>
				  <th>ZBIR</th>
				</tr>
			</thead>
	  <tbody>
			<?php
				for ($i= 1;  $i< count($sadrzajFajlaNiz); $i++)
		{
					$red = $sadrzajFajlaNiz[$i];
					$kolone = explode(";", $red);
			?>
		<tr>
					<td scope="row"><?php echo $i;  ?> </th>    
				<?php 
				$zbir = 0;
				foreach ($kolone as $kolona) 
				{ ?>
					<td><?php echo $kolona ?></td>
					<?php 	$zbir+=$kolona; ?>
		  <?php } ?>
				<td><?php echo $zbir; ?></td>
		</tr>
			<?php 
			}}
			?>
	  </tbody>
	</table>
	<h3><b>Tabela 2:</b></h3>
		 <table class="table">
	  <thead>
		<tr>
			<th>Broj</th>
			<?php if(isset($fileNiz)){
			$poljaZaNslov = explode(";", $fileNiz[0]);
			foreach ($poljaZaNslov as $polje)
			{
			?>
			<th><?php echo $polje; ?> </th>
			<?php
			}
			?>
		  <th>ZBIR</th>
		</tr>
	  </thead>
	  <tbody>
			<?php
				for ($i= 1;  $i< count($fileNiz); $i++)
		{
					$red = $fileNiz[$i];
					$kolone = explode(";", $red);
			?>
		<tr>
					<td scope="row"><?php echo $i;  ?> </th>    
				<?php 
				$zbir = 0;
				foreach ($kolone as $kolona) 
				{ ?>
					<td><?php echo $kolona ?></td>
					<?php 	$zbir+=$kolona; ?>
		  <?php } ?>
				<td><?php echo $zbir; ?></td>
		</tr>
			<?php 
			}}
			?>
	  </tbody>
	</table>
	<h3><b>Tabela 3:</b></h3>
	   <table class="table">
	  <thead>
		<tr>
			<th>Broj</th>
			<?php if(isset($files)){
			$poljaZaNslov = explode(";", $files[0]);
			foreach ($poljaZaNslov as $polje)
			{
			?>
			<th><?php echo $polje; ?> </th>
			<?php
			}
			?>
		  <th>ZBIR</th>
		</tr>
	  </thead>
	  <tbody>
			<?php
				for ($i= 1;  $i< count($files); $i++)
		{
					$red = $files[$i];
					$kolone = explode(";", $red);
			?>
		<tr>
					<td scope="row"><?php echo $i;  ?> </th>    
				<?php 
				$zbir = 0;
				foreach ($kolone as $kolona) 
				{ ?>
					<td><?php echo $kolona ?></td>
					<?php 	$zbir+=$kolona; ?>
		  <?php } ?>
				<td><?php echo $zbir; ?></td>
		</tr>
			<?php 
			}}
			?>
	  </tbody>
	</table>
<?php
unset($_SESSION['brojanje']);
include "includes/footer.php";
?>