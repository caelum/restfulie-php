<?php

require_once 'PHPUnit/Framework.php';
require_once '../lib/mediatypes/MediaTypeXML.class.php';
require_once 'helpers/DummyRequest.class.php';

class MediaTypeXMLTest extends PHPUnit_Framework_TestCase {

	private $fixture_xml_resource;

	public static function before_suite(){
		print("a\n");
	}

	public function setUp(){
		$this->fixture_xml_resource  = file_get_contents("fixtures/xmlResourceExpected");
	}

	public function test_Should_unmarshal_xmlhash_to_using_MediaTypeXML(){
		print("\nUnit Testing MediaTypeXML");
		print("\n  Should unmarshal xml hash to using MediaTypeXML ");

		$mediatype = new MediaTypeXML();
		$request = new DummyRequest(200,$this->fixture_xml_resource);
		$resource = $mediatype->unmarshal($request);

		$this->assertEquals( $resource->item->name , "Calpis" );
	}

	public function test_Should_marshal_object_to_xmlhash_using_MediaTypeXML(){
		print("\n  Should marshal object to xml hash using MediaTypeXML ");

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
}

?>
