<?php

require_once "Serializer.class.php";

class RedirectSerializer implements Serializer {
  
  private $entryPointFactory;
  
  public function RedirectSerializer($entryPointFactory){
    $this->entryPointFactory = $entryPointFactory;
  }
  
  public function serializer($mediatypes,$request){
    $location = $request->getResponseHeader("Location");
    $accept = $request->getResponseHeader("Accept");
    $resource = $this->entryPointFactory->create($location)->accepts($accept)->get();
    return $resource;
  }
  
  
  
}
?>
