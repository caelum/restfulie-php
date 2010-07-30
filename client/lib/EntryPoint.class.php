<?php

class EntryPoint {

  private $uri;
  private $headers = array ("Accept"=>"", "Content-Type"=>"application/xml");
  
  public function EntryPoint($uri){
    $this->uri = $uri;
  }
  
  public function get(){
    return $this->request_a(HttpRequest::METH_GET);
  }
  
  private function request_a($method){
    $request = new HttpRequest($this->uri, $method);
    $request->setHeaders($this->headers);
    $request->send();

    $retorno = new stdClass();
    $retorno->response = new stdClass();
    $retorno->response->body = $request->getResponseBody();
    $retorno->response->code = $request->getResponseCode();
    return $retorno;
  }
  
}
/*


// use for create dynamic data object
class Dynamic {}
*/

?>
