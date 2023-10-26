<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\MenuMaster;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\ServiceType;
use App\Models\ServiceDetails;
use App\Models\ServiceAppointment;
use App\Models\NotAvailableDate;
use App\Models\AppointmentAvailableDayTime;
use App\Models\SetQuestion;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;
class AppointmentController extends Controller
{
    function Apponintmentview()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails = DB::table('user_account')
            ->where('id', $userId)
            ->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $query = ServiceDetails::select('service_details.id', 'service_details.service_name');
        if ($roleid == 1) {
        } else {
            $query->where('service_details.service_id', $userId);
        }
        $ServiceDetails = $query->get();
        return view('appointment.appointmentlist', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu', 'ServiceDetails'));
    }

    function AppointmentListView(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $service_name = $request->input('service_name');
        $service_point = $request->input('service_point');

        $query = ServiceAppointment::select('service_appointments.*', 'service_details.service_name', 'service_employees.employee_name')
            ->leftJoin('service_details', 'service_details.id', 'service_appointments.service_id')
            ->leftJoin('service_employees', 'service_employees.id', 'service_appointments.employee_id');
        if ($service_name) {
            $query->where('service_appointments.service_id', $service_name);
        }
        if ($service_point) {
            $query->where('service_appointments.service_point', $service_point);
        }
        if ($roleid == 1) {
        } else {
            $query->where('service_details.service_id', $userId);
        }
        $ServiceAppointment = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $serviceCount = $ServiceAppointment->count();
        if ($roleid == 1) {
            //$servicedetails = DB::table('service_details')->get();
            $servicedetails = DB::table('service_details')
                ->whereNotExists(function ($query) {
                    $query
                        ->select(DB::raw(1))
                        ->from('service_appointments')
                        ->whereRaw('service_details.id = service_appointments.service_id');
                })
                ->get();
            $serviceemployees = DB::table('service_employees')->get();
        } else {
            // $servicedetails = DB::table('service_details')
            //     ->where('service_id', $userId)
            //     ->get();
            $servicedetails = DB::table('service_details')
                ->where('service_id', $userId)
                ->whereNotExists(function ($query) {
                    $query
                        ->select(DB::raw(1))
                        ->from('service_appointments')
                        ->whereRaw('service_details.id = service_appointments.service_id');
                })
                ->get();
            $serviceemployees = DB::table('service_employees')
                ->where('user_id', $userId)
                ->get();
        }

        return view('appointment.appointment_dets', compact('ServiceAppointment', 'serviceCount', 'servicedetails', 'serviceemployees'));
    }

    function AdmNewAppointmentAdd(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }

        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validatedData = $request->validate([
            'setavailbledate' => 'required',
            'setavailblefromdate' => ['required_if:setavailbledate,1', 'date'],
            'setavailbletodate' => ['required_if:setavailbledate,1', 'date'],

            // 'notavailabledate_data.*.setavailblesingledate' => [
            //     'required_if:isnotavailable,1',
            //     'date',
            // ],
            'service_type_id' => 'required',
            'servicepoint' => 'required',
        ]);

        $appointmentDetail = new ServiceAppointment();
        $appointmentDetail->fill($validatedData);
        $servicepoint1=$request->has('servicepoint1') ? 1 : 0;
        $servicepoint2=$request->has('servicepoint2') ? 1 : 0;
        $servicepoint=$servicepoint1.','.$servicepoint2;
        $isnotappointment = $request->has('isnotavailable') ? 1 : 0;
        $appointmentDetail->is_setdates = $request->input('setavailbledate');
        $appointmentDetail->available_from_date = $request->input('setavailblefromdate');
        $appointmentDetail->available_to_date = $request->input('setavailbletodate');
        $appointmentDetail->is_not_available = $request->has('isnotavailable') ? 1 : 0;
        $appointmentDetail->service_id = $request->input('service_type_id');
        $appointmentDetail->employee_id = $request->input('service_employe_id');
        $appointmentDetail->suggestion = $request->input('sugection');
        $appointmentDetail->service_point = $servicepoint;
        $newappointmentreg = $appointmentDetail->save();
        $appointment_id = $appointmentDetail->id;
        if ($isnotappointment == '1') {
            $notavailabledate_data = $request->input('notavailabledate_data');
            //echo "<pre>";print_r($notavailabledate_data);
            try {
                foreach ($notavailabledate_data as $notavailabledate) {
                    if ($notavailabledate['setavailblesingledate'] == '') {
                    } else {
                        $NotAvailableDate = new NotAvailableDate();
                        $NotAvailableDate->appointment_id = $appointment_id;
                        $NotAvailableDate->not_available_date = $notavailabledate['setavailblesingledate'];
                        $notavailedate = $NotAvailableDate->save();
                    }
                }
            } catch (\Exception $e) {
                return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
            }
        }

