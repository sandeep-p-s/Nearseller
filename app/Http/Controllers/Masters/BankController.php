<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\masters\Bank_type;
use App\Http\Controllers\Controller;
use App\Models\masters\Bank_details;

class BankController extends Controller
{
    public function list_bank()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $banks = DB::table('bank_types')->get();
        return view('admin.masters.bank.listBank',compact('loggeduser','userdetails','banks','structuredMenu'));

    }
    public function add_bank()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.masters.bank.addBank',compact('loggeduser','userdetails','structuredMenu'));
    }
    public function store_bank(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|unique:bank_types,bank_name|string|max:255|min:3',
        ],
        [
            'bank_name.required' => 'The bank name field is missing.',
            'bank_name.string' => 'The bank name must be a string.',
            'bank_name.unique' => 'The bank name must be unique.',
            'bank_name.min' => 'The bank name must be at least 3 characters.',
            'bank_name.max' => 'The bank name cannot exceed 255 characters.',
        ]);

        $newbank = new Bank_type;
        $newbank->bank_name = strtoupper($request->bank_name);
        $newbank->save();

        return redirect()->route('list.bank')->with('success', 'Bank added successfully.');
    }
     public function edit_bank($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $bank = Bank_type::find($id);

        if (!$bank) {
            return redirect()->route('list.shoptype')->with('error', 'Bank not found.');
        }

        return view('admin.masters.bank.editBank', compact('bank','userdetails','loggeduser','structuredMenu'));
    }
    public function update_bank(Request $request,$id)
    {
        $bank = Bank_type::find($id);
        if (!$bank) {
            return redirect()->route('list.bank')->with('error', 'Bank not found.');
        }

        $request->validate([
            'bank_name' => ['required',Rule::unique('bank_types')->ignore($id),'string','max:255','min:3'],
            'status' => 'in:Y,N',
        ],
        [
            'bank_name.required' => 'The bank name field is missing.',
            'bank_name.string' => 'The bank name must be a string.',
            'bank_name.unique' => 'The bank name must be unique.',
            'bank_name.min' => 'The bank name must be at least 4 characters.',
            'bank_name.max' => 'The bank name cannot exceed 255 characters.',
            'status.in' => 'Invalid status value.',
        ]);
        $bank->bank_name = ucfirst(strtolower($request->bank_name));
        $bank->status = $request->status;
        $bank->save();

        return redirect()->route('list.bank')->with('success', 'Bank updated successfully.');
    }
    public function delete_bank($id)
    {
        $bank = Bank_type::find($id);

        if (!$bank) {
            return redirect()->route('list.bank')->with('error', 'Bank not found.');
        }

        $bank->delete();

        return redirect()->route('list.bank')->with('success', 'Bank deleted successfully.');
    }

    public function list_bank_branch()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $bankbranchs = DB::table('bank_details as bd')
        ->select('bd.branch_name','bd.id','bt.bank_name as bank_name','bt.status')
        ->join('bank_types as bt', 'bt.id', 'bd.bank_code')
        ->where('bt.status','Y')
        ->get();
        return view('admin.masters.bank.listBankbranch',compact('loggeduser','userdetails','bankbranchs','structuredMenu'));

    }
    public function add_bank_branch()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $districts = DB::table('district as d')
            ->select('d.district_name','d.id','st.state_name','ct.country_name','d.status','st.status','ct.status')
            ->join('state as st','d.state_id','st.id')
            ->join('country as ct','st.country_id','ct.id')
            ->where('d.status','Y')
            ->where('st.status','Y')
            ->where('ct.status','Y')
            ->get();
        $banks = DB::table('bank_types as bt')
            ->select('bt.id','bt.bank_name','bt.status')
            ->where('bt.status','Y')
            ->get();
        return view('admin.masters.bank.addBankbranch',compact('loggeduser','userdetails','districts','banks','structuredMenu'));
    }
    public function store_bank_branch(Request $request)
    {
        $request->validate([
            'district_name' => 'not_in:0',
            'bank_name' => 'not_in:0',
            'branch_name' => 'required|unique:bank_details,branch_name|string|max:50|min:3',
            'branch_address' => 'required|regex:/^[a-zA-Z0-9,]+$/|max:255|min:3',
            'ifsc_code' => 'required|unique:bank_details,ifsc_code|string|max:10|min:6',
        ],
        [
            'district_name.not_in' => 'Please select country.',
            'bank_name.not_in' => 'Please select country.',
            'branch_name.required' => 'The branch name  is missing.',
            'branch_name.string' => 'The branch name must be a string.',
            'branch_name.unique' => 'The branch name must be unique.',
            'branch_name.min' => 'The branch name must be at least 3 characters.',
            'branch_name.max' => 'The branch name cannot exceed 255 characters.',
            'branch_address.required' => 'The branch address  field is missing.',
            'branch_address.regex' => 'Invalid branch address format.',
            'branch_address.min' => 'The branch address must be at least 3 characters.',
            'branch_address.max' => 'The branch address cannot exceed 255 characters.',
            'ifsc_code.required' => 'The IFSC Code  is missing.',
            'ifsc_code.unique' => 'The IFSC Code must be unique.',
            'ifsc_code.min' => 'The IFSC Code must be at least 3 characters.',
            'ifsc_code.max' => 'The IFSC Code cannot exceed 10 characters.',



        ]);

        $newbankbranch = new Bank_details;
        $newbankbranch->district_code = $request->district_name;
        $newbankbranch->bank_code = $request->bank_name;
        $newbankbranch->branch_name = ucfirst(strtolower($request->branch_name));
        $newbankbranch->branch_address = strtoupper($request->branch_address);
        $newbankbranch->ifsc_code = strtoupper($request->ifsc_code);
        $newbankbranch->save();

        return redirect()->route('list.bank_branch')->with('success', 'Bankbranch added successfully.');
    }
     public function edit_bank_branch($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $branch = DB::table('bank_details as bd')
            ->select('bd.id','bd.district_code','bd.bank_code','bd.branch_name','bd.branch_address','bd.ifsc_code','d.district_name','d.id as district_id','st.state_name','ct.country_name','bt.bank_name','bt.id as bank_id','d.status','st.status','ct.status','bt.status')
            ->join('district as d','bd.district_code','d.id')
            ->join('state as st','d.state_id','st.id')
            ->join('country as ct','st.country_id','ct.id')
            ->join('bank_types as bt','bd.bank_code','bt.id')
            ->where('d.status','Y')
            ->where('st.status','Y')
            ->where('ct.status','Y')
            ->where('bt.status','Y')
            ->where('bd.id',$id)
            ->get();

        if (!$branch) {
            return redirect()->route('list.bank_branch')->with('error', 'Bankbranch not found.');
        }

        return view('admin.masters.bank.editBankbranch', compact('branch','userdetails','loggeduser','structuredMenu'));
    }
    public function update_bank_branch(Request $request,$id)
    {
        $bankbranch = Bank_details::find($id);
        if (!$bankbranch) {
            return redirect()->route('list.bank_branch')->with('error', 'Bankbranch not found.');
        }

        $request->validate([
            'district_name' => 'not_in:0',
            'bank_name' => 'not_in:0',
            'branch_name' => ['required',Rule::unique('bank_details')->ignore($id),'string','max:255','min:3'],
            'branch_address' => 'required|regex:/^[a-zA-Z0-9,]+$/|max:255|min:3',
            'ifsc_code' => ['required',Rule::unique('bank_details')->ignore($id),'string','max:10','min:6'],
            'status' => 'in:Y,N',
        ],
        [
            'district_name.not_in' => 'Please select country.',
            'bank_name.not_in' => 'Please select country.',
            'branch_name.required' => 'The bank branch name field is missing.',
            'branch_name.string' => 'The bank branch name must be a string.',
            'branch_name.unique' => 'The bank branch name must be unique.',
            'branch_name.min' => 'The bank branch name must be at least 4 characters.',
            'branch_name.max' => 'The bank branch name cannot exceed 255 characters.',
            'status.in' => 'Invalid status value.',
            'branch_address.required' => 'The branch address  field is missing.',
            'branch_address.regex' => 'Invalid branch address format.',
            'branch_address.min' => 'The branch address must be at least 3 characters.',
            'branch_address.max' => 'The branch address cannot exceed 255 characters.',
            'ifsc_code.required' => 'The IFSC Code  is missing.',
            'ifsc_code.unique' => 'The IFSC Code must be unique.',
            'ifsc_code.min' => 'The IFSC Code must be at least 3 characters.',
            'ifsc_code.max' => 'The IFSC Code cannot exceed 10 characters.',

        ]);
        $newbankbranch = new Bank_details;
        $newbankbranch->district_code = $request->district_name;
        $newbankbranch->bank_code = $request->bank_name;
        $newbankbranch->branch_name = ucfirst(strtolower($request->branch_name));
        $newbankbranch->branch_address = strtoupper($request->branch_address);
        $newbankbranch->ifsc_code = strtoupper($request->ifsc_code);
        $newbankbranch->save();

        return redirect()->route('list.bank_branch')->with('success', 'Bankbranch updated successfully.');
    }
    public function delete_bank_branch($id)
    {
        $bankbranch = Bank_details::find($id);

        if (!$bankbranch) {
            return redirect()->route('list.bank_branch')->with('error', 'Bank Branch not found.');
        }

        $bankbranch->delete();

        return redirect()->route('list.bank_branch')->with('success', 'Bank Branch deleted successfully.');
    }
}
