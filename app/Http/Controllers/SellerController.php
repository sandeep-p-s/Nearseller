<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\Affiliate;
use App\Models\SellerDetails;
use App\Models\Attribute;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;

class SellerController extends Controller
{
    public function sellerdashboard()
    {
        $userRole   = session('user_role');
        $roleid     = session('roleid');
        $userId     = session('user_id');
        if($userId=='')
        {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countShops     = DB::table('user_account')->where('role_id', 2)->where('id', $userId)->count();
        return view('seller.dashboard',compact('userdetails','countShops','userRole','loggeduser'));
    }

    public function AttributePage()
    {
        $userRole   = session('user_role');
        $roleid     = session('roleid');
        $userId     = session('user_id');
        if($userId=='')
        {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $activeAttributes= DB::table('attributes')->where('status', 'Y')->count();
        $NotactiveAttributes= DB::table('attributes')->where('status', 'N')->count();
        $attributeslist  = DB::table('attributes')->get();
        return view('seller.attributeslist',compact('userdetails','activeAttributes','NotactiveAttributes','userRole','loggeduser','attributeslist'));
    }
    public function AttributeList(Request $request)
    {
        $userRole   = session('user_role');
        $roleid     = session('roleid');
        $userId     = session('user_id');
        if($userId=='')
        {
            return redirect()->route('logout');
        }
        $attributeslist  = DB::table('attributes')->get();
        $attributescount  = DB::table('attributes')->count();
        return view('seller.attributes_dets',compact('attributeslist','attributescount'));
    }

    function AddAttributePage(Request $request)
        {
            $userRole = session('user_role');
            $roleid = session('roleid');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $validatedData = $request->validate([
                'att_name'        => 'required|max:50',
            ]);
            $Attribute = new Attribute();
            $Attribute->attribute_name = $request->att_name;
            $submt=$Attribute->save();
            $lastRegId = $Attribute->toSql();
            $last_id = $Attribute->id;
            $msg="Successfully Added! register id : ".$last_id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $userId;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
            if($submt>0){
                return response()->json(['result' => 1,'mesge'=>'Added Successfully']);
            }
            else{
                return response()->json(['result' => 2,'mesge'=>'Failed']);
            }
        }
    function EditAttributePage(Request $request)
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $id=$request->input('id');
            $attributeslist  = DB::table('attributes')->where('id',$id)->get();
            return view('seller.attribute_viewedit', compact('attributeslist'));
        }




}
