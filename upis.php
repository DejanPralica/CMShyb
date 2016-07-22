<?php
session_start();
require_once("includes/config.php");

?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.4.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.4.0/highlight.min.js"></script>
	<style>

.stylish-input-group .input-group-addon{
    background: white ; 
}
.stylish-input-group .form-control{
	border-right:0; 
	box-shadow:0 0 0; 
	border-color:#ccc;
	
}
.stylish-input-group button{
    border:0;
	color:#D9230F;
    background:transparent;
}
</style>
<?php
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}
require_once ("includes/header.php");
require_once ("includes/nav.php");

$sadrzaj ="";
$filename ="";


if(isset($_POST["save"]) && $_POST["save"] == "save") {
	$filename=trim($_POST["x"]);
	$text = trim($_POST["text_to_edit"]);
	if($filename!="" && $filename!="." && $filename!="..") {
	if(is_file($filename)) {
	
		file_put_contents($filename, $text);
	/*
			$handle = fopen($filename, "r");
			$sadrzaj = fread($handle, filesize($filename));
			fclose($handle);
			*/
	}
	}
}
if(isset($_POST["x"])) {
	$filename=trim($_POST["x"]);
	if($filename!="" && $filename!="." && $filename!="..") {
		
		if(is_dir($filename)) 
		{ 
		//opendir($filename); 
			if ($dh = opendir($filename)) { ?> <ul>
			<?php
				while (($file = readdir($dh)) !== false) {
					echo "<li> filename: $file : filetype: " . "</li>";
				}
				closedir($dh);
			?> </ul>
			<?php
				}
		} elseif (is_file($filename))
			{
				$handle = fopen($filename, "r");
				$sadrzaj = fread($handle, filesize($filename));
				fclose($handle);
			
	//$sadrzaj =file_get_contents($filename);
	} else{
		$handle = fopen($filename, 'w');
	}
}
}
?>	

</head>
  <body>


	<form class="form-signin" method="post">
	<div class="container">
	<div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div id="imaginary_container"> 
                <div class="input-group stylish-input-group">
                    <input type="text" name="x" class="form-control" value="<?php echo $filename ?>" >
                    <span class="input-group-addon"> 
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  

                    </span>
                </div>
            </div>
        </div>
	</div>
</div>

		</br>
		</br>

	<div class="container">
	
	  <style type="text/css" media="screen">


    #editor {
        min-height: 500px;
       
    }
  </style>
                        <button type="submit" name="save" value="save">
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>  
<textarea class="hide" name="text_to_edit" id="text_to_edit"><?php echo htmlentities($sadrzaj) ?></textarea>						
<div id="editor"><?php echo htmlentities($sadrzaj) ?></div>
<script src="ace-builds-master/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<textarea readonly class="form-control" rows="18" cols="50"> <?php echo $sadrzaj ?> </textarea>




<script>
    var editor = ace.edit("editor");
	
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/javascript");
		editor.getSession().on('change', function(e) {
			//console.log(editor.getSession().getValue());
			//console.log(document.getElementById("text_to_edit"));
			document.getElementById("text_to_edit").value= editor.getSession().getValue();
		});
</script>


		</div>
		
		</br>
		

</form>
 <?php
include "includes/footer.php";
?>