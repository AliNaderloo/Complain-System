<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model

{
	protected $primaryKey = 'fld_Id';
	protected $table = 'tbl_complaints';
	public function getComplaint()
	{
		return $this->hasOne('App\Complaints_Subjects','fld_Id','fld_Subject'); 
	}	
	

}
