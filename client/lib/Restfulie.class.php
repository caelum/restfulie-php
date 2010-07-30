<?php
require_once "EntryPoint.class.php";
require_once "mediatypes/MediaTypeJSON.class.php";

class Restfulie {


  private static $mediaTypes = array();
  
  
  public static function at($uri){
    return new EntryPoint($uri);
  }
  
  public function getMediaTypes(){
    if ($self->mediaTypes == null) {
      $self->initDefaultMediaTypes();
    }
    return $self->mediaTypes;
  }
  
  private static function  initDefaultMediaTypes(){
    $self->mediaTypes['application/xml'] = new MediaTypeXML();
    $self->mediaTypes['application/json'] = new MediaTypeJSON();
  }
  
}

?>
