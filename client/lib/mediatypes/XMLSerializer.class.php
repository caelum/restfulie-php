<?php

class XMLSerializer {

	public static function generateValidXmlFromObj(stdClass $obj) {
		$arr = get_object_vars($obj);
		return self::generateValidXmlFromArray($arr);
	}

	public static function generateValidXmlFromArray($array) {
		$xml = '<?xml version="1.0" encoding="UTF-8" ?>';
		$xml .= self::generateXmlFromArray($array);
		return $xml;
	}

	private static function generateXmlFromArray($array) {
		$xml = '';
		if (is_array($array) || is_object($array)) {
			foreach ($array as $key=>$value) {
				if (is_numeric($key)) {
					$xml .= self::generateXmlFromArray($value);
				} else {
					$xml .= '<' . $key . '>' . self::generateXmlFromArray($value) . '</' . $key . '>';
				}
			}
		} else {
			$xml = htmlspecialchars($array, ENT_QUOTES);
		}
		return $xml;
	}
}

?>
