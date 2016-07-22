	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<!--link rel="stylesheet" type="text/css" href="css/style.css" /-->	
	
<style>
.frame {
  height: 95%; 
  width: 100%; 
  display: inline-block;
  position: center;
}

img {
  height: 100%;
  width: 100%;
  object-fit: contain;
}
</style>
<?php
session_start();
if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
die();
}
require_once("includes/config.php");
require_once("includes/header.php");
require_once("includes/nav.php");
error_reporting(0);

?>
<?php
function imagecreatefrombmp($p_sFile)
    {
    //    Load the image into a string 
    $file = fopen($p_sFile, "rb");
    $read = fread($file, 10);
    while (!feof($file) && ($read <> ""))
        $read .= fread($file, 1024);
    
    $temp   = unpack("H*", $read);
    $hex    = $temp[1];
    $header = substr($hex, 0, 108);
    
    //    Process the header 
 
    if (substr($header, 0, 4) == "424d")
        {
        //    Cut it in parts of 2 bytes 
        $header_parts = str_split($header, 2);
        
        //    Get the width        4 bytes 
        $width = hexdec($header_parts[19] . $header_parts[18]);
        
        //    Get the height        4 bytes 
        $height = hexdec($header_parts[23] . $header_parts[22]);
        
        //    Unset the header params 
        unset($header_parts);
        }
    
    //    Define starting X and Y 
    $x = 0;
    $y = 1;
    
    //    Create newimage 
    $image = imagecreatetruecolor($width, $height);
    
    //    Grab the body from the image 
    $body = substr($hex, 108);
    
    //    Calculate if padding at the end-line is needed 
    //    Divided by two to keep overview. 
    //    1 byte = 2 HEX-chars 
    $body_size   = (strlen($body) / 2);
    $heder_size = ($width * $height);
    
    //    Use end-line padding? Only when needed 
    $usePadding = ($body_size > ($heder_size * 3) + 4);
    
    //    Using a for-loop with index-calculation instaid of str_split to avoid large dary consumption 
    //    Calculate the next DWORD-position in the body 
    for ($i = 0; $i < $body_size; $i += 3)
        {
        //    Calculate line-ending and padding 
        if ($x >= $width)
            {
            //    If padding needed, ignore image-padding 
            //    Shift i to the ending of the current 32-bit-block 
            if ($usePadding)
                $i += $width % 4;
            
            //    Reset horizontal position 
            $x = 0;
            
            //    Raise the height-position (bottom-up) 
            $y++;
            
            //    Reached the image-height? Break the for-loop 
            if ($y > $height)
                break;
            }
        
        //    Calculation of the RGB-pixel (defined as BGR in image-data) 
        //    Define $i_pos as absolute position in the body 
        $i_pos = $i * 2;
        $r     = hexdec($body[$i_pos + 4] . $body[$i_pos + 5]);
        $g     = hexdec($body[$i_pos + 2] . $body[$i_pos + 3]);
        $b     = hexdec($body[$i_pos] . $body[$i_pos + 1]);
        
        //    Calculate and draw the pixel 
        $color = imagecolorallocate($image, $r, $g, $b);
        imagesetpixel($image, $x, $height - $y, $color);
        
        //    Raise the horizontal position 
        $x++;
        }
    
    //    Unset the body / free the dary 
    unset($body);
    
    //    Return image-object 
    return $image;
    }

function imagebmp(&$img, $filename = false)
{
	$wid = imagesx($img);
	$hei = imagesy($img);
	$wid_pad = str_pad('', $wid % 4, "\0");
	
	$size = 54 + ($wid + $wid_pad) * $hei;
	
	//prepare & save header
	$header['identifier']		= 'BM';
	$header['file_size']		= dword($size);
	$header['reserved']			= dword(0);
	$header['bitmap_data']		= dword(54);
	$header['header_size']		= dword(40);
	$header['width']			= dword($wid);
	$header['height']			= dword($hei);
	$header['planes']			= word(1);
	$header['bits_per_pixel']	= word(24);
	$header['compression']		= dword(0);
	$header['data_size']		= dword(0);
	$header['h_resolution']		= dword(0);
	$header['v_resolution']		= dword(0);
	$header['colors']			= dword(0);
	$header['important_colors']	= dword(0);

	if ($filename)
	{
	    $f = fopen($filename, "wb");
	    foreach ($header AS $h)
	    {
	    	fwrite($f, $h);
	    }
	    
		//save pixels
		for ($y=$hei-1; $y>=0; $y--)
		{
			for ($x=0; $x<$wid; $x++)
			{
				$rgb = imagecolorat($img, $x, $y);
				fwrite($f, byte3($rgb));
			}
			fwrite($f, $wid_pad);
		}
		fclose($f);
	}
	else
	{
	    foreach ($header AS $h)
	    {
	    	echo $h;
	    }
	    
		//save pixels
		for ($y=$hei-1; $y>=0; $y--)
		{
			for ($x=0; $x<$wid; $x++)
			{
				$rgb = imagecolorat($img, $x, $y);
				echo byte3($rgb);
			}
			echo $wid_pad;
		}
	}
}
function dwordize($str)
{
	$a = ord($str[0]);
	$b = ord($str[1]);
	$c = ord($str[2]);
	return $c*256*256 + $b*256 + $a;
}

