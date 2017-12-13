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
class MainController extends Controller
{
	public function allComplaint(){
//$Complaints=Complaints::join('tbl_complaints_subjects','tbl_complaints_subjects.fld_Id','=','tbl_complaints.fld_Subject')->select('fld_Consignment', 'fld_Complaints_Subjects','fld_Description','fld_Level')->get();
		$Complaints=Complaints::all();
		$user=Auth::user();
		$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','مرحله'),$Complaints);
		return view('showAllComplaint')->with('Table', $table->Data())->with('user',$user);
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
		$complaint->save();
		return Redirect::back()->withErrors(['شکایت شما با موفقیت ثبت شد']);
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
	public function changeLevel(Request $req){
		$complaint=Complaints::where('fld_Id','=',$req->input('id'))->first();
		$complaint->fld_Level=$req->input('level');
		$complaint->save();
	}
	public function loginForm(){
		if($user = Auth::user())
			{
				return redirect()->route('allComplaint');
			}
			return view('showLoginForm');
		}
		public function login(Request $req){
			if (Auth::attempt(['fld_Username' => trim($req->input('username')), 'password' => $req->input('password')])) {
				$user= Auth::user();
				session()->put('lastLogin', $user->fld_Last_Login);
				$user->fld_Last_Login=now();
				$user->fld_Ip=$req->ip();
				$user->fld_Browser=$req->header('User-Agent');
				$user->save();
				return redirect()->intended('/All');
			} else {
				return view('showLoginForm')->withErrors(['نام کاربری یا گذرواژه صحیح نیست'])->withInput($req->all());
			}
		}
		public function logout(){
			session()->flush();
			Auth::logout();
			return redirect()->route('login');
		}
		public function allSubject(){
			$Complaints_Subject=Complaints_Subjects::all();
			$user=Auth::user();
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
			$Subject->fld_Complaints_Subjects=$req->input('Subject');
			$Subject->save();
			return Redirect::back()->withErrors(['موضوع  با موفقیت ذخیره شد']);
		}
		public function RemoveSubject(Request $req){
			$complaint=Complaints_Subjects::where('fld_Id','=',$req->input('id'))->first();
			$complaint->delete();
		}
/*public function test(){
$Complaints=Complaints::all();
$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','مرحله'),$Complaints);
return view('index')->with('Table', $table->Data());
}*/
public function showAdmins(){
	$user=Auth::user();
	$Users=User::all();
	$table = new DataTable2(array('نام و نام خانوادگی', 'نام کاربری', 'آخرین لاگین','زمان ساخت'),$Users);
	return view('showAllAdmins')->with('Table', $table->Data())->with('user',$user);
}
public function addAdmin(Request $req){
	if (empty($req->input('username')) || empty($req->input('password')) || empty($req->input('name')))  {
		return Response::json(['error400' => 'تمامی فیلد ها را پر کنید'], 400);
	}
	$userExs = User::where('fld_Username', '=', $req->input('username'))->first();
	if ($userExs) {
		return Response::json(['error409' => 'مدیری با این آیدی وجود دارد'], 409);
	}
	$user= new User;
	$user->fld_Username=$req->input('username');
	$user->fld_Name=$req->input('name');
	$user->fld_Password=Hash::make($req->input('password'));
	$user->save();
	return response()->json($user);
}
public function changeAdmin(Request $req){
	$userExsCount = User::where('fld_Username', '=', $req->input('username'))->count();
	$user=User::where('fld_Id','=',$req->input('id'))->first();
	if (empty($req->input('username')) ||  empty($req->input('name')))  {
		return Response::json(['error400' => 'تمامی فیلد ها را پر کنید'], 400);
	}
	if ( $req->input('username') == $user->fld_Username ) {
		$userExsCount--;
	}
	if($userExsCount<1){
		$user->fld_Username=$req->input('username');
	}else{
		return Response::json(['error409' => 'مدیری با این آیدی وجود دارد'], 409);
	}
	$user->fld_Name=$req->input('name');
	$user->save();
}
public function deleteAdmin(Request $req){
	$user=User::where('fld_Id','=',$req->input('id'))->first();
	$user->delete();
}
}
