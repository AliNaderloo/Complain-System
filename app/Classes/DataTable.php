<?php 
namespace App\Classes;

class DataTable {
  private $header;
  private $recipients;
  private $subject;
  private $body;
  public function __construct($headers,$modelData) {
     //  $i=0;
     // $this->elmt="<table id=".'"'."DataTable".'"'."class=".'"'."display".'"'."cellspacing=".'"'."0".'"'."width=".'"'."100%".'"'.">"."<thead>"."<tr>";
    foreach ($headers as $head ) {
           // $heads .= "<th>$head</th>";
     $this->head[]=$head;
           //$i++;
   }
     //  $this->elmt .="$heads"."</tr>"."<tfoot>"." <tr>"."$heads"."</tr>"."</tfoot>"."<tbody>";
     //  $i=0;
   foreach ($modelData->toArray() as $data) {
    $this->data[]=$data;
          // $i++;
          // $body .="<tr>"."<th>$Complaint->fld_Consignment</th>"."<th>".$Complaint->getComplaint->fld_Complaints_Subjects."</th>"."<th>$Complaint->fld_Description</th>"."<th>$Complaint->fld_Level</th>"."</tr>";
  }
       // $this->elmt.=$body."</tbody>"."</table>";
}

public function Data() {
  return $this;
}

}
?>