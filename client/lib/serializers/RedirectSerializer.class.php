<?php

require_once "Serializer.class.php";

class RedirectSerializer implements Serializer {

	private $entryPointFactory;

	public function RedirectSerializer($entryPointFactory){
		$this->entryPointFactory = $entryPointFactory;
	}

	public function serializer($mediatypes,$request){
		$location = $request->getResponseHeader("Location");
		$accepts = $request->getHeaders();
		$accept = $accepts["Content-Type"];
		$resource = $this->entryPointFactory->create($location)->accepts($accept)->get();
		return $resource;
	}



}
?>