        $availabletime_data = $request->input('availabletime_data');
        //echo "<pre>";print_r($availabletime_data);
        try {
            foreach ($availabletime_data as $availabledaytime) {
                if ($availabledaytime['setdays'] == '' && $availabledaytime['setfrom_time'] == '' && $availabledaytime['setto_time'] == '') {
                } else {
                    $ApptAvailableDayTime = new AppointmentAvailableDayTime();
                    $ApptAvailableDayTime->appointment_id = $appointment_id;
                    $settimestatus = isset($availabledaytime['settimestatus']) ? 1 : 0;
                    $ApptAvailableDayTime->is_set_time = $settimestatus;
                    $ApptAvailableDayTime->appt_days = $availabledaytime['setdays'];
                    $ApptAvailableDayTime->from_time = $availabledaytime['setfrom_time'];
                    $ApptAvailableDayTime->to_time = $availabledaytime['setto_time'];
                    $availedaytime = $ApptAvailableDayTime->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
        }

        $setquestion_data = $request->input('setquestion_data');
        try {
            foreach ($setquestion_data as $setquestion) {
                if ($setquestion['setquestion'] == '') {
                } else {
                    $SetQuestion = new SetQuestion();
                    $SetQuestion->appointment_id = $appointment_id;
                    $SetQuestion->questions = $setquestion['setquestion'];
                    $setquestions = $SetQuestion->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
        }

        $msg = 'New Appointment Added Successfully. Appointment ID : ' . $appointment_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($newappointmentreg > 0) {
            return response()->json(['result' => 1, 'mesge' => 'Appointment Successfully Added']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmAppointmentViewEdit(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $appointmentid = $request->input('appointmentid');
        $ServiceAppointmentQuery = ServiceAppointment::select('service_appointments.*')
            ->leftJoin('service_details', 'service_details.id', 'service_appointments.service_id')
            ->where('service_appointments.id', $appointmentid);
        if ($roleid == 1) {
            $servicedetails = DB::table('service_details')->get();
            $serviceemployees = DB::table('service_employees')->get();
        } else {
            $ServiceAppointment->where('service_details.user_id', $userId);
            $servicedetails = DB::table('service_details')
                ->where('service_id', $userId)
                ->get();
            $serviceemployees = DB::table('service_employees')
                ->where('user_id', $userId)
                ->get();
        }
        $ServiceAppointment = $ServiceAppointmentQuery->first();
        //echo $lastRegId = $ServiceAppointmentQuery->toSql();exit;

        $setquestions = DB::table('set_questions')
            ->where('appointment_id', $ServiceAppointment->id)
            ->get();

        $appointmentavailable = DB::table('appointment_available_day_times')
            ->where('appointment_id', $ServiceAppointment->id)
            ->get();

        $notavailabledates = DB::table('not_available_dates')
            ->where('appointment_id', $ServiceAppointment->id)
            ->get();

        return view('appointment.appointment_viewedit_dets', compact('ServiceAppointment', 'setquestions', 'servicedetails', 'serviceemployees', 'appointmentavailable', 'notavailabledates'));
    }

    function AdmNewAppointmentEdit(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $appointmentid = $request->input('appointment_id');
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validatedData = $request->validate([
            'setavailbledates' => 'required',
            'setavailblefromdates' => ['required_if:setavailbledates,1', 'date'],
            'setavailbletodates' => ['required_if:setavailbledates,1', 'date'],
            'service_type_ids' => 'required',
            // 'servicepoints' => 'required',
        ]);
        $appointmentDetail = ServiceAppointment::find($appointmentid);
        $appointmentDetail->fill($validatedData);
        $servicepointa=$request->has('servicepointa') ? 1 : 0;
        $servicepointb=$request->has('servicepointb') ? 1 : 0;
        $servicepoint=$servicepointa.','.$servicepointb;
        $isnotappointment = $request->has('isnotavailables') ? 1 : 0;
        $appointmentDetail->is_setdates = $request->input('setavailbledates');
        $appointmentDetail->available_from_date = $request->input('setavailblefromdates');
        $appointmentDetail->available_to_date = $request->input('setavailbletodates');
        $appointmentDetail->is_not_available = $request->has('isnotavailables') ? 1 : 0;
        $appointmentDetail->service_id = $request->input('service_type_ids');
        $appointmentDetail->employee_id = $request->input('service_employe_ids');
        $appointmentDetail->suggestion = $request->input('sugections');
        $appointmentDetail->service_point = $servicepoint;
        $newappointmentreg = $appointmentDetail->save();
        //delete product attributes
        $notavailabledateDetail = NotAvailableDate::where('appointment_id', $appointmentid)->delete();
        $AppointmentAvailableDayTime = AppointmentAvailableDayTime::where('appointment_id', $appointmentid)->delete();
        $AppointmentSetQuestion = SetQuestion::where('appointment_id', $appointmentid)->delete();
        //end delete attributes
        if ($isnotappointment == '0') {
            $deltenotavailabledateDetail = NotAvailableDate::where('appointment_id', $appointmentid)->delete();
        }
        if ($isnotappointment == '1') {
            $notavailabledate_data = $request->input('notavailabledate_datas');
            try {
                foreach ($notavailabledate_data as $notavailabledate) {
                    if ($notavailabledate['setavailblesingledates'] == '') {
                    } else {
                        $NotAvailableDate = new NotAvailableDate();
                        $NotAvailableDate->appointment_id = $appointmentid;
                        $NotAvailableDate->not_available_date = $notavailabledate['setavailblesingledates'];
                        $notavailedate = $NotAvailableDate->save();
                    }
                }
            } catch (\Exception $e) {
                return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
            }
        }
        $availabletime_data = $request->input('availabletime_datas');

        try {
            foreach ($availabletime_data as $availabledaytime) {
                if ($availabledaytime['setdayss'] !== '0' && $availabledaytime['setfrom_times'] !== '' && $availabledaytime['setto_times'] !== '') {
                    $ApptAvailableDayTime = new AppointmentAvailableDayTime();
                    $ApptAvailableDayTime->appointment_id = $appointmentid;
                    $settimestatus = isset($availabledaytime['settimestatuss']) ? 1 : 0;
                    $ApptAvailableDayTime->is_set_time = $settimestatus;
                    $ApptAvailableDayTime->appt_days = $availabledaytime['setdayss'];
                    $ApptAvailableDayTime->from_time = $availabledaytime['setfrom_times'];
                    $ApptAvailableDayTime->to_time = $availabledaytime['setto_times'];
                    $availedaytime = $ApptAvailableDayTime->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 3, 'mesge' => $e->getMessage()]);
        }

        $setquestion_data = $request->input('setquestion_datas');
        try {
            foreach ($setquestion_data as $setquestion) {
                if ($setquestion['setquestions'] == '') {
                } else {
                    $SetQuestion = new SetQuestion();
                    $SetQuestion->appointment_id = $appointmentid;
                    $SetQuestion->questions = $setquestion['setquestions'];
                    $setquestions = $SetQuestion->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
        }
        $msg = 'Appointment Updated Successfully. Updated Appointment ID : ' . $appointmentid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($newappointmentreg > 0) {
            return response()->json(['result' => 1, 'mesge' => 'Appointment Successfully Updated']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AppointmentDelete(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $appointmentid = $request->input('appointmentid');
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $appointmentDetail              = ServiceAppointment::where('id', $appointmentid)->delete();
        $notavailabledateDetail         = NotAvailableDate::where('appointment_id', $appointmentid)->delete();
        $AppointmentAvailableDayTime    = AppointmentAvailableDayTime::where('appointment_id', $appointmentid)->delete();
        $AppointmentSetQuestion         = SetQuestion::where('appointment_id', $appointmentid)->delete();
        $msg = 'Appointment Deleted Successfully. Deleted Appointment ID : ' . $appointmentid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($appointmentDetail > 0) {
            return response()->json(['result' => 1, 'mesge' => 'Appointment Successfully Deleted']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

}
