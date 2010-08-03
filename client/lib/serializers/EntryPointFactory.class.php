<?php
require_once "../lib/EntryPoint.class.php";

class EntryPointFactory {
	public function create($uri){
		return new EntryPoint($uri);
	}
}

?>
