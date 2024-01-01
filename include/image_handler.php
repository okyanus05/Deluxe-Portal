<?php
/**************************************************
* ImageHandler API
* --------
* Used to manipulate images.
* 
* Deluxe Portal Version 2.0
**************************************************/

/* ImageHandler Class:
 * ===================
 * Image Resizing class using GD1.6 and higher (GD2 very strongly recommended).
 * Returns JPEG Image
 *
 * Usage:
 * ======
 *
 * $filename = './image.jpg';
 * header('Content-Type: image/jpeg');
 * header('Content-Disposition: inline; filename="'. basename($filename) . '"');
 * if (ImageHandler::check_gd())
 * {
 *      $image = new ImageHandler($filecontent);
 *      $image->resize_maximum_proportional(350, 100);
 *      echo ($image->get_image());
 *      $image->clean_up();
 * }
 * else
 *      echo ($filecontent);
 * 
 * ==================
 */

class ImageHandler
{
	var $quality;
	var $bg_r;
	var $bg_g;
	var $bg_b;
	var $version;
	var $original;
	var $original_height;
	var $original_width;
	var $resized_width;
	var $resized_height;
	var $newimage;

	function ImageHandler($image, $image_is_filename = true, $quality = 80, $bg_r = 255, $bg_g = 255, $bg_b = 255)
	{ // Setup original settings, if $image_is_filename is set to false, then $image is expected to be the binary
	  // data for the image, if Image cannot be loaded, a blank 100x100 image is used.
		$this->quality = (int) ($quality > 100 ? 100 : ($quality < 5 ? 5 : $quality));
		$this->bg_r = (int) ($bg_r > 255 ? 255 : ($bg_r < 0 ? 0 : $bg_r));
		$this->bg_g = (int) ($bg_g > 255 ? 255 : ($bg_g < 0 ? 0 : $bg_g));
		$this->bg_b = (int) ($bg_b > 255 ? 255 : ($bg_b < 0 ? 0 : $bg_b));
		$this->version = function_exists('ImageCreateTrueColor') ? 2 : 1;
		if ($image_is_filename==false)
			$this->original = @ImageCreateFromString($image);
		elseif (file_exists($image) || strtolower(substr($image, 0, 7))=='http://')
			$this->original = @ImageCreateFromString(file_get_contents($image));
		if (!$this->original)
		{
			if ($this->version>=2)
				$this->original = ImageCreateTrueColor(100, 100);
			else
				$this->original = ImageCreate(100, 100);
			ImageFill($this->original, 0, 0, ImageColorExact($this->original, $this->bg_r, $this->bg_g, $this->bg_b));
		}
			
		$this->original_height = ImageSY($this->original);
		$this->original_width = ImageSX($this->original);
	}
	
	function resize_image($width, $height, $return = false)
	{ // Resize Image to width and height specified.
		if ($return==false)
		{
			$this->resized_width = ceil($width);
			$this->resized_height = ceil($height);
			if ($this->version>=2)
				$this->newimage = ImageCreateTrueColor($width, $height);
			else
				$this->newimage = ImageCreate($width, $height);
			ImageFill($this->newimage, 0, 0, ImageColorExact($this->newimage, $this->bg_r, $this->bg_g, $this->bg_b));
			ImageCopyResampled($this->newimage, $this->original, 0, 0, 0, 0, $this->resized_width, $this->resized_height, $this->original_width, $this->original_height);
		}
		else
		{
			$resized_width = ceil($width);
			$resized_height = ceil($height);
			if ($this->version>=2)
				$newimage = ImageCreateTrueColor($width, $height);
			else
				$newimage = ImageCreate($width, $height);
			ImageFill($newimage, 0, 0, ImageColorExact($newimage, $this->bg_r, $this->bg_g, $this->bg_b));
			ImageCopyResampled($newimage, $this->original, 0, 0, 0, 0, $resized_width, $resized_height, $this->original_width, $this->original_height);
			ob_start();
				ImageJPEG($newimage, '', $this->quality);
				$image = ob_get_contents();
			ob_end_clean();
			ImageDestroy($newimage);
			return $image;
		}
	}
	
	function resize_image_by_height($height, $return = false)
	{ // Propotionally resize Image with specified height.
		$ratio = $this->original_height / $height;
		if ($return==false)
			$this->resize_image(($this->original_width / $ratio), $height);
		else
			return $this->resize_image(($this->original_width / $ratio), $height, $return);
	}
	
	function resize_image_by_width($width, $return = false)
	{ // Propotionally resize Image with specified width.
		$ratio = $this->original_width / $width;
		if ($return==false)
			$this->resize_image($width, ($this->original_height / $ratio));
		else
			return $this->resize_image($width, ($this->original_height / $ratio), $return);
	}
	
	function resize_maximum_proportional($width, $height, $return = false)
	{ // Resize Image, so that neither the height nor the width is larger than the
	  // values specified.
		if ($this->original_height > $height || $this->original_width > $width)
		{
			$width_ratio = $this->original_width / $width;
			$height_ratio = $this->original_height / $height;
			$new_height = $this->original_height / $height_ratio;
			$new_width = $this->original_width / $width_ratio;
			$which_ratio = $width_ratio > $height_ratio ? 'width' : 'height';
			$new_size = $which_ratio=='width' ? $new_width : $new_height;
			if ($return==false)
			{
				if ($which_ratio=='width')
					$this->resize_image_by_width($new_size);
				else
					$this->resize_image_by_height($new_size);
			}
			else
			{
				if ($which_ratio=='width')
					return $this->resize_image_by_width($new_size, $return);
				else
					return $this->resize_image_by_height($new_size, $return);
			}
		}
		elseif ($return!=false)
		{
			ob_start();
				ImageJPEG($this->original, '', $this->quality);
				$image = ob_get_contents();
			ob_end_clean();
			return $image;
		}
	}
	
