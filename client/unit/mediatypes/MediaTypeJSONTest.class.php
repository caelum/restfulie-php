<?php
require_once 'PHPUnit/Framework.php';
require_once '../lib/mediatypes/MediaTypeJSON.class.php';
require_once 'helpers/DummyRequest.class.php';

class MediaTypeJSONTest extends PHPUnit_Framework_TestCase {

	private $fixture_json_resource;

	public function setUp(){
		$this->fixture_json_resource  = file_get_contents("fixtures/jsonResourceExpected");
	}

	public function test_Should_unmarshal_jsonhash_to_object_using_MediaTypeJSON(){
		print("\nUnit Testing MediaTypeJSON");
		print("\n  Should unmarshal json hash to object using MediaTypeJSON ");

		$mediatype = new MediaTypeJSON();
		$body = "{\"item\":{\"name\":\"calpis\",\"price\":12.4}}";
		$request = new DummyRequest( 200 , $body );
		$resource = $mediatype->unmarshal( $request );

		$this->assertEquals($resource->item->name,"calpis");
	}

	public function test_Should_marshal_object_to_jsonhash_using_MediaTypeJSON(){
		print("\n  Should marshal object to json hash using MediaTypeJSON ");

		$mediatype = new MediaTypeJSON();
		$hash = "{\"item\":{\"name\":\"calpis\",\"price\":12.4}}";
		$object = json_decode($hash);
		$json = $mediatype->marshal($object);

		$this->assertEquals($json ,$hash);
	}

}
?>
