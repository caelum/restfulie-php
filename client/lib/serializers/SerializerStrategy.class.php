<?php
require_once "EntryPointFactory.class.php";

class SerializerStrategy {

	private $mediatypes;
	private $serializers;

	public function SerializerStrategy($mediatypes) {
		$this->mediatypes = $mediatypes;
		$this->serializers = array();
		$this->serializers['default'] = new DefaultSerializer();
		$this->serializers[200] = new SucessSerializer();
		$this->serializers[201] = new RedirectSerializer(new EntryPointFactory());
	}

	public function serializer($request){
		$serializer = null;
		try{
			$serializer = $this->serializers[$request->getResponseCode()];
		} catch(Exception $e) {}
		if ($serializer == null) $serializer = $this->serializers['default'];
		
		$result = $serializer->serializer($this->mediatypes,$request);
		return $result;
	}
}


?>
