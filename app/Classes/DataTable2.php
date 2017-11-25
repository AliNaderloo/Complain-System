<?php 
namespace App\Classes;

class DataTable2 {
  private $header;
  private $recipients;
  private $subject;
  private $body;
  public function __construct($headers,$modelData) {
    
    foreach ($headers as $head ) {
     $this->head[]=$head;
   }
   $this->data=$modelData;
 }

 public function Data() {
  return $this;
}

}
?>