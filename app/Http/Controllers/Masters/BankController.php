<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\masters\Bank_type;
use App\Models\UserAccount;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    public function list_bank()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $banks = DB::table('bank_types')->get();
        return view('admin.masters.bank.listBank',compact('loggeduser','userdetails','banks'));

    }
    public function add_bank()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.masters.bank.addBank',compact('loggeduser','userdetails'));
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
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $bank = Bank_type::find($id);

        if (!$bank) {
            return redirect()->route('list.shoptype')->with('error', 'Bank not found.');
        }

        return view('admin.masters.bank.editBank', compact('bank','userdetails','loggeduser'));
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

    public function list_bankbranch()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $bankbranchs = DB::table('bank_details')->get();
        return view('admin.masters.bankbranch.listBankbranch',compact('loggeduser','userdetails','bankbranchs'));

    }
    public function add_bankbranch()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.masters.bankbranch.addBankbranch',compact('loggeduser','userdetails'));
    }
    public function store_bankbranch(Request $request)
    {
        $request->validate([
            'bankbranch_name' => 'required|unique:bankbranch_types,bankbranch_name|string|max:255|min:3',
        ],
        [
            'bankbranch_name.required' => 'The bankbranch name field is missing.',
            'bankbranch_name.string' => 'The bankbranch name must be a string.',
            'bankbranch_name.unique' => 'The bankbranch name must be unique.',
            'bankbranch_name.min' => 'The bankbranch name must be at least 3 characters.',
            'bankbranch_name.max' => 'The bankbranch name cannot exceed 255 characters.',
        ]);

        $newbankbranch = new Bankbranch_type;
        $newbankbranch->bankbranch_name = strtoupper($request->bankbranch_name);
        $newbankbranch->save();

        return redirect()->route('list.bankbranch')->with('success', 'Bankbranch added successfully.');
    }
     public function edit_bankbranch($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $bankbranch = Bankbranch_type::find($id);

        if (!$bankbranch) {
            return redirect()->route('list.shoptype')->with('error', 'Bankbranch not found.');
        }

        return view('admin.masters.bankbranch.editBankbranch', compact('bankbranch','userdetails','loggeduser'));
    }
    public function update_bankbranch(Request $request,$id)
    {
        $bankbranch = Bankbranch_type::find($id);
        if (!$bankbranch) {
            return redirect()->route('list.bankbranch')->with('error', 'Bankbranch not found.');
        }

        $request->validate([
            'bankbranch_name' => ['required',Rule::unique('bankbranch_types')->ignore($id),'string','max:255','min:3'],
            'status' => 'in:Y,N',
        ],
        [
            'bankbranch_name.required' => 'The bankbranch name field is missing.',
            'bankbranch_name.string' => 'The bankbranch name must be a string.',
            'bankbranch_name.unique' => 'The bankbranch name must be unique.',
            'bankbranch_name.min' => 'The bankbranch name must be at least 4 characters.',
            'bankbranch_name.max' => 'The bankbranch name cannot exceed 255 characters.',
            'status.in' => 'Invalid status value.',
        ]);
        $bankbranch->bankbranch_name = ucfirst(strtolower($request->bankbranch_name));
        $bankbranch->status = $request->status;
        $bankbranch->save();

        return redirect()->route('list.bankbranch')->with('success', 'Bankbranch updated successfully.');
    }
    public function delete_bankbranch($id)
    {
        $bankbranch = Bankbranch_type::find($id);

        if (!$bankbranch) {
            return redirect()->route('list.bankbranch')->with('error', 'Bankbranch not found.');
        }

        $bankbranch->delete();

        return redirect()->route('list.bankbranch')->with('success', 'Bankbranch deleted successfully.');
    }
}
