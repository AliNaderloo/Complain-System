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
	public function allComplaint(){
		$Complaints_Subjects=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
	//	$Complaints=Complaints::where('fld_Suspend', '=',false)->select('fld_Id', DB::raw('MAX(created_at)  AS max_date'))->latest()->groupBy('fld_Consignment')->get();
		$Complaints = DB::table('tbl_complaints')->whereRaw('tbl_complaints.created_at in (select max(created_at) from tbl_complaints where tbl_complaints.fld_Suspend = false group by (fld_Consignment))')->join('tbl_users', 'tbl_complaints.fld_User', '=', 'tbl_users.fld_Id')->join('tbl_complaints_subjects', 'tbl_complaints.fld_Subject', '=', 'tbl_complaints_subjects.fld_Id')->orderBy('tbl_complaints.created_at','desc')->select('tbl_complaints.*', 'tbl_complaints_subjects.fld_Complaints_Subjects', 'tbl_users.fld_Name')->get();
		foreach ($Complaints as $Complaint) {
		$Complaintcount=Complaints::where([['fld_Consignment','=',$Complaint->fld_Consignment],['fld_Suspend','=',false]])->count();
		$Complaint->count=$Complaintcount;
		}
		//$Complaints=DB::table('tbl_complaints')->select(DB::raw(" WHERE fld_Suspend ='false' GROUP BY 'fld_Consignment' ORDER BY 'created_at' DESC"));
		//$Complaints= DB::table('tbl_complaints')->select(DB::raw('*'))->where('fld_Suspend', '=', false)->groupBy('fld_Consignment')->get();
		//$Complaints= DB::table('tbl_complaints')->where('fld_Suspend', '=',false)->groupBy('fld_Consignment')->get();
		$user=Auth::user();
		$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','از طرف',' توسط','تاریخ ثبت','مرحله'),$Complaints);
		return view('showAllComplaint')->with('Table', $table->Data())->with('user',$user)->with('Subjects',$Complaints_Subjects);
		
		
	}
	public function addComplaint(){
		$Complaints=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
		return view('addComplaint')->with('Complaints',$Complaints);
	}
	public function newComplaint( Request $req){

		if (!empty($req->input('Complaints'))&&!empty($req->input('Consignment'))&&!empty($req->input('Description'))&&!empty($req->input('Registrar'))) {
			$complaint=new Complaints;
			$user=Auth::user();
			$complaint->fld_User=$user->fld_Id;
			$complaint->fld_Subject=$req->input('Complaints');
			$complaint->fld_Consignment=$req->input('Consignment');
			$complaint->fld_Description=$req->input('Description');
			$complaint->fld_Registrar=$req->input('Registrar');
			$complaint->fld_Level=1;
			$complaint->save();

			$Complaints_Subjects=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
			$Complaints = DB::table('tbl_complaints')->whereRaw('tbl_complaints.created_at in (select max(created_at) from tbl_complaints where tbl_complaints.fld_Suspend = false group by (fld_Consignment))')->join('tbl_users', 'tbl_complaints.fld_User', '=', 'tbl_users.fld_Id')->join('tbl_complaints_subjects', 'tbl_complaints.fld_Subject', '=', 'tbl_complaints_subjects.fld_Id')->orderBy('tbl_complaints.created_at','desc')->select('tbl_complaints.*', 'tbl_complaints_subjects.fld_Complaints_Subjects', 'tbl_users.fld_Name')->get();
				foreach ($Complaints as $Complaint) {
			$Complaintcount=Complaints::where([['fld_Consignment','=',$Complaint->fld_Consignment],['fld_Suspend','=',false]])->count();
		$Complaint->count=$Complaintcount;
		}
			$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','از طرف',' توسط','تاریخ ثبت','مرحله'),$Complaints);
			return view('refreshComplaint')->with('Table', $table->Data())->with('user',$user)->with('Subjects',$Complaints_Subjects)->render();

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
			$Complaints = DB::table('tbl_complaints')->whereRaw('tbl_complaints.created_at in (select max(created_at) from tbl_complaints where tbl_complaints.fld_Suspend = false group by (fld_Consignment))')->join('tbl_users', 'tbl_complaints.fld_User', '=', 'tbl_users.fld_Id')->join('tbl_complaints_subjects', 'tbl_complaints.fld_Subject', '=', 'tbl_complaints_subjects.fld_Id')->orderBy('tbl_complaints.created_at','desc')->select('tbl_complaints.*', 'tbl_complaints_subjects.fld_Complaints_Subjects', 'tbl_users.fld_Name')->get();
				foreach ($Complaints as $Complaint) {
			$Complaintcount=Complaints::where([['fld_Consignment','=',$Complaint->fld_Consignment],['fld_Suspend','=',false]])->count();
		$Complaint->count=$Complaintcount;
		}
			$table = new DataTable2(array('شماره بارنامه', 'موضوع', 'توضیحات','از طرف',' توسط','تاریخ ثبت','مرحله'),$Complaints);
			return view('refreshComplaint')->with('Table', $table->Data())->with('user',$user)->with('Subjects',$Complaints_Subjects)->render();
	}
	public function loginForm(){
		if($user = Auth::user())
			{
				return redirect()->route('allComplaint');
			}
			return view('showLoginForm');
		}
		public function login(Request $req){
			if (Auth::attempt(['fld_Username' => trim($req->input('username')), 'password' => $req->input('password'),'fld_Suspend'=>false])) {
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
			$Complaints_Subject=Complaints_Subjects::where('fld_Suspend', '=',false)->get();
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
			$user=Auth::user();
			$Users=User::where('fld_Suspend', '=',false)->get();
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
			$user->fld_Suspend=true;
			$user->save();
			session()->flush();
			Auth::logout();
		}
		public function changePicture(Request $request){
			$user=Auth::user();
			if ($user->fld_Picture!="Admin.png"){
				File::delete(public_path().'/img/ProfilePics/'.$user->fld_Picture);
			}
			$imgName=time()."_".$request->file('photo')->getClientOriginalName();
			Image::make($request->file('photo')->getRealPath())->resize(128, 128)->save('img/ProfilePics/'.$imgName);
			$user->fld_Picture=$imgName;
			$user->save();
		}
		public function complaintHistory(Request $request){
			$Complaints=Complaints::where([['fld_Suspend', '=', false],['fld_Consignment', '=', $request->input('id')],])->orderBy('created_at', 'DESC')->get();
			return view('table')->with('Complaints',$Complaints)->render();
		}
	}
