<?php
class ApiImages{

	// for jpg 
	public function resize_imagejpg($file, $w, $h) {
	   list($width, $height) = getimagesize($file);
	   $src = imagecreatefromjpeg($file);
	   $dst = imagecreatetruecolor($w, $h);
	   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
	   return $dst;
	}

	 // for png
	public function resize_imagepng($file, $w, $h) {
	   list($width, $height) = getimagesize($file);
	   $src = imagecreatefrompng($file);
	   $dst = imagecreatetruecolor($w, $h);
	   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
	   return $dst;
	}

	// for gif
	public function resize_imagegif($file, $w, $h) {
	   list($width, $height) = getimagesize($file);
	   $src = imagecreatefromgif($file);
	   $dst = imagecreatetruecolor($w, $h);
	   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
	   return $dst;
	}

	public function ResizeImagePng($pathToImages ,  $newWidth, $newHeigth, $fname){

		$info = pathinfo($pathToImages . $fname, PATHINFO_EXTENSION);

		if(strtolower($info) == 'png'){

  	  	  	//echo "Creating newnail for {$fname} <br />";
		
  	  	  	// load image and get image size
  	  	  	$img = imagecreatefrompng( "{$pathToImages}{$fname}" );
  	  	  	$width = imagesx( $img );
  	  	  	$height = imagesy( $img );
		
  	  	  	// calculate newnail size
  	  	  	$new_width = $newWidth;
  	  	  	$new_height = $newHeigth;
  	  	  	//$new_height = floor( $height * ( $thumbWidth / $width ) );
		
  	  	  	// create a new temporary image
  	  	  	$tmp_img = imagecreatetruecolor( $new_width, $new_height );
		
  	  	  	// copy and resize old image into new image
  	  	  	imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
		
  	  	  	// save thumbnail into a file
  	  	  	imagepng( $tmp_img, "{$pathToImages}{$fname}" );

  	  	}
	}

	public function createThumbs( $pathToImages , $pathToThumbs, $thumbWidth, $thumbHeigth, $fname )
	{
		
	  	
  	  	$info = pathinfo($pathToImages . $fname, PATHINFO_EXTENSION);
  	  	// continue only if this is a JPEG image
  	  	if ( strtolower($info) == 'jpg')
  	  	{
  	  	  	//echo "Creating thumbnail for {$fname} <br />";
		
  	  	  	// load image and get image size
  	  	  	$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
  	  	  	$width = imagesx( $img );
  	  	  	$height = imagesy( $img );
		
  	  	  	// calculate thumbnail size
  	  	  	$new_width = $thumbWidth;
  	  	  	$new_height = $thumbHeigth;
  	  	  	//$new_height = floor( $height * ( $thumbWidth / $width ) );
		
  	  	  	// create a new temporary image
  	  	  	$tmp_img = imagecreatetruecolor( $new_width, $new_height );
		
  	  	  	// copy and resize old image into new image
  	  	  	imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
		
  	  	  	// save thumbnail into a file
  	  	  	imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
  	  	}elseif(strtolower($info) == 'png'){

  	  	  	//echo "Creating thumbnail for {$fname} <br />";
		
  	  	  	// load image and get image size
  	  	  	$img = imagecreatefrompng( "{$pathToImages}{$fname}" );
  	  	  	$width = imagesx( $img );
  	  	  	$height = imagesy( $img );
		
  	  	  	// calculate thumbnail size
  	  	  	$new_width = $thumbWidth;
  	  	  	$new_height = $thumbHeigth;
  	  	  	//$new_height = floor( $height * ( $thumbWidth / $width ) );
		
  	  	  	// create a new temporary image
  	  	  	$tmp_img = imagecreatetruecolor( $new_width, $new_height );
		
  	  	  	// copy and resize old image into new image
  	  	  	imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
		
  	  	  	// save thumbnail into a file
  	  	  	imagepng( $tmp_img, "{$pathToThumbs}{$fname}" );

  	  	}
	}
}
?>