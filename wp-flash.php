<?php
/*
Plugin Name: WP-Flash
Version: 1.1
Author: CyberSEO.net
Author URI: http://www.cyberseo.net/
Plugin URI: http://www.cyberseo.net/wp-flash/
Description: The WP-Flash plugin allows one to easily insert flash animation into WordPress blogs, using the following tag style: <strong>[swf:url width height]</strong>. Where <strong>url</strong> - URL of the flash object (SWF file) you want to embed; <strong>width</strong> - width of the flash object; <strong>height</strong> - height of the flash object.
*/

if (! function_exists ( "add_filter" )) {
	echo "WP-Flash v.1.1";
	die ();
}

function wpFlashParseMacro($string) {
	@list ( $url, $width, $height ) = explode ( " ", $string );
	return "<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" WIDTH=\"" . $width . "\" HEIGHT=\"" . $height . "\" id=\"" . $url . "\" ALIGN=\"\"><PARAM NAME=movie VALUE=\"" . $url . "\"><PARAM NAME=quality VALUE=high><EMBED src=\"" . $url . "\" quality=high  WIDTH=\"" . $width . "\" HEIGHT=\"" . $height . "\" NAME=\"" . $url . "\" TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\"></EMBED></OBJECT>";
}

function wpFlashInsertSwf($content) {
	return preg_replace ( "'\[swf:(.*?)\]'ie", "stripslashes(wpFlashParseMacro('\\1'))", $content );
}

add_filter ( 'the_content', 'wpFlashInsertSwf' );
add_filter ( 'the_excerpt', 'wpFlashInsertSwf' );
?>