function byte3($n)
{
	return chr($n & 255) . chr(($n >> 8) & 255) . chr(($n >> 16) & 255);	
}
function dword($n)
{
	return pack("V", $n);
}
function word($n)
{
	return pack("v", $n);
}
?>
<?php

// File and new size
if (isset($_FILES['image']))
{ 
    $uploadName = $_FILES['image']['name'];
    $uploadTmp  = $_FILES['image']['tmp_name'];
    move_uploaded_file($uploadTmp, "images/$uploadName");
	
	
	
	if (isset($_POST['upload_button']))
	{
		$_SESSION['da']= $uploadName;
	}
      $fileTemp="images/$uploadName";
		
	if(file_exists( $uploadName))
	{
		$filename = $fileTemp;
	} else
		{
		$filename = "images/{$_SESSION['da']}";
		}	
		
		
		//Ekstenzija
	function exte($file)
        {
        $uploadNameParts = explode(".", $file);
        $zadnjiElement   = count($uploadNameParts) - 1;
        $ext             = $uploadNameParts[$zadnjiElement];
        return $ext;
        }
		
    $name = basename($filename, "." . exte($filename));
	
    switch (exte($filename))
    {
        case 'jpeg':
            $source = imagecreatefromjpeg($filename);
            break;
        case 'jpg':
            $source = imagecreatefromjpeg($filename);
            break;
        case 'png':
            $source = imagecreatefrompng($filename);
            break;
        case 'bmp':
            $source = imagecreatefrombmp($filename);
            break;
        case 'wbmp':
            $source = imagecreatefromwbmp($filename);
            break;
    }
	
	
    
    list($width, $height) = getimagesize($filename);
	
	//Racuna postotak
    if (isset($_POST['checkper']))
        {
        $percent = $_POST['per'] / 100;
        
        $newwidth  = $width * $percent;
        $newheight = $height * $percent;
        }
    else 
        {
        $newwidth  = $width;
        $newheight = $height;
        }
		
		
	//Crop
	if(isset($_POST['checkcrop'])){
		switch([$_POST['cropx'], $_POST['cropy']]){
			
			case($_POST['cropx']==""):
				$newwidth = $width;
			break;
			
			case($_POST['cropx']!==""):
				$newwidth = $_POST['cropx'];
		break;}
		switch([$_POST['cropx'], $_POST['cropy']]){
			
			case($_POST['cropy']==""):
				$newheight = $height;
			break;
			
			case($_POST['cropy']!==""):
				$newheight = $_POST['cropy'];
			break;
		}
				$height = $newheight;
				$width  = $newwidth;
	}
	
	
	//Filter
		if(isset($_POST['filter'])){
			switch ($_POST['id_filters'])
        {
            case '1':
             imagefilter($source,IMG_FILTER_NEGATE);
					break;
			case '2':
			  imagefilter($source,IMG_FILTER_GRAYSCALE);
					break;
            case '3':
			  imagefilter($source,IMG_FILTER_EDGEDETECT);
					break;
            case '4':
				imagefilter($source,IMG_FILTER_EMBOSS);
					break;
            case '5':
				imagefilter($source,IMG_FILTER_GAUSSIAN_BLUR);
					break;
            case '6':
				imagefilter($source,IMG_FILTER_SELECTIVE_BLUR);
					break;
            case '7':
				imagefilter($source,IMG_FILTER_MEAN_REMOVAL);
					break;
            case '8':
				imageflip($source,IMG_FLIP_BOTH);
					break;
            case '9':
				imageflip($source,IMG_FLIP_HORIZONTAL);
					break;
            case '10':
				imageflip($source,IMG_FLIP_VERTICAL);
					break;
            case '11':
				imagefilter($source,IMG_FILTER_SMOOTH,$_POST['size']);
					break;
            case '12':
				imagefilter($source,IMG_FILTER_BRIGHTNESS,$_POST['size']);
					break;
            case '13':
				imagefilter($source,IMG_FILTER_CONTRAST,$_POST['size']);
					break;
        }
		}
	
	
    // Load
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    
    // Resize
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		
	//Save file	
	if (isset($_POST['save']))
		{
        switch ($_POST['save'])
        {
            case 'jpg':
                $_SESSION['da'] =  "{$name}.jpg"; 
                imagejpeg($thumb, "images/{$_SESSION['da']}");
                break;
			case 'png':
                $_SESSION['da'] = "{$name}.png";
                imagepng($thumb, "images/{$_SESSION['da']}");
                break;
			case 'bmp':
                $_SESSION['da'] = "{$name}.bmp";
                imagebmp($thumb, "images/{$_SESSION['da']}");
                break;
            case 'wbmp':
                $_SESSION['da'] = "{$name}.wbmp";
                imagewbmp($thumb, "images/{$_SESSION['da']}");
                break;
        }
		}
	
		
        imagedestroy($thumb);
	
	$image="images/{$_SESSION['da']}";
}

	
?>
<body>
<div class="row">
	<div class="col-md-8 col-lg-8" >
		<div class="frame">
			<div id="imgContainer">
				<img id="imageFullScreen" src="<?php echo $image; ?>" onerror="this.src='includes/no_image.jpg'" >
			</div>
		</div>
	</div>
	<div class="container col-md-4 col-lg-4">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="row">
				<input type="file" name="image" id="image" class="inputfile inputfile-3"  style="display:none" accept="image/*"/>
				<label for="image"><span>Choose a file...</span></label>
			</div>
				<br><input type="submit" id="image-button" name="upload_button" class="myButtonSave " value="Upload" ></input></br></br>
			<div style="display:<?php if((!isset($_FILES['image']))) {echo "none";}?>" >
				  <label  for="checkper">Postotak:</br>
						<input type="number" name="per" min="1">
				  </label>
						<input type="checkbox" id="checkper" name="checkper"><br>
					</br>
			<div class="form-group">
				  <label  for="checkcrop">Crop:</br>
						<input type="number" name="cropx" placeholder="Sirina" min="1"></br>
						x</br>
						<input type="number" name="cropy" placeholder="Visina" min="1">   
				  </label>
						<input type="checkbox" id="checkcrop" name="checkcrop"/><br>
						</div>
						</br>
					
				   <label  for="filter">Filter:</br>
				  <select name="id_filters">
						 <option selected style="display:none" value=""></option>
						 <option value="1">NEGATE</option>
						 <option value="2">GRAYSCALE</option>
						 <option value="3">EDGEDETECT</option>
						 <option value="4">EMBOSS</option>
						 <option value="5">GAUSSIAN_BLUR:</option>
						 <option value="6">SELECTIVE_BLUR</option>
						 <option value="7">MEAN_REMOVAL</option>
						 <option value="8">FLIP_BOTH</option>
						 <option value="9">FLIP_HORIZONTAL</option>
						 <option value="10">FLIP_VERTICAL</option>
						 <option id="slct" value="11">SMOOTH-izaberi drugi parametar</option>
						 <option id="slct" value="12">BRIGHTNESS-izaberi drugi parametar</option>
						 <option id="slct" value="13">CONTRAST-izaberi drugi parametar</option>
						<br><br>
						 <input type="number" name="size" min="-255" max="255">
				  </select>
				  </label>
					<input type="checkbox" id="filter" name="filter"/><br>
					
				   <label> Save file:</label>
				  <select name="save">
						 <option selected style="display:none" value="<?php if (isset($_SESSION['da'])){ $uploadNameParts = explode(".", $_SESSION['da']); $ext = end($uploadNameParts); echo $ext;}?>"></option>
						 <option value="jpg">JPG</option>
						 <option value="png">PNG</option>
						 <option value="bmp">BMP</option>
						 <option value="wbmp">WBMP</option>
				  </select>
				  <br>
				  <input type="submit" class="myButtonSave" id="save_button" name="save_button" value="Save">
			</div>	
		</form>
	</div>
</div>

</body>
<script src="js/custom-file-input.js"></script>
 <?php require_once("includes/footer.php"); ?>