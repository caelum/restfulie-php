<?php

require_once "Serializer.class.php";

class SucessSerializer implements Serializer {

	public function serializer($mediatypes,$request){
		$contentType = explode(";",$request->getResponseHeader("Content-Type"));
		$marshaller = $mediatypes[$contentType[0]];
		$resource = new stdClass;
		if ($marshaller != null) $resource = $marshaller->unmarshal($request);
		
		$resource->response = new stdClass();
		$resource->response->body = $request->getResponseBody();
		$resource->response->code = $request->getResponseCode();
		
		return $resource;
	}

}
?>
