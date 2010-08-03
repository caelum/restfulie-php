<?php
require_once "MediaType.class.php";

class MediaTypeJSON implements MediaType {
	public function marshal($object){
		return json_encode($object);
	}

	public function unmarshal($request){
		$content = $request->getResponseBody();
		return json_decode($content);
	}
}
?>
