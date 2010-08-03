<?php

require_once "PHPUnit/Framework/TestSuite.php";
require_once "RestfulieTest.class.php";
require_once "mediatypes/MediaTypeXMLTest.class.php";
require_once "mediatypes/MediaTypeJSONTest.class.php";
require_once "serializers/SucessSerializerTest.class.php";
require_once "serializers/RedirectSerializerTest.class.php";
require_once "serializers/DefaultSerializerTest.class.php";

class AllTests {

	public static function suite(){
		$suite = new PHPUnit_Framework_TestSuite();
		$suite->addTestSuite("MediaTypeXMLTest");
		$suite->addTestSuite("MediaTypeJSONTest");
		$suite->addTestSuite("SucessSerializerTest");
		$suite->addTestSuite("RedirectSerializerTest");
		$suite->addTestSuite("DefaultSerializerTest");
		$suite->addTestSuite("RestfulieTest");
		return $suite;
	}

}


?>
