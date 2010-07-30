<?php

require_once "Serializer.class.php";

class SucessSerializer implements Serializer {
  
  public function serializer($mediatypes,$request){
    $marshaller = $mediatypes[$request->getResponseHeader("Content-Type")];
    $resouce = new stdClass;
    if ($marshaller != null) $resource = $marshaller->unmarshal($request);
    return $resource;
  }
  
}
?>
