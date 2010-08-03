<?php

interface MediaType {
	public function marshal($object);
	public function unmarshal($request);
}

?>
