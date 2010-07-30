<?php
require_once "EntryPoint.class.php";

class Restfulie {
  public static function at($uri){
    return new EntryPoint($uri);
  }
}

?>
