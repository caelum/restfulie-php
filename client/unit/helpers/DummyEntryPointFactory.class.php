<?php

require_once "DummyEntryPoint.class.php";

class DummyEntryPointFactory {

	public function create($uri){
		return new DummyEntryPoint($uri);
	}

}
?>
