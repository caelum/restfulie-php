<?php

require_once "Serializer.class.php";

class DefaultSerializer implements Serializer {
	public function serializer($mediatypes,$request){
		$resource = new stdClass;
		$resouce->response = new stdClass();
		$resouce->response->body = $request->getResponseBody();
		$resouce->response->code = $request->getResponseCode();
		return $resource;
	}
}

?>
