<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Offer;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class ServiceOfferController extends Controller
{
    public function list_service_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $service_offer = DB::table('offers')->where('type',2)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('seller.service.offer.list_offer', compact('service_offer', 'loggeduser', 'userdetails','structuredMenu'));
    }

    public function add_service_offer()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('seller.service.offer.add_offer', compact('loggeduser', 'userdetails','structuredMenu'));
    }

    public function store_service_offer(Request $request)
    {
        //$Offer->update($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'offer_to_display' => 'required|string',
                'conditions' => 'required|string|max:255',
                'from_date_time' => 'required|date',
                'to_date_time' => 'required|date',
                'offer_image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'offer_to_display.required' => 'The Display offer field is required',
                'conditions.required' => 'The conditions field is required.',
                'conditions.string' => 'The conditions field must be a string.',
                'conditions.max' => 'The conditions field may not be greater than :max characters.',

            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $service_offer = new Offer;
        $service_offer->type = 2;
        $service_offer->offer_to_display = $request->offer_to_display;
        $service_offer->conditions = json_encode($request->car);
        $service_offer->from_date_time = $request->from_date_time;
        $service_offer->to_date_time = $request->to_date_time;
        $upload_path = 'uploads/service_offer/';
        $file_path = $request->file('offer_image');
        if ($file_path != '') {
            if ($file_path->isValid()) {
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $service_offer->offer_image = $new_name;
            }
        }
        $service_offer->save();
        return redirect()->route('list.service_offer')->with('success', 'Service Offer saved successfully');
    }

    public function edit_service_offer($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $serviceoffer = Offer::find($id);

        if (!$serviceoffer) {
            return redirect()->route('list.Service_offer')->with('error', 'Service offer not found.');
        }

        return view('seller.service.offer.edit_offer', compact('serviceoffer', 'loggeduser', 'userdetails','structuredMenu'));
    }

    public function update_service_offer(Request $request, $id)
    {
        $serviceoffer = Offer::find($id);
        if (!$serviceoffer) {
            return redirect()->route('list.service_offer')->with('error', 'Service offer not found.');
        }
        $validator = Validator::make($request->all(), [
            'offer_to_display' => 'required|string',
            'car' => 'required|array',
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date',
            'offer_image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        
        $serviceoffer->offer_to_display = $request->offer_to_display;
        $serviceoffer->conditions = json_encode($request->car);
        $serviceoffer->from_date_time = $request->from_date_time;
        $serviceoffer->to_date_time = $request->to_date_time;
        $upload_path = 'uploads/service_offer/';
        $file_path = $request->file('offer_image');
        if ($file_path != '') {
            if ($file_path->isValid()) {
                $full_file_path = public_path($upload_path . $serviceoffer->offer_image);

                if (file_exists($full_file_path)) {
                    unlink($full_file_path);
                }
                $new_name = time() . '_' . $file_path->getClientOriginalName();
                $file_path->move($upload_path, $new_name);
                $serviceoffer->offer_image = $new_name;
            }
        }
        $serviceoffer->save();

        return redirect()->route('list.service_offer')->with('success', 'Service offer updated successfully.');
    }

    public function delete_service_offer($id)
    {
        $service_offer = Offer::find($id);

        if (!$service_offer) {
            return redirect()->route('list.service_offer')->with('error', 'Service offer not found.');
        }
        $upload_path = 'uploads/Service_offer/';
        $file_path = $service_offer->offer_image;
        $full_file_path = public_path('uploads/service_offer/' . $file_path);
        //dd($full_file_path);
        if (file_exists($full_file_path)) {
            unlink($full_file_path);
        }

        $service_offer->delete();

        return redirect()->route('list.service_offer')->with('success', 'Service offer deleted successfully.');
    }
}
