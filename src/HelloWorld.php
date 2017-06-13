<?PHP

namespace Parcelmonkey;

class HelloWorld extends request {
  
  var $uri = '/HelloWorld';
  var $method = 'POST';
  
  function setEcho($string) {
    
    $this->payload['echo'] = $string;

  }
  
}

?>