	function resize_minimum_proportional($width, $height, $return = false)
	{ // Resize Image, so that neither the height nor the width is less than the
	  // values specified.
		if ($width > $this->original_width || $height > $this->original_height)
		{
			$width_difference  = $width - $this->original_width;
			$height_difference = $height - $this->original_height;
			$which_ratio = ($width_difference > $height_difference) ? 'width' : 'height';
			if ($return==false)
			{
				if ($which_ratio=='width')
					$this->resize_image_by_width($width);
				else
					$this->resize_image_by_height($height);
			}
			else
			{
				if ($which_ratio=='width')
					return $this->resize_image_by_width($width, $return);
				else
					return $this->resize_image_by_height($height, $return);
			}
		}
		else
		{
			if ($return==false)
				$this->resize_image($this->original_width, $this->original_height);
			else
				return $this->resize_image($this->original_width, $this->original_height, $return);
		}
	}

	function get_height($get = 'original')
	{ // Get height of selected image type, if no type specified, Original Image
	  // Size is returned.
		if (strtolower(trim($get))=='resized' && $this->newimage)
			return $this->resized_height;
		else
			return $this->original_height;
	}

	function get_width($get = 'original')
	{ // Get width of selected image type, if no type specified, Original Image
	  // Size is returned.
		if (strtolower(trim($get))=='resized' && $this->newimage)
			return $this->resized_width;
		else
			return $this->original_width;
	}

	function get_image($get = 'resized', $quality = NULL)
	{ // Get's selected image, if no type specified, Resized Image is returned,
	  // unless image has not yet been resized.
		ob_start();
			if (strtolower(trim($get))=='resized' && $this->newimage)
				ImageJPEG($this->newimage, '', isset($quality) ? ((int) ($quality > 100 ? 100 : ($quality < 1 ? 1 : $quality))) : $this->quality);
			else
				ImageJPEG($this->original, '', isset($quality) ? ((int) ($quality > 100 ? 100 : ($quality < 1 ? 1 : $quality))) : $this->quality);
			$image = ob_get_contents();
		ob_end_clean();
		return $image;
	}
	
	function clean_up()
	{ // This function MUST be run after you finish with the image!
		if ($this->newimage)
		{
			ImageDestroy($this->newimage);
			unset($this->newimage,
				  $this->resized_width,
				  $this->resized_height);
		}
		ImageDestroy($this->original);
		unset($this->quality,
		      $this->bg_r,
			  $this->bg_g,
			  $this->bg_b,
			  $this->version,
			  $this->original,
			  $this->original_width,
			  $this->original_height);
		return true;
	}
	
	function check_gd()
	{ // ImageHandler::check_gd() should be checked by calling it statically before
	  // instantiating the class
		if ( function_exists('ImageDestroy') &&
			 function_exists('ImageJPEG') &&
			 function_exists('ImageSX') &&
			 function_exists('ImageSY') &&
			 function_exists('ImageCopyResampled') &&
			 function_exists('ImageFill') &&
			 function_exists('ImageCreateFromString') &&
			 function_exists('ImageColorExact') &&
			(function_exists('ImageCreate') || function_exists('ImageCreateTrueColor')))
				return true;
			else
				return false;
	}
}

class ImageVerification extends ImageHandler
{
	function ImageVerification($image, $image_is_filename = true, $quality = 80, $bg_r = 255, $bg_g = 255, $bg_b = 255)
	{
		parent::ImageHandler($image, $image_is_filename, $quality, $bg_r, $bg_g, $bg_b);
	}

	function add_text_to_image($font_size_px, $str_text, $r = 0, $g = 0, $b = 0, $fontfile = '')
	{
		if (file_exists($fontfile) || (!file_exists($fontfile) && file_exists(REQUIRE_PATH . 'include/gd_registration.ttf') && ($fontfile = REQUIRE_PATH . 'include/gd_registration.ttf')))
		{
			$r = (int) ($r > 255 ? 255 : ($r < 0 ? 0 : $r));
			$g = (int) ($g > 255 ? 255 : ($g < 0 ? 0 : $g));
			$b = (int) ($b > 255 ? 255 : ($b < 0 ? 0 : $b));
			$text_info = imagettfbbox($font_size_px, 0, $fontfile, $str_text);
			$height = $text_info[5] - $text_info[3];
			$height = abs($height) + 8;
			$width  = $text_info[6] - $text_info[4];
			$width  = abs($width) + 8;
			$this->resize_minimum_proportional($width, $height);
			$new_width  = $this->get_width('resized');
			$new_height = $this->get_height('resized');
			$top  = (floor(($new_height - $height) / 2) + $height) - 4;
			$left =  floor(($new_width  - $width)  / 2) - 4;
			imagettftext($this->newimage, $font_size_px, 0, $left, $top, ImageColorExact($this->newimage, $r, $g, $b), $fontfile, $str_text);
			return true;
		}
		else
			return false;
	}
	
	function check_gd()
	{
		if (parent::check_gd() && function_exists('imagettftext') && function_exists('imagettfbbox'))
			return true;
		else
			return false;
	}
}

?>