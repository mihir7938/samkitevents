<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventService;
use App\Services\DayService;
use App\Services\YatrikService;
use App\Services\YatraService;
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
        $days = $this->dayService->fetchDaysByEvent($request->event_id);
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
            $days = $this->dayService->fetchDaysByEvent($event_data['event_id']);
        }
        return view('users.attendance')->with('events', $events)->with('days', $days)->with('event_data', $event_data)->with('member', $member);
    }

    public function setSession(Request $request)
    {
        $event_data = [
            'event_id' => $request->event_id,
            'day_id' => $request->day_id,
        ];
        $request->session()->put('event_data', $event_data);
        return response()->json(['status' => true, 'event_data' => $event_data]);
        //return view('users.qr-code')->render();
    }

    public function getInformation(Request $request)
    {
        $member = $this->yatrikService->fetchInfoByMemberId($request->member_id);
        return view('users.get-information')->with('member', $member)->render();
    }
}
