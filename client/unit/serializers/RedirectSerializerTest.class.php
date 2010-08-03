<?php
require_once 'PHPUnit/Framework.php';
require_once 'helpers/DummyRequest.class.php';
require_once 'helpers/DummyEntryPointFactory.class.php';

class RedirectSerializerTest extends PHPUnit_Framework_TestCase {

	private $fixture_json_resource;

	public function setUp(){
		$this->fixture_json_resource  = file_get_contents("fixtures/jsonResourceExpected");
	}

	public function test_Should_follow_the_link_location_in_header_to_answer_201(){
		print("\n  Should follow the link location in header to answer 201 ");

		$serializer = new RedirectSerializer(new DummyEntryPointFactory());
		$headers = array("Location"=>"http://localhost/newresource","Accept"=>"application/xml");
		$request = new DummyRequest(201,"",$headers);
		$resource = $serializer->serializer(null,$request);

		$this->assertNotNull($resource);
	}

}
?>
