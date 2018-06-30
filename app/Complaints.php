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
	public function getCat()
	{
		return $this->hasOne('App\Complaints_Category','fld_Id','fld_Cat_Name'); 
	}	
	public function getUser()
	{
		return $this->hasOne('App\User','fld_Id','fld_User'); 
	}

}
