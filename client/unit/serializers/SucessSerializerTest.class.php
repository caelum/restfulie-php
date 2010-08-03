<?php
require_once 'PHPUnit/Framework.php';
require_once '../lib/mediatypes/MediaTypeJSON.class.php';
require_once 'helpers/DummyRequest.class.php';

class SucessSerializerTest extends PHPUnit_Framework_TestCase {

	private $fixture_json_resource;

	public function setUp(){
		$this->fixture_json_resource  = file_get_contents("fixtures/jsonResourceExpected");
	}

	public function test_Should_serialize_response_result_with_request_status_code_at_200_using_correctly_media_type(){
		print("\nUnit Testing serializers");
		print("\n  Should serialize response result with request status code at 200 using correctly media type ");

		$mediatypes= array("application/json"=>new MediaTypeJSON());
		$serializer = new SucessSerializer();
		$headers = array("Content-Type"=>"application/json");
		$request = new DummyRequest(200,$this->fixture_json_resource,$headers);
		$resource = $serializer->serializer($mediatypes,$request);

		$this->assertEquals($resource->item->name,"Calpis");
	}

}
?>
