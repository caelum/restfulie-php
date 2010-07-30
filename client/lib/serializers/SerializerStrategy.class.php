<?php

class SerializerStrategy {
  
  private $mediatypes;
  private $serializers;
  
  public SerializerStrategy($mediatypes){
    $this->mediatypes = $mediatypes;
    $serializers = array();
    $serializers['default'] = new DefaultSerializer();
    $serializers[200] = new SucessSerializer();
    $serializers[201] = new RedirectSerializer();
    
  }
  
  public function serializer($request){
    $serializer = $serializers[$request->getResponseCode()];
    if ($serializer == null) $serializer = $serializers['default'];
   
    
    $serializer->serializer($resource,$request);
  }
}


?>
