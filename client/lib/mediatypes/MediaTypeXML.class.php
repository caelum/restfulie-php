<?php
  require_once "MediaType.class.php";
  require_once "XMLSerializer.class.php";

  class MediaTypeXML implements MediaType {
    public function marshal($object){
      return XMLSerializer::generateValidXmlFromObj($object);
    }
    public function unmarshal($request){
      $content = $request->getResponseBody();
      $xml = simplexml_load_string($content);
      $aux = new stdClass;
      $cmd = "\$aux->{$xml->getName()} = \$xml;";
      eval($cmd);
      return json_decode(json_encode($aux));
    }
  }
?>
