<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventService;
use App\Services\DayService;
use App\Services\YatrikService;
use App\Services\YatraService;
use App\Models\Yatra;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $eventService, $dayService, $yatrikService, $yatraService;

    public function __construct(
        EventService $eventService,
        DayService $dayService,
        YatrikService $yatrikService,
        YatraService $yatraService
    )
    {
        $this->dayService = $dayService;
        $this->eventService = $eventService;
        $this->yatrikService = $yatrikService;
        $this->yatraService = $yatraService;
    }

    public function index(Request $request)
    {
        return view('users.index');
    }

    public function getYatriks(Request $request)
    {
        $events = $this->eventService->getAllEvents();
        $days = [];
        $yatra = [];
        return view('users.yatriks')->with('events', $events)->with('days', $days)->with('yatra', $yatra);
    }

    public function fetchDaysByEvent(Request $request)
    {
        $days = $this->dayService->fetchAssignDaysByEvent($request->event_id);
        return view('users.fetch-days')->with('days', $days)->render();
    }

    public function fetchYatriksByDay(Request $request)
    {
        $yatra = $this->yatraService->fetchYatriksByDay($request->event_id, $request->day_id);
        return view('users.fetch-yatriks')->with('yatra', $yatra)->render();
    }

    public function attendance(Request $request)
    {
        $events = $this->eventService->getAllEvents();
        $days = [];
        $event_data = [];
        $member = [];
        if($request->session()->get('event_data')) {
            $event_data = $request->session()->get('event_data');
            $days = $this->dayService->fetchAssignDaysByEvent($event_data['event_id']);
        }
        return view('users.attendance')->with('events', $events)->with('days', $days)->with('event_data', $event_data)->with('member', $member);
    }

    public function showQrCode(Request $request)
    {
        return view('users.qr-code')->render();
    }

    public function getInformation(Request $request)
    {
        $member = $this->yatrikService->fetchInfoByMemberId($request->member_id);
        if(!$member) {
            return response()->json(['status' => false]);
        } else {
            return response()->json(['status' => true]);
        }
    }

    public function updateAttendance(Request $request)
    {
        try{
            $member = $this->yatrikService->fetchInfoByMemberId($request->member_id);
            if(!$member){
                throw new BadRequestException('Invalid member id');
            }
            $event_data = [
                'event_id' => $request->event_name,
                'day_id' => $request->day_name,
            ];
            $request->session()->put('event_data', $event_data);
            $check_yatrik = $this->yatraService->checkAssignYatrik($member->id, $request->event_name, $request->day_name);
            if($check_yatrik) {
                $check_attendance = $this->yatraService->checkStartAttendance($member->id, $request->event_name, $request->day_name);
                if(!$check_attendance) {
                    $start_event = 'Start';
                    $start_date = now();
                    $updatedata = Yatra::where('yatrik_id', $member->id)->where('event_id', $request->event_name)->where('day_id', $request->day_name)->update(['attendance' => 1, 'start_event' => $start_event, 'start_date' => $start_date]);
                    $request->session()->put('message', 'Yatrik has been present successfully');
                    $request->session()->put('alert-type', 'alert-success');
                } else {
                    $request->session()->put('message', 'Yatrik already present');
                    $request->session()->put('alert-type', 'alert-danger');
                }
            } else {
                $request->session()->put('message', 'Yatrik not found');
                $request->session()->put('alert-type', 'alert-danger');
            }
            return redirect()->route('users.attendance');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('users.attendance');
        }
    }

    public function endAttendance(Request $request)
    {
        $events = $this->eventService->getAllEvents();
        $days = [];
        $end_event_data = [];
        $member = [];
        if($request->session()->get('end_event_data')) {
            $end_event_data = $request->session()->get('end_event_data');
            $days = $this->dayService->fetchAssignDaysByEvent($end_event_data['event_id']);
        }
        return view('users.end-attendance')->with('events', $events)->with('days', $days)->with('end_event_data', $end_event_data)->with('member', $member);
    }

    public function updateEndAttendance(Request $request)
    {
        try{
            $member = $this->yatrikService->fetchInfoByMemberId($request->member_id);
            if(!$member){
                throw new BadRequestException('Invalid member id');
            }
            $end_event_data = [
                'event_id' => $request->event_name,
                'day_id' => $request->day_name,
            ];
            $request->session()->put('end_event_data', $end_event_data);
            $check_yatrik = $this->yatraService->checkAssignYatrik($member->id, $request->event_name, $request->day_name);
            if($check_yatrik) {
                $check_attendance = $this->yatraService->checkEndAttendance($member->id, $request->event_name, $request->day_name);
                if(!$check_attendance) {
                    $start_event = 'Start';
                    $end_event = 'End';
                    $end_date = now();
                    $updatedata = Yatra::where('yatrik_id', $member->id)->where('event_id', $request->event_name)->where('day_id', $request->day_name)->update(['attendance' => 1, 'start_event' => $start_event, 'end_event' => $end_event, 'end_date' => $end_date]);
                    $request->session()->put('message', 'Yatrik has been present successfully');
                    $request->session()->put('alert-type', 'alert-success');
                } else {
                    $request->session()->put('message', 'Yatrik already present');
                    $request->session()->put('alert-type', 'alert-danger');
                }
            } else {
                $request->session()->put('message', 'Yatrik not found');
                $request->session()->put('alert-type', 'alert-danger');
            }
            return redirect()->route('users.attendance.end');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('users.attendance.end');
        }
    }

    public function gift(Request $request)
    {
        $events = $this->eventService->getAllEvents();
        $days = [];
        $gift_data = [];
        $member = [];
        if($request->session()->get('gift_data')) {
            $gift_data = $request->session()->get('gift_data');
            $days = $this->dayService->fetchAssignDaysByEvent($gift_data['event_id']);
        }
        return view('users.gift')->with('events', $events)->with('days', $days)->with('gift_data', $gift_data)->with('member', $member);
    }

    public function updateGift(Request $request)
    {
        try{
            $member = $this->yatrikService->fetchInfoByMemberId($request->member_id);
            if(!$member){
                throw new BadRequestException('Invalid member id');
            }
            $gift_data = [
                'event_id' => $request->event_name,
                'day_id' => $request->day_name,
            ];
            $request->session()->put('gift_data', $gift_data);
            $check_yatrik = $this->yatraService->checkAssignYatrik($member->id, $request->event_name, $request->day_name);
            if($check_yatrik) {
                $check_gift = $this->yatraService->checkGift($member->id, $request->event_name, $request->day_name);
                if(!$check_gift) {
                    $updatedata = Yatra::where('yatrik_id', $member->id)->where('event_id', $request->event_name)->where('day_id', $request->day_name)->update(['gift' => 1]);
                    $request->session()->put('message', 'Gift has been given successfully');
                    $request->session()->put('alert-type', 'alert-success');
                } else {
                    $request->session()->put('message', 'Gift is already given to this yatrik');
                    $request->session()->put('alert-type', 'alert-danger');
                }
            } else {
                $request->session()->put('message', 'Yatrik not found');
                $request->session()->put('alert-type', 'alert-danger');
            }
            return redirect()->route('users.gift');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('users.gift');
        }
    }
}
