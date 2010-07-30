<?php
require_once 'PHPUnit/Framework.php';
require_once '../lib/Restfulie.class.php';
require_once '../lib/mediatypes/MediaTypeXML.class.php';
require_once '../lib/mediatypes/MediaTypeJSON.class.php';
require_once 'helpers/DummyRequest.class.php';
require_once 'helpers/DummyEntryPointFactory.class.php';
require_once 'helpers/DummyEntryPoint.class.php';
require_once "../lib/serializers/SucessSerializer.class.php";
require_once "../lib/serializers/RedirectSerializer.class.php";

class RestfulieTest extends PHPUnit_Framework_TestCase {
  
  private $fixture_xml_resource;
  private $fixture_json_resource;

  public function setUp(){
    $this->fixture_xml_resource  = file_get_contents("fixtures/xmlResourceExpected");
    $this->fixture_json_resource  = file_get_contents("fixtures/jsonResourceExpected");
  }
  

  public function test_Should_retrive_raw_resource(){
    print("\nShould retrive raw resource ");

    $resource = Restfulie::at("http://localhost:3000/items")->get();

    $this->assertEquals( $resource->response->code , 200 );
    $this->assertNotNull( $resource->response->body );
  }

  public function test_Should_unmarshal_xmlhash_to_using_MediaTypeXML(){
    print("\nShould unmarshal xml hash to using MediaTypeXML ");

    $mediatype = new MediaTypeXML();
    $request = new DummyRequest(200,$this->fixture_xml_resource);
    $resource = $mediatype->unmarshal($request);

    $this->assertEquals( $resource->item->name , "Calpis" );
  }
  
  public function test_Should_marshal_object_to_xmlhash_using_MediaTypeXML(){
    print("\nShould marshal object to xml hash using MediaTypeXML ");

    $mediatype = new MediaTypeXML();
    $resource = json_decode("{\"item\":{\"name\":\"calpis\",\"price\":12.4}}");
    $xml = $mediatype->marshal($resource);
    $expected_result = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
                        <item>
                          <name>calpis</name>
                          <price>12.4</price>
                        </item>";

    $expected_result = str_replace("\n","",$expected_result);
    $expected_result = str_replace("  ","",$expected_result);
    
    $this->assertEquals($xml,$expected_result);
  }
  
  public function test_Should_unmarshal_jsonhash_to_object_using_MediaTypeJSON(){
    print("\nShould unmarshal json hash to object using MediaTypeJSON ");

    $mediatype = new MediaTypeJSON();
    $body = "{\"item\":{\"name\":\"calpis\",\"price\":12.4}}";
    $request = new DummyRequest( 200 , $body );
    $resource = $mediatype->unmarshal( $request );

    $this->assertEquals($resource->item->name,"calpis");
  }
  
  public function test_Should_marshal_object_to_jsonhash_using_MediaTypeJSON(){
    print("\nShould marshal object to json hash using MediaTypeJSON ");
    
    $mediatype = new MediaTypeJSON();
    $hash = "{\"item\":{\"name\":\"calpis\",\"price\":12.4}}";
    $object = json_decode($hash);
    $json = $mediatype->marshal($object);

    $this->assertEquals($json ,$hash);
  }
  
  public function test_Should_retrive_body_for_accepts_passing_with_request(){
    print("\nShould retrive body for accepts passing with request ");

     $restfulie = Restfulie::at("http://localhost:3000/items/1");
     $restfulie->accepts("application/json");
     $resource = $restfulie->get();
     $expected = $this->fixture_json_resource;

     $this->assertEquals(trim($resource->response->body),trim($expected));
     
     $restfulie->accepts("application/xml");
     $resource = $restfulie->get();
     $expected = $this->fixture_xml_resource;

     $this->assertEquals($resource->response->body,$expected);
  }
  
  public function test_Should_serialize_response_result_with_request_status_code_at_200_using_correctly_media_type(){
    print("\nShould serialize response result with request status code at 200 using correctly media type ");

    $mediatypes= array("application/json"=>new MediaTypeJSON(), "application/xml"=> new MediaTypeXML());
    $serializer = new SucessSerializer();
    $headers = array("Content-Type"=>"application/json");
    $request = new DummyRequest(200,$this->fixture_json_resource,$headers);
    $resource = $serializer->serializer($mediatypes,$request);

    $this->assertEquals($resource->item->name,"Calpis");
  }

  public function test_Should_follow_the_link_location_in_header_to_answer_201(){
    print("\nShould follow the link location in header to answer 201 ");
    
    $serializer = new RedirectSerializer(new DummyEntryPointFactory());
    $headers = array("Location"=>"http://localhost/newresource","Accept"=>"application/xml");
    $request = new DummyRequest(201,"",$headers);
    $resource = $serializer->serializer(null,$request);
    
    $this->assertNotNull($resource);
  }

}

?>
