<?php
require_once 'PHPUnit/Framework.php';
require_once '../lib/Restfulie.class.php';
require_once '../lib/mediatypes/MediaTypeXML.class.php';
require_once '../lib/mediatypes/MediaTypeJSON.class.php';
require_once 'DummyRequest.class.php';

class RestfulieTest extends PHPUnit_Framework_TestCase {

  public function testRetriveRawResource(){
     $resource = Restfulie::at("http://localhost:3000/items")->get();
     $this->assertEquals($resource->response->code,200);
     $this->assertNotNull($resource->response->body);
  }

  public function testXmlMediaTypeUnmashal(){
    $mediatype = new MediaTypeXML();
    $body = '<?xml version="1.0"?>
    <item>
      <name>calpis</name>
      <price>12.4</price>
    </item>
    ';
    
    $request = new DummyRequest(200,$body,null);
    $resource = $mediatype->unmarshal($request);
    $this->assertEquals($resource->item->name,"calpis");
  }
  
  public function testXmlMediaTypeMashal(){
    $mediatype = new MediaTypeXML();

    $resource = json_decode("{\"item\":{\"name\":\"calpis\",\"price\":12.4}}");

    $xml = $mediatype->marshal($resource);
    $expected_result = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
    <item>
      <name>calpis</name>
      <price>12.4</price>
    </item>
    ";

    $expected_result = str_replace("  ","",str_replace("\n","",$expected_result));
    $this->assertEquals($xml,$expected_result);
  }
  
  public function testJsonMediaTypeUmashal(){
    $mediatype = new MediaTypeJSON();
    $body = "{\"item\":{\"name\":\"calpis\",\"price\":12.4}}";
    $request = new DummyRequest(200,$body,null);
    $resource = $mediatype->unmarshal($request);
    $this->assertEquals($resource->item->name,"calpis");
  }
  
  public function testJSONMediaTypeMashal(){
    $mediatype = new MediaTypeJSON();
    $hash = "{\"item\":{\"name\":\"calpis\",\"price\":12.4}}";
    $resource = json_decode($hash);

    $json = $mediatype->marshal($resource);
    $expected_result = $hash;

    $this->assertEquals($json ,$expected_result);
  }
  
  
}

?>
