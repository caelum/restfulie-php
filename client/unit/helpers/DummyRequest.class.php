<?php

class DummyRequest {

	private $code;
	private $body;
	private $headers;

	public function DummyRequest($code,$body = null,$headers = null){
		$this->code = $code;
		$this->body = $body;
		$this->headers = $headers;
	}

	public function getResponseBody(){
		return $this->body;
	}

	public function getResponseCode(){
		return $this->code;
	}

	public function getResponseHeaders(){
		return $this->headers;
	}

	public function getResponseHeader($header){
		return $this->headers[$header];
	}
	
	public function getHeaders(){
		
	}

}

?>

