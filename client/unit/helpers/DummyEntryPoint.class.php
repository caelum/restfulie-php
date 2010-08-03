<?php
class DummyEntryPoint {

	private $uri;
	private $headers = array ("Accept"=>"", "Content-Type"=>"application/xml");

	public function EntryPoint($uri){
		$this->uri = $uri;
	}

	public function get(){
		return new stdClass;
	}

	public function accepts($accept){
		$this->headers['Accept'] = $accept;
		return $this;
	}
}
?>

