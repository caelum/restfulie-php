<?php
require_once "../EntryPoint.class.php";

class EntryPointFactory {
  public function create($uri){
    return new EntryPoint($uri);
  }
}

?>
