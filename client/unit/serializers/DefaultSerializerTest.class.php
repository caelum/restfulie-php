<?php
require_once 'PHPUnit/Framework.php';
require_once '../lib/mediatypes/MediaTypeJSON.class.php';
require_once 'helpers/DummyRequest.class.php';

class DefaultSerializerTest extends PHPUnit_Framework_TestCase {

	private $fixture_json_resource;

	public function setUp(){
		$this->fixture_json_resource  = file_get_contents("fixtures/jsonResourceExpected");
	}

	public function test_Should_retrive_raw_resource_at_for_default_serializer(){
		print("\n  Should retrive raw resource at for default serializer ");

		$serializer = new DefaultSerializer();
		$request = new DummyRequest(404,"body");
		$resource = $serializer->serializer(null,$request);
		$this->assertNotNull( $resource );
	}

}
?>
