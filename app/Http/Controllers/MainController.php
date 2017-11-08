<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Complaints;
use App\Complaints_Subjects;
use Illuminate\Support\Facades\Redirect;
use DataTable;
use DataTable2;
class MainController extends Controller
{
    public function allComplaint(){
     //   $Complaints= Complaints::join('tbl_complaints_subjects','tbl_complaints_subjects.fld_Id','=','tbl_complaints.fld_Subject')->select('fld_Consignment', 'fld_Complaints_Subjects','fld_Description','fld_Level')->get();
         $Complaints=Complaints::all();
         $table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','مرحله'),$Complaints);
         return view('showAllComplaint')->with('Table', $table->Data());
    }
    public function addComplaint(){
    	$Complaints= Complaints_Subjects::all();
    	//return "موضوع :".$res->getComplaint->fld_Complaints_Subjects ."<br>"."شماره بارنامه :"."$res->fld_Consignment"."<br>"."توضیحات :"."$res->fld_Description"."<br>"."مرحله :"."$res->fld_Level";
    	return view('addComplaint')->with('Complaints',$Complaints);
    }
    public function newComplaint( Request $req){
    	$complaint=new Complaints;
    	$complaint->fld_Subject=$req->input('Complaints');
    	$complaint->fld_Consignment=$req->input('Consignment');
    	$complaint->fld_Description=$req->input('Description');
    	$complaint->fld_Level=1;
    	$complaint->timestamps = false;
    	$complaint->save();
        return Redirect::back()->withErrors(['شکایت شما با موفقیت ثبت شد .']);
    }

}
