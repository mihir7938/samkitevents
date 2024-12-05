<?php

namespace App\Services;

use App\Models\Yatra;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class YatraService
{
    public function getYatraById($id)
    {
        return Yatra::find($id);
    }
    public function create($data)
    {
        return Yatra::create($data);
    }
    public function update($yatra, $data)
    {
        return $yatra->update($data);
    }
    public function delete($yatra)
    {
        return $yatra->delete($yatra);
    }
    public function fetchYatraByEvent($event_id)
    {
        return Yatra::where('event_id', $event_id)->groupBy('day_id')->get();
    }
    public function fetchYatriksByDay($event_id, $day_id)
    {
        return Yatra::where('event_id', $event_id)->where('day_id', $day_id)->where('is_allowed', 1)->get();
    }
    public function checkYatrik($yatrik_id, $event_id, $day_id)
    {
        $record = Yatra::where('yatrik_id', $yatrik_id)->where('event_id', $event_id)->where('day_id', $day_id)->first();
        if($record) {
            return true;
        } else {
            return false;
        }
    }
    public function checkAssignYatrik($yatrik_id, $event_id, $day_id)
    {
        $record = Yatra::where('yatrik_id', $yatrik_id)->where('event_id', $event_id)->where('day_id', $day_id)->where('is_allowed', 1)->first();
        if($record) {
            return true;
        } else {
            return false;
        }
    }
    public function checkAttendance($yatrik_id, $event_id, $day_id)
    {
        $record = Yatra::where('yatrik_id', $yatrik_id)->where('event_id', $event_id)->where('day_id', $day_id)->first();
        if($record->attendance == 1) {
            return true;
        } else {
            return false;
        }
    }
}
