<?php
require_once 'serializers/SerializerStrategy.class.php';

class EntryPoint {

	private $uri;
	private $headers = array ("Accept"=>"", "Content-Type"=>"application/xml");

	public function EntryPoint($uri){
		$this->uri = $uri;
		$this->asFor("application/xml");
	}

	public function get(){
		return $this->request_a(HttpRequest::METH_GET);
	}

	public function delete(){
		return $this->request_a(HttpRequest::METH_DELETE);
	}
	
	public function post($resource){
		return $this->request_a_payload($resource,HttpRequest::METH_POST);
	}

	public function accepts($accept){
		$this->headers['Accept'] = $accept;
		return $this;
	}

	public function asFor($contentType){
		$this->headers['Content-Type'] = $contentType;
		return $this;
	}

	private function getAccept(){
		if ($this->headers["Accept"] != "" || $this->headers["Accept"] != null )
		return $this->headers["Accept"];
			
		$accepts = "";
		foreach (Restfulie::getMediaTypes() as $key => $value) {
			$accepts = $accepts.$key."; ";
		}

		return $accepts;
	}

	private function request_a_payload($resource,$method){
		$this->accepts($this->getAccept());
		$request = new HttpRequest($this->uri, $method);
		$request->setHeaders($this->headers);
		$header = $this->headers['Content-Type'];
		$mediatypes = Restfulie::getMediaTypes();
		$mediaEncoder = $mediatypes[$header];
		$responseBackup = $resource->response;
		unset($resource->response);
		$request->setRawPostData($mediaEncoder->marshal($resource));
		$resource->response = $responseBackup;
		$request->send();
		$serializerFactory = new SerializerStrategy(Restfulie::getMediaTypes());
		return $serializerFactory->serializer($request);
	}

	private function request_a($method){
		$request = new HttpRequest($this->uri, $method);
		$request->setHeaders($this->headers);
		$request->send();
		$serializerFactory = new SerializerStrategy(Restfulie::getMediaTypes());
		return $serializerFactory->serializer($request);
	}

}
?>
