<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Complaints;
use App\Complaints_Subjects;
use App\User;
use Illuminate\Support\Facades\Redirect;
use DataTable;
use DataTable2;
use Modal;
use Auth;
use jDate;
use Hash;
use Response;
use Image;
use File;
use DB;
class MainController extends Controller
{
	public function setUser(){
		$userId=$_GET['userId'];
		$userName=$_GET['userName'];
		session(['user' => $userId]);
		session(['name' => $userName]);	
		if (!empty($_GET['consignment'])) {
			return Redirect::route('allComplaint', ['createSpcCom' => $_GET['consignment']]);
		}else{
			return Redirect::route('allComplaint', ['createSpcCom' => false]);
		}
		
	}
	public function allComplaint(Request $req){
		$createSpcCom= $req->input('createSpcCom');
		$Complaints_Subjects=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
		$Complaints = DB::table('tbl_complaints')->whereRaw('tbl_complaints.created_at in (select max(created_at) from tbl_complaints where tbl_complaints.fld_Suspend = false group by (fld_Consignment))')->join('tbl_complaints_subjects', 'tbl_complaints.fld_Subject', '=', 'tbl_complaints_subjects.fld_Id')->orderBy('tbl_complaints.created_at','desc')->select('tbl_complaints.*', 'tbl_complaints_subjects.fld_Complaints_Subjects')->get();
		foreach ($Complaints as $Complaint) {
			$Complaintcount=Complaints::where([['fld_Consignment','=',$Complaint->fld_Consignment],['fld_Suspend','=',false]])->count();
			$Complaint->count=$Complaintcount;
		}
		$user=session('user');
		$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','از طرف',' توسط','تاریخ ثبت','مرحله'),$Complaints);
		return view('showAllComplaint')->with('Table', $table->Data())->with('user',$user)->with('Subjects',$Complaints_Subjects)->with('createSpcCom',$createSpcCom);;
	}
	public function allSpcComplaint($id){
		$userId=$_GET['userId'];
		$userName=$_GET['userName'];
		session(['user' => $userId]);
		session(['name' => $userName]);	
		$Complaints_Subjects=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
		$Complaints = DB::table('tbl_complaints')->where('tbl_complaints.fld_Suspend','=',false)->where('fld_Consignment','=',$id)->join('tbl_complaints_subjects', 'tbl_complaints.fld_Subject', '=', 'tbl_complaints_subjects.fld_Id')->orderBy('tbl_complaints.created_at','desc')->select('tbl_complaints.*', 'tbl_complaints_subjects.fld_Complaints_Subjects')->get();
		foreach ($Complaints as $Complaint) {
			$Complaintcount=Complaints::where([['fld_Consignment','=',$Complaint->fld_Consignment],['fld_Suspend','=',false]])->count();
			$Complaint->count=$Complaintcount;
		}
		$createSpcCom =$id;
		$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','از طرف',' توسط','تاریخ ثبت','مرحله','اقدامات'),$Complaints);
		return view('showAllSpcComplaint')->with('Table', $table->Data())->with('Subjects',$Complaints_Subjects)->with('createSpcCom',$createSpcCom);
	}
	public function addComplaint(){
		$Complaints=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
		return view('addComplaint')->with('Complaints',$Complaints);
	}
	public function newComplaint( Request $req){

		if (!empty($req->input('Complaints'))&&!empty($req->input('Consignment'))&&!empty($req->input('Description'))&&!empty($req->input('Registrar'))) {
			$complaint=new Complaints;
			$user=session('user');
			$user_name=session('name');	
			$complaint->fld_User=$user;
			$complaint->fld_User_Name=$user_name;
			$complaint->fld_Subject=$req->input('Complaints');
			$complaint->fld_Consignment=$req->input('Consignment');
			$complaint->fld_Description=$req->input('Description');
			$complaint->fld_Registrar=$req->input('Registrar');
			$complaint->fld_Level=1;
			$complaint->save();
			$Complaints_Subjects=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
			$Complaints = DB::table('tbl_complaints')->whereRaw('tbl_complaints.created_at in (select max(created_at) from tbl_complaints where tbl_complaints.fld_Suspend = false group by (fld_Consignment))')->join('tbl_complaints_subjects', 'tbl_complaints.fld_Subject', '=', 'tbl_complaints_subjects.fld_Id')->orderBy('tbl_complaints.created_at','desc')->select('tbl_complaints.*', 'tbl_complaints_subjects.fld_Complaints_Subjects')->get();
			foreach ($Complaints as $Complaint) {
				$Complaintcount=Complaints::where([['fld_Consignment','=',$Complaint->fld_Consignment],['fld_Suspend','=',false]])->count();
				$Complaint->count=$Complaintcount;
			}
			if($req->input('Spc')!="Spc"){
				$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','از طرف',' توسط','تاریخ ثبت','مرحله'),$Complaints);
				return view('refreshComplaint')->with('Table', $table->Data())->with('user',$user)->with('Subjects',$Complaints_Subjects)->render();
			}else{
			$Complaints = DB::table('tbl_complaints')->where('tbl_complaints.fld_Suspend','=',false)->where('fld_Consignment','=',$req->input('Consignment'))->join('tbl_complaints_subjects', 'tbl_complaints.fld_Subject', '=', 'tbl_complaints_subjects.fld_Id')->orderBy('tbl_complaints.created_at','desc')->select('tbl_complaints.*', 'tbl_complaints_subjects.fld_Complaints_Subjects')->get();
				$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','از طرف',' توسط','تاریخ ثبت','مرحله','اقدامات'),$Complaints);
				return view('refreshComplaintSpc')->with('Table', $table->Data())->with('createSpcCom',$req->input('Consignment'))->with('user',$user)->with('Subjects',$Complaints_Subjects)->render();
			}
			

		}
	}
	public function showComplaint($id){
		$Complaint=Complaints::where('fld_Id','=',"$id")->first();
		$ComplaintsSub= Complaints_Subjects::all();
		return view('showEditComplain')->with('Complaint',$Complaint)->with('ComplaintsSub',$ComplaintsSub);  
	}
	public function editComplaint(Request $req){
		$complaint=Complaints::where('fld_Id','=',$req->input('Id'))->first();
		$complaint->fld_Subject=$req->input('Complaints');
		$complaint->fld_Consignment=$req->input('Consignment');
		$complaint->fld_Description=$req->input('Description');
		$complaint->fld_Level=$req->input('Level');
		$complaint->save();
		return Redirect::back()->withErrors(['شکایت  با موفقیت تغیر یافت']);
	}
	public function removeComplaint(Request $req){
		$complaint=Complaints::where('fld_Id','=',$req->input('id'))->first();
		$complaint->fld_Suspend=true;
		$complaint->save();
	}
	public function changeLevel(Request $req){
		$complaint=Complaints::where('fld_Id','=',$req->input('id'))->first();
		$complaint->fld_Level=$req->input('level');
		$complaint->save();
		$user=Auth::user();
		$Complaints_Subjects=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
		$Complaints = DB::table('tbl_complaints')->whereRaw('tbl_complaints.created_at in (select max(created_at) from tbl_complaints where tbl_complaints.fld_Suspend = false group by (fld_Consignment))')->join('tbl_complaints_subjects', 'tbl_complaints.fld_Subject', '=', 'tbl_complaints_subjects.fld_Id')->orderBy('tbl_complaints.created_at','desc')->select('tbl_complaints.*', 'tbl_complaints_subjects.fld_Complaints_Subjects')->get();
		foreach ($Complaints as $Complaint) {
			$Complaintcount=Complaints::where([['fld_Consignment','=',$Complaint->fld_Consignment],['fld_Suspend','=',false]])->count();
			$Complaint->count=$Complaintcount;
		}
		$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','از طرف',' توسط','تاریخ ثبت','مرحله'),$Complaints);
		return view('refreshComplaint')->with('Table', $table->Data())->with('user',$user)->with('Subjects',$Complaints_Subjects)->render();
	}
	public function allSubject(){
		$Complaints_Subject=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
		$user=session('user');
		$table = new DataTable2(array('موضوع'), $Complaints_Subject);
		return view('showAllComplaintSubjects')->with('Table', $table->Data())->with('user',$user);
	}
	public function ComplainSubject($id){
		$ComplaintsSubject= Complaints_Subjects::where('fld_Id','=',"$id")->first();
		return view('showEditComplainSubject')->with('ComplaintsSubject',$ComplaintsSubject); 
	}
	public function editComplaintSubject(Request $req){
		$complaint=Complaints_Subjects::where('fld_Id','=',$req->input('id'))->first();
		$complaint->fld_Complaints_Subjects=$req->input('sub');
		$complaint->save();
	}
	public function addComplaintSubject(Request $req){
		$Subject=new Complaints_Subjects;
		$Subject->fld_Complaints_Subjects=$req->input('sub');
		$Subject->save();
		return Redirect::back()->withErrors(['موضوع  با موفقیت ذخیره شد']);
	}
	public function RemoveSubject(Request $req){
		$complaint=Complaints_Subjects::where('fld_Id','=',$req->input('id'))->first();
		$complaint->fld_Suspend=true;
		$complaint->save();
	}
	public function showAdmins(){
		$user=session('user');
		$Users=User::where('fld_Suspend', '=',false)->get();
		$table = new DataTable2(array('نام و نام خانوادگی', 'نام کاربری','تصویر پروفایل','آخرین لاگین','زمان ساخت'),$Users);
		return view('showAllAdmins')->with('Table', $table->Data())->with('user',$user);
	}
	public function complaintHistory(Request $request){
		$Complaints=Complaints::where([['fld_Suspend', '=', false],['fld_Consignment', '=', $request->input('id')],])->orderBy('created_at', 'DESC')->get();
		return view('table')->with('Complaints',$Complaints)->render();
	}
	public function hasComplain($id){
		header("Access-Control-Allow-Origin: *");
		$Complaint= Complaints::where([['fld_Consignment','=',$id],['fld_Suspend','=',false]])->first();
		if (!empty($Complaint)) {
			return response()->json([
				'result' => true
			]);
		}else{
			return response()->json([
				'result' => false
			]);
		}
	}
}
