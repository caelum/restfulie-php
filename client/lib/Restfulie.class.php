<?php
require_once "EntryPoint.class.php";
require_once "mediatypes/MediaTypeJSON.class.php";
require_once "mediatypes/MediaTypeXML.class.php";

class Restfulie {


	private static $mediaTypes = array();


	public static function at($uri){
		return new EntryPoint($uri);
	}

	public static function getMediaTypes(){
		if (Restfulie::$mediaTypes == null) {
			Restfulie::initDefaultMediaTypes();
		}
		return Restfulie::$mediaTypes;
	}

	private static function initDefaultMediaTypes(){
		Restfulie::$mediaTypes['application/xml'] = new MediaTypeXML();
		Restfulie::$mediaTypes['application/json'] = new MediaTypeJSON();
	}

}

?>
