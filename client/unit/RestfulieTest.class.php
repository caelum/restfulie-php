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
require_once "../lib/serializers/DefaultSerializer.class.php";

class RestfulieTest extends PHPUnit_Framework_TestCase {

	private $fixture_xml_resource;
	private $fixture_json_resource;

	public function setUp(){
		$this->fixture_xml_resource  = file_get_contents("fixtures/xmlResourceExpected");
		$this->fixture_json_resource  = file_get_contents("fixtures/jsonResourceExpected");
	}


	public function test_Should_retrive_raw_resource(){
		print("\n\nFunctional Tests for Restfulie");
		print("\n  Should retrive raw resource ");
		$resource = Restfulie::at("http://127.0.0.1:3000/items")->get();
		$this->assertEquals($resource->items->item[0]->name,'Calpis');
		$this->assertEquals( $resource->response->code , 200 );
		$this->assertNotNull( $resource->response->body );
	}


	public function test_Should_retrive_body_for_accepts_passing_with_request(){
		print("\n  Should retrive body for accepts passing with request ");

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

	public function test_Should_support_posting_resources(){
		print("\n  Should support posting resources");
		$resource = Restfulie::at("http://localhost:3000/items/1")->get();
		$resource->item->name = 'new resource';
		$posted_resource = Restfulie::at("http://localhost:3000/items")->post($resource);
		$this->assertNotEquals($posted_resource->item->id,$resource->item->id);
		$this->assertEquals($posted_resource->response->code,200);
	}
}

?>
