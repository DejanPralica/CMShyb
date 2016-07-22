<?php
session_start();
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}
require_once('includes/config.php');
require_once('includes/header.php');
require_once('includes/nav.php');


	
function da($x, $y, $z)
{
switch($z)	
	{
		case '+':
			$rezultat = $x+$y;
			return $rezultat;
			break;
		 case '-':
		   $rezultat = $x-$y;
				return $rezultat;
					break;
		case '*':
			$rezultat = $x*$y;	
				return round($rezultat,11);
					break;
		case '/':
			if($y!=0){
				$rezultat = $x/$y;
					return round($rezultat,11);}
			else{
				break;
				}
	} 
}

function greska($x, $y){
	if ((!is_numeric($x))|| (!is_numeric($y))){
		echo "Fatal Error ! !";}
	}
function greskaop($z){
	if (!in_array($z, array('*', '-', '+','/')))
		echo "Pogresna operacija";
	}
function greskanula($y,$z){
	if (($z == '/') && ($y==0)){
		echo "Greska, nemoguce je dijeliti sa nulom";
	}	}

	
function sortiranje($a, $b) 
	{
	list($a_nesto, $a_rezultat) = explode('=', $a);
	list($b_nesto, $b_rezultat) = explode('=', $b);

	if ($a_rezultat  > $b_rezultat ) return  1;
	if ($a_rezultat  < $b_rezultat ) return -1;

		return 0;
		}

$znak=array('+','-','*','/');
		if((isset($_POST['x'])) && (isset($_POST['y'])) && (isset($_POST['znak']))){
		
			if(is_numeric(da($_POST['x'],$_POST['y'],$_POST['znak']))){
				
				if ((is_numeric($_POST['x']))&&(is_numeric($_POST['y'])) &&(in_array($_POST['znak'], $znak))) 
		{
			//Sesija za istoriju reultata
			$_SESSION['rezultat'][]=$_POST['x'].$_POST['znak'].$_POST['y']."=".da($_POST['x'],$_POST['y'],$_POST['znak']);
			
			$_SESSION['rezultat']=array_filter($_SESSION['rezultat']);
			
			$rezultat1=$_POST['x'].$_POST['znak'].$_POST['y']."=".da($_POST['x'],$_POST['y'],$_POST['znak']);
			
			//Sesija za pronalazak broja u rezultatu
			$_SESSION['rez'][]=da($_POST['x'],$_POST['y'],$_POST['znak']);
			
			$_SESSION['rez']=array_filter($_SESSION['rez']);
			
			//Sesija za rastuci niz
			
			$_SESSION['rast'][]=$_POST['x'].$_POST['znak'].$_POST['y']."=".da($_POST['x'],$_POST['y'],$_POST['znak']);
			
			$_SESSION['rast']=array_filter($_SESSION['rast']);	

		}
	}
}

?>

<div style="margin-left: 30%">
	<form method="post" action="">
		<input type="text"  name="x" id="x" placeholder=" number"/>
		<input type="text"  name="znak" id="znak" size="4" placeholder=" + - * / "/>
		<input type="text"  name="y" id="y" placeholder=" number"/>
		<button class="myButtonCalc" type="submit" name="submit">Calculate</button>
	</form>
</div>

<div class="container">
  <form class="form-horizontal" role="form">
	<div class="form-group">
		<label class="control-label col-sm-2">Result:</label>
		<div class="col-sm-10" style="background-color: F0F0F0" >
		
			<?php
				if(isset($rezultat1)){
					echo $rezultat1;
				}
			?>
		</div>
	</div>
<div class="form-group">
<label class="control-label col-sm-2">Error:</label>
	<div class="col-sm-10" height=15px style="background-color: F0F0F0  ">
	
		<?php
				if((isset($_POST['x'])) && (isset($_POST['y'])) && (isset($_POST['znak'])))
			{
					greska($_POST['x'],$_POST['y']);
				echo "<br>";
					greskaop($_POST['znak']);
				echo "<br>";
					greskanula($_POST['y'],$_POST['znak']); 
			}
			
		?>
		
	</div>
</div>
	<div class="form-group">
	<label class="control-label col-sm-2">History:</label>
		<div class="col-sm-10" style="background-color: F0F0F0  ">
		
			<?php
				if (isset($_SESSION['rezultat']))
				{
					foreach ($_SESSION['rezultat'] as $key) 
					{
						echo $key;
						echo"<br>";	
					}
				}
			?>
			
		</div>
	</div>

<div  class="form-group">
<label class="control-label col-sm-2">Ascending order:</label>
		<div class="col-sm-10" style="background-color: F0F0F0 ">
		
			<?php
				if (isset($_SESSION['rast']))
				{
					usort($_SESSION['rast'], 'sortiranje');
					
					foreach ($_SESSION['rast'] as $key) {
						echo $key;
							echo"<br>";}
				
				}
				?>
		</div>
</div>
</div>
</form>
	<form style="margin-left: 40%" method="post" action="">
		<input type="text" name="find">
		<button class="myButtonFind" type="submit" name="submit">Find</button>
	</form>
		<div style="margin-left:40%; color:green">
		
			<?php
			if((isset($_SESSION['rez'])) )
			{
				if((isset($_POST['find'])) )
				{
					if ((is_numeric($_POST['find'])) && (!empty($_POST['find'])))
					{
						if (in_array($_POST['find'], $_SESSION['rez'])){
							
						echo "BROJ {$_POST['find']} SE NALAZI U REZULTATU ! ! !";}
			?> 
			
		</div>
		<div style="margin-left:40%; color:red">
		
			<?php
					if (!in_array($_POST['find'], $_SESSION['rez']))
						{
						echo "BROJ {$_POST['find']} SE NE NALAZI U REZULTATU ! ! !";
						}
					}
				}
			}
			?>
		</div>

<?php require_once("includes/footer.php");?>